<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassroomModel extends Model
{
    protected $table = 'classrooms';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'capacity', 'timetable'];

    public function getAllClassrooms()
    {
        return $this->findAll();
    }

    public function getClassroomByName($name)
    {
        return $this->where('name', $name)->first();
    }
}
?>
