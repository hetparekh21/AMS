<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\classes;
use App\Models\User;

class classes_api extends Controller
{
    private static $limit = 10 ;

    public static function get_classes(Request $req, $uid)
    {

        $query = $req->input('query') ?? '';

        $user = User::where('id', $uid)->get('role_id')->toarray();

        if ($user[0] == 1) {

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

            if ($query == '') {

                $classes = DB::select('SELECT t.teacher_id ,c.class_id, c.class_code, s.subject_name, c.date, se.semester_name from classes c
                    INNER JOIN subjects s ON s.subject_id = c.subject_id
                    INNER JOIN sub_tech st ON st.subject_id = s.subject_id
                    INNER JOIN teachers t ON t.teacher_id = st.teacher_id
                    INNER JOIN semesters se ON se.semester_id = s.semester_id
                    where t.uid = ' . $uid . ' ORDER BY c.date LIMIT '. classes_api::$limit .';');
            } else {

                $classes = DB::select('SELECT t.teacher_id ,c.class_id, c.class_code, s.subject_name, c.date, se.semester_name from classes c
                    INNER JOIN subjects s ON s.subject_id = c.subject_id
                    INNER JOIN sub_tech st ON st.subject_id = s.subject_id
                    INNER JOIN teachers t ON t.teacher_id = st.teacher_id
                    INNER JOIN courses co ON co.course_id = s.course_id
                    INNER JOIN semesters se ON se.semester_id = s.semester_id
                    where c.class_id 
                    LIKE "' . $query . '%" OR CONVERT(c.date,varchar(20))
                    LIKE "%' . $query . '%" OR c.class_code 
                    LIKE "' . $query . '%" OR s.subject_name 
                    LIKE "' . $query . '%" OR se.semester_name 
                    LIKE "%' . $query . '%" OR co.course_name 
                    LIKE "' . $query . '%" and t.teacher_id = ' . $uid . ';');
            }
        }

        return response()->json($classes);
    }
}
