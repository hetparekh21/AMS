<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\classes;
use App\Models\att_jsons;
use App\Models\courses;
use App\Models\students;
use App\Models\subjects;
use App\Models\templates;
use App\Models\teachers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class teacher extends Controller
{

    public function teacher_dashboard()
    {

        $teacher = Auth::user();
        $teacher_name = $teacher->name;

        $total_classes = classes::join('subjects', 'subjects.subject_id', 'classes.subject_id')
            ->join('sub_tech', 'sub_tech.subject_id', 'subjects.subject_id')
            ->join('teachers', 'teachers.teacher_id', 'sub_tech.teacher_id')
            ->where('teachers.uid', $teacher->id)->get('class_id')->count();

        $total_subjects = subjects::join('sub_tech', 'sub_tech.subject_id', 'subjects.subject_id')
            ->join('teachers', 'teachers.teacher_id', 'sub_tech.teacher_id')
            ->where('teachers.uid', $teacher->id)->get('subjects.subject_id')->count();

        $total_courses = DB::select('SELECT
                                        COUNT(DISTINCT(c.course_id))
                                    FROM
                                        courses c
                                    JOIN subjects s ON
                                        s.course_id = c.course_id
                                    JOIN sub_tech st ON
                                        st.subject_id = s.subject_id
                                    JOIN teachers t ON
                                        t.teacher_id = st.teacher_id
                                        WHERE t.uid = '. $teacher->id .';');

        $total_courses = $total_courses[0]->{'COUNT(DISTINCT(c.course_id))'};

        return view('teacher/teacher_dashboard', compact('teacher_name', 'total_classes','total_courses', 'total_subjects'));
    }

    public function teacher_class()
    {

        // get classes 
        $teacher = Auth::user();
        $resuest = Request::create(route('get.teacher.classes', $teacher->id), 'POST');
        $response = Route::dispatch($resuest);

        $classes = json_decode($response->getContent(), true);
        // $classes = $response->getContent();

        // get templates
        $resuest = Request::create(route('get.templates', $teacher->id), 'get');
        $response = Route::dispatch($resuest);
        $templates = json_decode($response->getContent(), true);

        $c = new Collection($classes);

        $classes = $c->paginate(10);

        return view('teacher/teacher_class', compact('classes', 'templates'));
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

    // template handling

    public function create_template(Request $req)
    {

        $req->validate([
            'course_template' => 'required',
            'semester_template' => 'required',
            'subject_template' => 'required'
        ]);

        $teacher = Auth::user();

        // get course , semester and subject
        $teacher_id = teachers::where('uid', $teacher->id)->get('teacher_id');
        $course = $_POST['course_template'];
        $semester = $_POST['semester_template'];
        $subject = $_POST['subject_template'];

        // insert into templates


        $template = new templates;
        $template->teacher_id = $teacher_id[0]['teacher_id'];
        $template->subject_id = $subject;
        $template->save();

        return redirect()->route('teacher.class');
    }

    public function handel_template($id)
    {

        if ($_POST['action'] == 'Delete') {

            templates::where('id', $id)->delete();
        } elseif ($_POST['action'] == 'Initiate') {

            // $template = templates::where('id', $id)->get()->toArray();
            $template = templates::join('subjects', 'subjects.subject_id', 'templates.subject_id')->where('templates.id', $id)->get(['subjects.subject_id', 'subjects.course_id', 'subjects.semester_id'])->toarray();

            // insert into class
            $class_code = get_unique_code();

            $class = new classes;
            $class->subject_id = $template[0]['subject_id'];
            $class->class_code = $class_code;
            $class->save();

            $class_id = classes::where('class_code', $class_code)->get('class_id')->toArray();

            // get all the students for this course and semester

            $json_objs = Students::where('course_id', $template[0]['course_id'])
                ->where('semester_id', $template[0]['semester_id'])
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
        }

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
