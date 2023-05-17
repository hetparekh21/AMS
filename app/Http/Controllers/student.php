<?php

namespace App\Http\Controllers;

use App\Models\att_jsons;
use App\Models\students;
use App\Models\classes;
use App\Models\courses;
use App\Models\dynamic_mapper;
use App\Models\semesters;
use App\Models\subjects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class student extends Controller
{
    public function student_dashboard($student_id = null)
    {
        if ($student_id == null) {
            $student_id = Auth::user()->id;
        }

        $user_role = Auth::user()->role_id;

        $data = students::join('courses', 'courses.course_id', 'students.course_id')
            ->join('semesters', 'semesters.semester_id', 'students.semester_id')
            ->where('students.uid', $student_id)
            ->get(['students.student_id', 'students.roll_no', 'students.student_name', 'courses.course_id', 'courses.course_name', 'semesters.semester_id', 'semesters.semester_name'])->toarray();

        $data = $data[0];

        $subjects = subjects::where('course_id', $data['course_id'])->where('semester_id', $data['semester_id'])->get(['subject_id', 'subject_name', 'subject_code'])->toarray();

        foreach ($subjects as $key => $value) {
            $subjects[$key]['classes'] = classes::where('subject_id', $value['subject_id'])->count();
        }

        $student_id = $data['student_id'];

        $subject_id = subjects::where('course_id', $data['course_id'])->where('semester_id', $data['semester_id'])->get('subject_id')->toarray();

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

        $a = get_average_attendance($student_id, $jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

        $avg = $a[0];
        $total_classes = $a[1];

        // dump($avg,$total_classes);die;

        return view('student.student_dashboard', compact('data', 'subjects', 'avg', 'total_classes', 'user_role'));
    }

    public function mark_attendance($class_code, $dynamic_code)
    {

        $msg = "";
        $status = "";

        // auth student
        $user = Auth::user();
        $student = students::where('uid', $user->id)->first();
        $student_id = $student->student_id;
        $class_id = classes::where('class_code', $class_code)->get('class_id')->toarray();

        if (empty($class_id)) {
            $msg .= "Invalid Class Code";
            $status = "danger";

        } else {
            $class_id = $class_id[0]['class_id'];
            // check if student is enrolled in class
            $deets = classes::join('subjects', 'subjects.subject_id', 'classes.subject_id')->where('classes.class_id', $class_id)->get(['subjects.course_id', 'subjects.semester_id'])->toarray();

            $course_id = $deets[0]['course_id'];
            $semester_id = $deets[0]['semester_id'];

            if ($course_id != $student->course_id || $semester_id != $student->semester_id) {
                $msg .= "You are not enrolled in this class";
                $status = "danger";
            } else {

                $mapper = dynamic_mapper::where('class_code', $class_code)->where('dynamic_code', $dynamic_code)->get('Timestamp');

                if ($mapper->isEmpty()) {
                    $msg .= "Invalid QR Code";
                    $status = "danger";
                } else {

                    $mapper = $mapper->toarray();
                    $mapper = $mapper[0]['Timestamp'];

                    // set default timezone
                    date_default_timezone_set('Asia/Kolkata');

                    // check if mapper is expired
                    $mapper = strtotime($mapper);
                    // $mapper = $mapper + 30;
                    $now = $_SERVER['REQUEST_TIME'];

                    if ($mapper > $now || $now > ($mapper + 30)) {
                        $msg .= "QR Code Expired";
                        $status = "danger";
                    } else {

                        $msg .= "Attendance Marked Successfully for " . $class_code;
                        $status = "success";

                    }

                }

            }

        }




        return view('show', compact('msg', 'status'));
    }

    public function create_student(Request $req)
    {

        $req->validate([
            'roll_no' => 'required',
            'student_name' => 'required',
            'course_id' => 'required',
            'semester_id' => 'required',
            'email' => 'required',
        ]);

        $roll_no = $req->input('roll_no');
        $student_name = $req->input('student_name');
        $course_id = $req->input('course_id');
        $semester_id = $req->input('semester_id');
        $email = $req->input('email');
        $password = rand_pass();

        // check roll no and email if already exists

        $student = students::join("users", "students.uid", "users.id")->where('roll_no', $roll_no)->orWhere('users.email', $email)->get();

        if ($student->isEmpty()) {

            // check if course and semester exists
            $course = courses::where('course_id', $course_id)->get();
            $semester = semesters::where('semester_id', $semester_id)->get();

            if ($course->isEmpty() || $semester->isEmpty()) {
                $status = "danger";
                $message = "Invalid Course or Semester";
            } else {

                // create user
                $user = new User;
                $user->email = $email;
                $user->role_id = 3;
                $user->password = Hash::make($password);
                $user->pass_ = $password;
                $user->save();

                $user_id = $user->id;

                $student = new students;
                $student->uid = $user_id;
                $student->roll_no = $roll_no;
                $student->student_name = $student_name;
                $student->course_id = $course_id;
                $student->semester_id = $semester_id;
                $student->save();

                $status = "success";
                $message = "Student Created Successfully";

            }

        } else {
            $status = "danger";
            $message = "Student email or enrollment no. Already Exists";
        }

        return redirect()->route('admin.student')->with('notification', [$status, $message]);

    }

    public function edit_student(Request $req)
    {

        $req->validate([
            'student_id' => 'required',
            'student_name' => 'required',
            'semester_id' => 'required',
            'email' => 'required',
        ]);

        $student_id = $req->input('student_id');
        $uid = students::where("student_id", $student_id)->get('uid');

        $resuest = Request::create(route('get.student.id', $student_id));
        $response = Route::dispatch($resuest);
        $student = json_decode($response->getContent(), true);
        $student = $student[0];

        $student_name = $req->input('student_name');
        $semester_id = $req->input('semester_id');
        $email = $req->input('email');
        $password = rand_pass();

        $pass_regen = $req->has('pass_regen');

        // check if email already exists
        if ($student['email'] != $email && User::where('email', $email)->count() != 0) {
            $status = "danger";
            $message = "Eamil already exists";
        } else {

            if (!$pass_regen) {
                $password = $student['pass_'];
            }
            // update user
            $user_id = students::where('student_id', $student_id)->get('uid')->toArray();
            $user = User::where('id', $user_id[0]['uid'])->update([
                'email' => $email,
                'password' => Hash::make($password),
                'pass_' => $password
            ]);

            // update student
            $teacher = students::where('student_id', $student_id)->update([
                'student_name' => $student_name,
                'semester_id' => $semester_id
            ]);

            $status = "success";
            $message = "Student updated successfully";

        }

        return redirect()->route('admin.student')->with('notification', [$status, $message]);

    }

    public function delete_student(Request $req)
    {



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