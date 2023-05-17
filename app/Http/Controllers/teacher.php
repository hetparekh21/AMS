<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\classes;
use App\Models\att_jsons;
use App\Models\students;
use App\Models\sub_tech;
use App\Models\user;
use App\Models\subjects;
use App\Models\templates;
use App\Models\teachers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


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
                                        WHERE t.uid = ' . $teacher->id . ';');

        $total_courses = $total_courses[0]->{'COUNT(DISTINCT(c.course_id))'};

        $subject_id = sub_tech::join('teachers','sub_tech.teacher_id','teachers.teacher_id')->where('teachers.uid',$teacher->id)->get('subject_id')->toarray();

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
        $total_stu_str = $a[1];
        $total_class = $a[2];

        return view('teacher/teacher_dashboard', compact('teacher_name', 'total_classes', 'total_courses', 'total_subjects','avg','total_stu_str','total_class'));
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

    public function create_teacher(Request $req)
    {

        $req->validate([
            'teacher_name' => 'required',
            'teacher_email' => 'required',
        ]);

        $subject_id = $req->subject_id;

        $teacher_name = $req->teacher_name;
        $teacher_email = $req->teacher_email;
        $password = rand_pass();

        if (User::where('email', $teacher_email)->count() != 0) {
            $status = "danger";
            $message = "Eamil already exists";
        } else {

            // create user
            $user = new User;
            $user->email = $teacher_email;
            $user->role_id = 2;
            $user->password = Hash::make($password);
            $user->pass_ = $password;
            $user->save();

            $user_id = $user->id;

            // create teacher
            $teacher = new teachers;
            $teacher->uid = $user_id;
            $teacher->teacher_name = $teacher_name;
            $teacher->save();

            if ($subject_id == null || $subject_id == '' || subjects::where('subject_id', $subject_id)->count() == 0) {

                $teacher_id = $teacher->teacher_id;

                update_teacher($subject_id, $teacher_id);
            }

            $status = "success";
            $message = "Teacher created successfully";
        }

        $notification = [$status, $message];

        return redirect()->route('admin.teacher')->with('notification', $notification);
    }

    public function edit_teacher(Request $req)
    {

        $req->validate([
            'teacher_id' => 'required',
            'teacher_name' => 'required',
            'teacher_email' => 'required',
        ]);

        $teacher_id = $req->teacher_id;
        $teacher_name = $req->teacher_name;
        $teacher_email = $req->teacher_email;
        $pass_regen = $req->has('pass_regen');
        $password = rand_pass();

        $resuest = Request::create(route('get.teacher', $teacher_id), 'GET');
        $response = Route::dispatch($resuest);

        $teacher = json_decode($response->getContent(), true);
        $teacher = $teacher[0];

        if ($teacher['email'] != $teacher_email && User::where('email', $teacher_email)->count() != 0) {
            $status = "danger";
            $message = "Eamil already exists";
        } else {

            if (!$pass_regen) {
                $password = $teacher['pass_'];
            }
            // update user
            $user_id = teachers::where('teacher_id', $teacher_id)->get('uid')->toArray();
            $user = User::where('id', $user_id[0]['uid'])->update([
                'email' => $teacher_email,
                'password' => Hash::make($password),
                'pass_' => $password
            ]);

            // update teacher
            $teacher = teachers::where('teacher_id', $teacher_id)->update([
                'teacher_name' => $teacher_name
            ]);

            $status = "success";
            $message = "Teacher updated successfully";
        }

        $notification = [$status, $message];

        return redirect()->route('admin.teacher')->with('notification', $notification);

    }

    public function delete_teacher($teacher_id)
    {
        $id = teachers::where('teacher_id', $teacher_id)->get('uid')->toArray();

        // delete sub_tech data
        sub_tech::where('teacher_id', $teacher_id)->delete();

        // delete template data
        templates::where('teacher_id', $teacher_id)->delete();

        // delete teacher data
        teachers::where('teacher_id', $teacher_id)->delete();

        // delete user data
        // dump($id);die;
        user::where('id', $id[0]['uid'])->delete();

        return redirect()->route('admin.teacher')->with('notification', ['success', 'Teacher deleted successfully']);

    }

    public function assign_subject(Request $req)
    {

        $req->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
        ]);

        $teacher_id = $req->teacher_id;
        $subject_id = $req->subject_id;

        $teacher = teachers::where('teacher_id', $teacher_id)->get('teacher_name')->toArray();
        $subject = subjects::where('subject_id', $subject_id)->get('subject_name')->toArray();

        update_teacher($subject_id, $teacher_id);

        $status = "success";
        $message = $subject[0]['subject_name'] . " assigned successfully to " . $teacher[0]['teacher_name'];

        $notification = [$status, $message];

        return redirect()->route('admin.teacher')->with('notification', $notification);

    }

    public function remove_subject(Request $req)
    {

        $req->validate([
            'teacher_id' => 'required',
            'subject_id' => 'required',
        ]);

        $teacher_id = $req->teacher_id;
        $subject_id = $req->subject_id;

        $teacher = teachers::where('teacher_id', $teacher_id)->get('teacher_name')->toArray();
        $subject = subjects::where('subject_id', $subject_id)->get('subject_name')->toArray();

        update_teacher($subject_id, null);

        $status = "success";
        $message = $subject[0]['subject_name'] . " unassigned successfully from " . $teacher[0]['teacher_name'];

        $notification = [$status, $message];

        return redirect()->route('admin.teacher')->with('notification', $notification);

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

        $code = get_unique_code();
    } else {

        return $code;
    }

    return $code;
}