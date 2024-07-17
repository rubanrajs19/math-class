<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\ClassroomModel;
use CodeIgniter\RESTful\ResourceController;

class Bookings extends ResourceController
{
    protected $modelName = 'App\Models\BookingModel';
    protected $format    = 'json';

    public function create()
    {
        // print_r($_REQUEST['classroom_name']);
        // die;

        // $classroomName = $this->request->getPost('classroom_name');
        // $bookingDate = $this->request->getPost('booking_date');
        // $studentName = $this->request->getPost('student_name');

        $classroomName = $_REQUEST['classroom_name'];
        $bookingDate = $_REQUEST['booking_time'];
        $studentName = $_REQUEST['student_name'];


        //  print_r($_POST);
        // die;

        $classroomModel = new ClassroomModel();
        $classroom = $classroomModel->getClassroomByName($classroomName);
       


        if (empty($classroom)) {
            return $this->failNotFound('Classroom not found');
        }

        $classroom_capacity = $classroom['capacity'];
        

        $getTotalStudentsRegitered = $this->model->getTotalStudents($bookingDate, $classroom['id']);

        if($classroom_capacity <= $getTotalStudentsRegitered ){


            return $this->fail('The slot is full; please try a different slot.');
        }

          

        $bookingTime = strtotime($bookingDate);
        $timetable = json_decode($classroom['timetable'], true);
         
        $dayOfWeek = date('l', $bookingTime);

        if (!array_key_exists($dayOfWeek, $timetable) || !in_array(date('H:i', $bookingTime), $timetable[$dayOfWeek])) {
            return $this->fail('Invalid booking time');
        }

        $data = [
            'classroom_id' => $classroom['id'],
            'booking_date' => $bookingDate,
            'student_name' => $studentName
        ];

        // print_r($bookingTime);

        // // print_r($bookingDate);

        // print_r($dayOfWeek);
        //  die;

        $this->model->createBooking($data);
        return $this->respondCreated(['message' => 'Booking created successfully']);
    }

    public function delete($id = null)
    {
        $booking = $this->model->getBooking($id);
        if (empty($booking)) {
            return $this->failNotFound('Booking not found');
        }

        


        $created_at = new \DateTime($booking['created_at']);
        $now = new \DateTime();
        $interval = $created_at->diff($now);


        // $bookingTime = strtotime($booking['created_at']);
        // if ($bookingTime - time() < 86400) {}
        if ($interval->days == 0 && $interval->h < 24) {
            return $this->fail('Cannot cancel booking less than 24 hours in advance');
        }

        $this->model->deleteBooking($id);
        return $this->respondDeleted(['message' => 'Booking deleted successfully']);
    }

    public function totalStudents()
    {
        $booking_time = $this->request->getGet('booking_time');  // e.g., "17:00"
        $classroomName = $this->request->getGet('classroom_name');

        $classroomModel = new ClassroomModel();
        $classroom = $classroomModel->getClassroomByName($classroomName);
        
        if (empty($booking_time)) {
            return $this->failValidationError('Booking time is required');
        }
        
        $total_students = $this->model->getTotalStudents($booking_time,$classroom['id']);
        
        return $this->respond(['Total_Students' => $total_students]);
    }
}
?>
