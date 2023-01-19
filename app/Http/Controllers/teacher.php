<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\classes;
use App\Models\att_jsons;
use App\Models\students;

class teacher extends Controller
{

    public function teacher_dashboard()
    {

        return view('teacher/teacher_dashboard');
    }

    public function teacher_class()
    {

        $teacher = Auth::user(); 

        $resuest = Request::create(route('get.classes',$teacher->id),'GET');
        $response = Route::dispatch($resuest);

        $classes = json_decode($response->getContent(),true);
        
        return view('teacher/teacher_class', compact('classes'));
    }

    public function teacher_account_settings()
    {
        return view('teacher/teacher_account_settings');
    }

    public function initiate_class(Request $req)
    {

        $req->validate([
            'course_class' => 'required',
            'semester_class' => 'required',
            'subject_class' => 'required'
        ]);

        // get course , semester and subject
        $course = $_POST['course_class'];
        $semester = $_POST['semester_class'];
        $subject = $_POST['subject_class'];

        // insert into class
        $class_code = get_unique_code();

        $class = new classes;
        $class->subject_id = $subject;
        $class->class_code = $class_code;
        $class->save();

        $class_id = classes::where('class_code', $class_code)->get('class_id')->toArray();

        // get all the students for this course and semester

        $json_objs = Students::where('course_id', $course)
            ->where('semester_id', $semester)
            ->selectRaw('JSON_OBJECT(student_id, 0) as json_objs')
            ->get()->toArray();

        $encoded = get_clean_json($json_objs);

        // echo $encoded;

        // insert into att_json
        $att_json = new att_jsons;
        $att_json->class_id = $class_id[0]['class_id'];
        $att_json->att_json = ($encoded == '' ? '{}' : $encoded);
        $att_json->save();

        session()->flash('qr', $class_code);

        return redirect()->route('teacher.class');
    }
}

function get_clean_json($json_objs)
{


    $encoded = json_encode($json_objs);

    $encoded = str_replace('{"json_objs":"', '', $encoded);
    $encoded = str_replace('"}', '', $encoded);
    $encoded = str_replace('[', '', $encoded);
    $encoded = str_replace(']', '', $encoded);
    $encoded = str_replace('},{', ',', $encoded);
    $encoded = str_replace('\"', '"', $encoded);

    return $encoded;
}

function get_unique_code(): string
{

    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

    $result = classes::where('class_code', $code)->get('class_code');

    if (!$result->isEmpty()) {

        $code =  get_unique_code();
    } else {

        return $code;
    }

    return $code;
}
