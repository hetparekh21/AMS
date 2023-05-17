<?php

namespace App\Http\Controllers\apis;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\classes;
use App\Models\User;

class student_api extends Controller
{
    public function get_students(Request $req, $uid)
    {

        $query = $req->input('query') ?? ' ';

        $user = User::where('id', $uid)->get('role_id')->toarray();

        // dd($user[0]['role_id']);

        if ($user[0]['role_id'] == 1) {

            $students = DB::select('SELECT
            DISTINCT(stu.roll_no),
            stu.student_id,
            stu.uid,
            us.email,
            us.pass_,
            stu.student_name,
            c.course_name,
            se.semester_name
            FROM
            students stu join courses c on stu.course_id = c.course_id
            JOIN users us ON stu.uid = us.id
            join subjects s on s.course_id = c.course_id
            join semesters se on se.semester_id = stu.semester_id
            join sub_tech st on st.subject_id = s.subject_id 
            join teachers t on t.teacher_id = st.teacher_id
            WHERE
            stu.roll_no LIKE "%' . $query . '%" 
            OR us.email LIKE "' . $query . '%" 
            OR stu.student_name LIKE "' . $query . '%" 
            OR s.subject_name LIKE "%' . $query . '%" 
            OR se.semester_name LIKE "%' . $query . '%" OR c.course_name ;');
            
        } else {

            $students = DB::select('SELECT
            a.roll_no,
            a.student_name,
            a.course_name,
            a.semester_name,
            a.uid
        FROM
            (
            SELECT DISTINCT(stu.uid),
                stu.student_name,
                stu.roll_no,
                c.course_name,
                se.semester_name
            FROM
                students stu
            JOIN courses c ON
                stu.course_id = c.course_id
            JOIN subjects s ON
                s.course_id = c.course_id
            JOIN semesters se ON
                se.semester_id = stu.semester_id
            JOIN sub_tech st ON
                st.subject_id = s.subject_id
            JOIN teachers t ON
                t.teacher_id = st.teacher_id
            WHERE
                t.uid = '. $uid .'
        ) a
        WHERE
            a.roll_no LIKE "%'.$query.'%" OR a.student_name LIKE "'.$query.'%" OR a.semester_name LIKE "%'.$query.'%" OR a.course_name LIKE "'.$query.'%";');
        }

        // dump($students);die;

        return response()->json($students);
    }

    public function get_student_by_id(Request $req ,$student_id = null){

        if($student_id == null){
            $student_id = $req->input('student_id');
        }

        if($student_id != null || $student_id != ""){
            
            $student = DB::select('SELECT
            DISTINCT(stu.roll_no),
            stu.student_id,
            us.email,
            us.pass_,
            stu.student_name,
            c.course_id,
            c.course_name,
            se.semester_name,
            se.semester_id
            FROM
            students stu join courses c on stu.course_id = c.course_id
            JOIN users us ON stu.uid = us.id
            join subjects s on s.course_id = c.course_id
            join semesters se on se.semester_id = stu.semester_id
            join sub_tech st on st.subject_id = s.subject_id 
            join teachers t on t.teacher_id = st.teacher_id
            WHERE
            stu.student_id = '. $student_id .';');
    
        }
            return response()->json($student);
    } 
}
