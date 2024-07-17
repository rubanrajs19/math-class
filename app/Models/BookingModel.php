<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['classroom_id', 'booking_date', 'student_name', 'created_at'];

    public function getBookingsByWeek($startDate, $endDate)
    {
        return $this->where('booking_date >=', $startDate)
                    ->where('booking_date <=', $endDate)
                    ->findAll();
    }

    public function createBooking($data)
    {
        return $this->save($data);
    }

    public function deleteBooking($id)
    {
        return $this->delete($id);
    }

    public function getBooking($id)
    {
        return $this->find($id);
    }
     // Method to get the count of students for a specific booking date
    public function getTotalStudents($booking_time, $classroom_id)
    {
       
        return $this->select('COUNT(classroom_id) AS Total_Students')
                    ->where('booking_date', $booking_time)
                    ->where('classroom_id', $classroom_id)
                    ->get()
                    ->getRow()
                    ->Total_Students;
    }
}
?>
