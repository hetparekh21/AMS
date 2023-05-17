<?php

namespace App\Http\Controllers;

use App\Models\att_jsons;
use App\Models\courses;
use App\Models\students;
use App\Models\subjects;
use App\Models\teachers;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class admin extends Controller
{
    public function admin_dashboard()
    {
        // count courses
        $courses = courses::count();

        // count subjects
        $subjects = subjects::count();

        // count teachers
        $teachers = teachers::count();

        // count students
        $students = students::count();

        // count classes
        $classes = DB::table('classes')->count();

        $data = [
            'courses' => $courses,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'students' => $students,
            'classes' => $classes
        ];

        // all subject_id
        $subject_id = subjects::get('subject_id')->toarray();

        $subject_id = array_column($subject_id, 'subject_id');

        $jan = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 1 and year(date) = year(curdate())')->get('att_json');
        $feb = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 2 and year(date) = year(curdate())')->get('att_json')->toarray();
        $mar = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 3 and year(date) = year(curdate())')->get('att_json')->toarray();
        $apr = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 4 and year(date) = year(curdate())')->get('att_json')->toarray();
        $may = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 5 and year(date) = year(curdate())')->get('att_json')->toarray();
        $jun = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 6 and year(date) = year(curdate())')->get('att_json')->toarray();
        $jul = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 7 and year(date) = year(curdate())')->get('att_json')->toarray();
        $aug = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 8 and year(date) = year(curdate())')->get('att_json')->toarray();
        $sep = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 9 and year(date) = year(curdate())')->get('att_json')->toarray();
        $oct = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 10 and year(date) = year(curdate())')->get('att_json')->toarray();
        $nov = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 11 and year(date) = year(curdate())')->get('att_json')->toarray();
        $dec = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->wherein('classes.subject_id', $subject_id)->whereraw('month(date) = 12 and year(date) = year(curdate())')->get('att_json')->toarray();

        $total_stu = round(students::join('courses', 'students.course_id', 'courses.course_id')->join('subjects', 'subjects.course_id', 'courses.course_id')->where('subjects.subject_id', $subject_id)->get('students.student_id')->count());

        $a = get_average($total_stu, $jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

        $avg = $a[0];
        // $total_stu_str = $a[1];
        $total_class = $a[2];

        return view('admin.admin_dashboard',compact('data','avg','total_class'));
    }

    public function admin_course()
    {

        $courses = courses::get(['course_name', 'course_code', 'course_id', 'semesters']);

        return view('admin.admin_course', compact('courses'));
    }

    public function admin_subject()
    {

        $subjects = subjects::leftjoin('courses', 'courses.course_id', 'subjects.course_id')
            ->leftjoin('semesters', 'subjects.semester_id', 'semesters.semester_id')
            ->leftjoin('sub_tech', 'sub_tech.subject_id', 'subjects.subject_id')
            ->leftjoin('teachers', 'teachers.teacher_id', 'sub_tech.teacher_id')
            ->get(['subjects.subject_name', 'subjects.subject_code', 'subjects.subject_id', 'courses.course_name', 'semesters.semester_name', 'teachers.teacher_name' ])->toarray();

        $teachers = teachers::get(['teacher_id', 'teacher_name'])->toarray();

        return view('admin.admin_subject', compact('subjects', 'teachers'));
    }

    public function admin_teacher()
    {

        $teachers = DB::select('select t.teacher_id , t.teacher_name , u.email , u.pass_ ,(select count(*) from sub_tech st where st.teacher_id = t.teacher_id) as subs from users u JOIN teachers t on t.uid = u.id');
        

        $subjects = subjects::leftjoin('sub_tech', 'sub_tech.subject_id', 'subjects.subject_id')
        ->leftjoin('teachers', 'teachers.teacher_id', 'sub_tech.teacher_id')
        ->where('subjects.course_id','!=',null)
        ->get(['subjects.subject_name', 'subjects.subject_id', 'teachers.teacher_name']);

        // echo "<pre>";
        // print_r($teachers);die;

        return view('admin.admin_teacher', compact('teachers','subjects'));
    }

    public function admin_student(Request $req)
    {

        $user = Auth::user();
        $user_role = $user->role_id;
        $uid = $user->id;

        $query = $req->input('query') ?? '';

        // get students
        $resuest = Request::create(route('get.students', $uid), 'POST');
        $response = Route::dispatch($resuest);
        $students = json_decode($response->getContent(), true);

        // courses
        $courses = courses::get(['course_name', 'course_id'])->toarray();

        $c = new Collection($students);
        $students = $c->paginate(10);

        return view('admin.admin_student',compact('students','query','courses'));
    }

}
