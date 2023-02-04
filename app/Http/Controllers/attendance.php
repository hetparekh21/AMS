<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// Models
use App\Models\att_jsons;
use App\Models\classes;
use App\Models\students;
use Illuminate\Database\Eloquent\Collection;

class attendance extends Controller
{

    public function class_attendance($class_id)
    {
        $user = Auth::user();
        $user_role = $user->role_id;

        // getting class code , subject name , date , semester name , course name
        $class = classes::join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
            ->join('courses', 'courses.course_id', '=', 'subjects.course_id')
            ->join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')
            ->where('class_id', $class_id)->get(['class_code', 'subject_name', 'date', 'semester_name', 'course_name'])->toarray();

        // getting attendance data
        $att_json = att_jsons::where('class_id', $class_id)->get('att_json')->toarray();
        $whole = json_decode($att_json[0]['att_json'], true);
        $id = array_keys($whole);
        $attendance_whole = array_values($whole);

        // for pie chart
        $present = 0;
        $absent = 0;
        $suspicious = 0;

        foreach ($attendance_whole as $data) {
            if ($data == 1) {
                $present++;
            } else if ($data == 0) {
                $absent++;
            } else if ($data == 2) {
                $suspicious++;
            }
        }

        // getting student names
        $query_names = students::whereIn('student_id', $id)->get('student_name')->toarray();
        $names = array_column($query_names, 'student_name');

        $attendance = array();

        // combining all data in one array
        for ($i = 0; $i < count($attendance_whole); $i++) {

            $attendance[$i] = array(
                'id' => $id[$i],
                'name' => $names[$i],
                'attendance' => $attendance_whole[$i]
            );
        }


        $c = new Collection($attendance);

        $attendance = $c->paginate(10);

        return view('attendance.class_attendance', compact('attendance', 'present', 'absent', 'suspicious', 'class', 'class_id', 'user_role'));
    }

    public function mark_absent(Request $req)
    {
        // validate id the ids are empty
        $req->validate([
            'id_present' => 'required'
        ]);

        $ids = array();
        foreach ($_POST['id_present'] as  $value) {
            array_push($ids, $value);
        }

        $str = '';

        foreach ($ids as $id) {
            $str = $str . ',"$.' . $id . '",' . '0';
        }

        echo '<pre>';
        print_r($req->all());

        DB::table('att_jsons')
            ->where('class_id', $_POST['class_id'])
            ->update([
                'att_json' => DB::raw("JSON_SET(att_json" . $str . ")")
            ]);

        return redirect()->back();
    }

    public function mark_present(Request $req)
    {
        // validate id the ids are empty
        $req->validate([
            'id_absent' => 'required'
        ]);

        $ids = array();
        foreach ($_POST['id_absent'] as  $value) {
            array_push($ids, $value);
        }

        $str = '';

        foreach ($ids as $id) {
            $str = $str . ',"$.' . $id . '",' . '1';
        }

        DB::table('att_jsons')
            ->where('class_id', $_POST['class_id'])
            ->update([
                'att_json' => DB::raw("JSON_SET(att_json" . $str . ")")
            ]);

        return redirect()->back();
    }

    public function from_suspicious(Request $req)
    {
        // validate id the ids are empty
        $req->validate([
            'id_suspicious' => 'required'
        ]);

        $ids = array();
        foreach ($_POST['id_suspicious'] as  $value) {
            array_push($ids, $value);
        }

        // echo '<pre>';
        // print_r($ids);

        if ($req->input('present')) {

            echo 'present';

            $ids = array();
            foreach ($_POST['id_suspicious'] as  $value) {
                array_push($ids, $value);
            }

            $str = '';

            foreach ($ids as $id) {
                $str = $str . ',"$.' . $id . '",' . '1';
            }

            DB::table('att_jsons')
                ->where('class_id', $_POST['class_id'])
                ->update([
                    'att_json' => DB::raw("JSON_SET(att_json" . $str . ")")
                ]);

            return redirect()->back();
        } elseif ($req->input('absent')) {

            $ids = array();
            foreach ($_POST['id_suspicious'] as  $value) {
                array_push($ids, $value);
            }

            $str = '';

            foreach ($ids as $id) {
                $str = $str . ',"$.' . $id . '",' . '0';
            }

            DB::table('att_jsons')
                ->where('class_id', $_POST['class_id'])
                ->update([
                    'att_json' => DB::raw("JSON_SET(att_json" . $str . ")")
                ]);

            return redirect()->back();
        }
    }

    public function export($class_id)
    {
        // getting class code , subject name , date , semester name , course name
        $class = classes::join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
            ->join('courses', 'courses.course_id', '=', 'subjects.course_id')
            ->join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')
            ->where('class_id', $class_id)->get(['class_code', 'subject_name', 'date', 'semester_name', 'course_name'])->toarray();

        // getting attendance data
        $att_json = att_jsons::where('class_id', $class_id)->get('att_json')->toarray();
        $whole = json_decode($att_json[0]['att_json'], true);
        $id = array_keys($whole);
        $attendance_whole = array_values($whole);

        // getting student names and roll no
        $query_names = students::whereIn('student_id', $id)->get('student_name')->toarray();
        $query_rolls = students::whereIn('student_id', $id)->get('roll_no')->toarray();
        $names = array_column($query_names, 'student_name');
        $roll_no = array_column($query_rolls, 'roll_no');

        $attendance = array();

        // combining all data in one array
        for ($i = 0; $i < count($attendance_whole); $i++) {

            $attendance[$i] = array(
                'roll_no' => $roll_no[$i],
                'student_name' => $names[$i],
                'attendance' => $attendance_whole[$i]
            );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Class Details
        $sheet->setCellValue('A1', 'Class Code :');
        $sheet->setCellValue('B1', $class[0]['class_code']);

        $sheet->setCellValue('A2', 'Date :');
        $sheet->setCellValue('B2', $class[0]['date']);

        $sheet->setCellValue('A3', 'Course :');
        $sheet->setCellValue('B3', $class[0]['course_name']);

        $sheet->setCellValue('A4', 'Subject :');
        $sheet->setCellValue('B4', $class[0]['subject_name']);

        $sheet->setCellValue('A5', 'Semester :');
        $sheet->setCellValue('B5', $class[0]['semester_name']);

        // Set the headers for the columns
        $sheet->setCellValue('A7', 'Roll no');
        $sheet->setCellValue('B7', 'Student Name');
        $sheet->setCellValue('C7', 'Attendance');

        // Add the data to the sheet
        $row = 8;
        foreach ($attendance as $item) {
            $sheet->setCellValue('A' . $row, $item['roll_no']);
            $sheet->setCellValue('B' . $row, $item['student_name']);
            $sheet->setCellValue('C' . $row, $item['attendance'] == 1 ? 'P' : 'A');
            $row++;
        }

        // Save the spreadsheet as an Excel file
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="export.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
