<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\classes;
use App\Models\User;

class classes_api extends Controller
{
    private static $limit = 10;

    public function get_teacher_classes($uid)
    {
        $user = User::where('id', $uid)->get('role_id')->toarray();

        $classes = DB::select('SELECT t.teacher_id ,c.class_id, c.class_code, s.subject_name, c.date, se.semester_name from classes c
                    INNER JOIN subjects s ON s.subject_id = c.subject_id
                    INNER JOIN sub_tech st ON st.subject_id = s.subject_id
                    INNER JOIN teachers t ON t.teacher_id = st.teacher_id
                    INNER JOIN semesters se ON se.semester_id = s.semester_id
                    where t.uid = ' . $uid . ' ORDER BY c.date DESC LIMIT ' . classes_api::$limit . ';');

        return response()->json($classes);
    }

    public function get_classes(Request $req, $uid)
    {

        $query = $req->input('query') ?? ' ';

        $user = User::where('id', $uid)->get('role_id')->toarray();

        // dd($user[0]['role_id']);

        if ($user[0]['role_id'] == 1) {

            $classes = DB::select('SELECT t.teacher_id ,c.class_id, c.class_code, s.subject_name, c.date, se.semester_name 
                from classes c
                INNER JOIN subjects s ON s.subject_id = c.subject_id
                INNER JOIN sub_tech st ON st.subject_id = s.subject_id
                INNER JOIN teachers t ON t.teacher_id = st.teacher_id
                INNER JOIN courses co ON co.course_id = s.course_id
                INNER JOIN semesters se ON se.semester_id = s.semester_id
                where c.class_id 
                LIKE "' . $query . '%" OR CONVERT(c.date,varchar(20))
                LIKE "' . $query . '%" OR c.class_code 
                LIKE "' . $query . '%" OR s.subject_name 
                LIKE "%' . $query . '%" OR se.semester_name 
                LIKE "%' . $query . '%" OR co.course_name 
                LIKE "%' . $query . '%" ;');
        } else {

            $classes = DB::select('SELECT
                a.teacher_id,
                a.class_id,
                a.class_code,
                a.subject_name,
                a.date,
                a.semester_name
            FROM
                (SELECT
                t.teacher_id,
                c.class_id,
                c.class_code,
                 co.course_name,
                s.subject_name,
                c.date,
                se.semester_name
            FROM
                classes c
            INNER JOIN subjects s ON
                s.subject_id = c.subject_id
            INNER JOIN sub_tech st ON
                st.subject_id = s.subject_id
            INNER JOIN teachers t ON
                t.teacher_id = st.teacher_id
            INNER JOIN courses co ON
                co.course_id = s.course_id
            INNER JOIN semesters se ON
                se.semester_id = s.semester_id
                WHERE t.uid = '. $uid .'
                )
                a
            WHERE
                a.class_id LIKE "' . $query . '%" OR CONVERT(a.date, VARCHAR(20)) 
                LIKE "%' . $query . '%" OR a.class_code 
                LIKE "' . $query . '%" OR a.subject_name 
                LIKE "' . $query . '%" OR a.semester_name 
                LIKE "%' . $query . '%" OR a.course_name 
                LIKE "' . $query . '%" ;');
        }

        return response()->json($classes);
    }
}
