<?php

namespace App\Controllers;

use App\Models\ClassroomModel;
use CodeIgniter\RESTful\ResourceController;

class Classrooms extends ResourceController
{
    protected $modelName = 'App\Models\ClassroomModel';
    protected $format    = 'json';

    public function index()
    {
        $classrooms = $this->model->getAllClassrooms();
        return $this->respond($classrooms);
    }

    public function timetable()
    {
        $classrooms = $this->model->getAllClassrooms();
        $response = [];

        foreach ($classrooms as $classroom) {
            $timetable = json_decode($classroom['timetable'], true);
            $response[] = [
                'classroom' => $classroom['name'],
                'timetable' => $timetable
            ];
        }

        return $this->respond($response);
    }
    public function ClassroomByName(){



        $classroomName = $_REQUEST['classroom_name'];

        $classroom = $this->model->getClassroomByName($classroomName);
        $response = [];
        
        
            $timetable = json_decode($classroom['timetable'], true);
            $response[] = [
                'classroom' => $classroom['name'],
                'timetable' => $timetable
            ];
        

        return $this->respond($response);

    }


    
}
?>
