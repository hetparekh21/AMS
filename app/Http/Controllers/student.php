<?php

namespace App\Http\Controllers;

use App\Models\students;
use App\Models\classes;
use App\Models\dynamic_mapper;
use App\Models\semesters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class student extends Controller
{
    public function student_dashboard()
    {
        return view('student/student_dashboard');
    }

    public function mark_attendance($class_code, $dynamic_code)
    {

        $error = "";
        $status = "";

        // auth student
        $user = Auth::user();

        // get student
        $student =  students::where('uid', $user->id)->first();

        // get student id
        $student_id = $student->student_id;

        // get class id
        $class_id = classes::where('class_code', $class_code)->get('class_id')->toarray();

        if (!empty($class_id)) {
            $class_id = $class_id[0]['class_id'];
        } else {
            $error .= "Invalid Class Code";
            return "Error : " . $error . "<br>" . "Status : " . $status;
        }

        // check if student is enrolled in class
        $deets = classes::join('subjects', 'subjects.subject_id', 'classes.subject_id')->where('classes.class_id', $class_id)->get(['subjects.course_id', 'subjects.semester_id'])->toarray();

        $course_id = $deets[0]['course_id'];
        $semester_id = $deets[0]['semester_id'];

        if ($course_id == $student->course_id && $semester_id == $student->semester_id) {
            echo "you'er good" . "<br>";
        } else {
            $error .= "You are not enrolled in this class";
            return "Error : " . $error . "<br>" . "Status : " . $status;
        }

        // check mapper 

        $mapper = dynamic_mapper::where('class_code', $class_code)->where('dynamic_code', $dynamic_code)->get('Timestamp');

        if ($mapper->isEmpty()) {
            $error .= "Invalid QR Code";
            return "Error : " . $error . "<br>" . "Status : " . $status;
        }

        $mapper = $mapper->toarray();
        $mapper = $mapper[0]['Timestamp'];

        // set default timezone
        date_default_timezone_set('Asia/Kolkata');

        // check if mapper is expired
        $mapper = strtotime($mapper);
        // $mapper = $mapper + 30;
        $now = $_SERVER['REQUEST_TIME'];

        echo $mapper . "<br>" . $now . "<br>";

        if ($mapper < $now && $now < ($mapper + 30)) {
            echo "Present";
        } else {
            $error .= "QR Code Expired";
            return "Error : " . $error . "<br>" . "Status : " . $status;
        }


        return view('show');
    }
}

function distance($lat1, $lng1, $lat2, $lng2)
{
    $earthRadius = 6371; // km
    $dLat = deg2rad($lat2 - $lat1);
    $dLng = deg2rad($lng2 - $lng1);
    $a = sin($dLat / 2) * sin($dLat / 2) +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        sin($dLng / 2) * sin($dLng / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earthRadius * $c;
    return $distance;
}
