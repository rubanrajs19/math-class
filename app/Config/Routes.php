<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', 'Home::index');
$routes->get('classrooms', 'Classrooms::index');
$routes->get('classrooms/timetable', 'Classrooms::timetable');
$routes->post('bookings/create', 'Bookings::create');
$routes->delete('bookings/delete/(:num)', 'Bookings::delete/$1');


$routes->get('bookings/total_students', 'Bookings::totalStudents');
$routes->get('classrooms/classroomname', 'Classrooms::ClassroomByName');



