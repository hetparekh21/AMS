<?php

namespace App\Http\Controllers;

use App\Models\students;
use App\Models\classes;
use App\Models\semesters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class student extends Controller
{
    public function student_dashboard()
    {
        return view('student/student_dashboard');
    }

    public function mark_attendance($class_code)
    {

        $error = "";
        $status = "";

        // auth student
        $user = Auth::user();

        // if($user->role_id != 3){
        //     $error .= "You are not a student";
        //     return "Error : " . $error . "<br>" . "Status : " . $status;
        // }

        // get student
        $student =  students::where('uid',$user->id)->first() ;

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
        $deets = classes::join('subjects','subjects.subject_id','classes.subject_id')->where('classes.class_id',$class_id)->get(['subjects.course_id','subjects.semester_id'])->toarray();

        $course_id = $deets[0]['course_id'];
        $semester_id = $deets[0]['semester_id'];

        if($course_id == $student->course_id && $semester_id == $student->semester_id ){
            echo "you'er good";
        }else{
            $error .= "You are not enrolled in this class";
            return "Error : " . $error . "<br>" . "Status : " . $status;
        }

        return view('show') ;

    }
}
