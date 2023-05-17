<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// excel
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Models
use App\Models\att_jsons;
use App\Models\classes;
use App\Models\students;
use App\Models\subjects;
use Illuminate\Database\Eloquent\Collection;

class attendance extends Controller
{

    public function attendance_index(Request $req)
    {
        $user = Auth::user();
        $user_role = $user->role_id;
        $uid = $user->id;
        $classes = array();

        $query = $req->input('query') ?? '';

        // get classes 
        $resuest = Request::create(route('get.classes', $uid), 'POst');
        $response = Route::dispatch($resuest);
        $classes = json_decode($response->getContent(), true);


        $c = new Collection($classes);
        $classes = $c->paginate(10);

        return view('attendance.attendance', compact('user_role', 'uid', 'classes', 'query'));
    }

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

        foreach ($attendance_whole as $data) {
            if ($data == 1) {
                $present++;
            } else if ($data == 0) {
                $absent++;
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

        return view('attendance.class_attendance', compact('attendance', 'present', 'absent', 'class', 'class_id', 'user_role'));
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

    public function subject_index()
    {

        $user = Auth::user();
        $user_role = $user->role_id;
        $uid = $user->id;

        $request = Request::create(route('get.all.subjects', $uid));
        $response = Route::dispatch($request);

        $subjects = json_decode($response->getContent(), true);

        return view('attendance.subject', compact('user_role', 'subjects'));
    }

    public function subject_attendance($subject_id)
    {

        $user = Auth::user();
        $user_role = $user->role_id;

        $subject = subjects::where('subject_id', $subject_id)->get()->toarray()[0];

        // dump($subject);die;

        if($subject['course_id'] == null){
            return redirect()->route('admin.subject')->with('notification', ['danger','Subject not assigned to a course yet']);
        }

        $subject_details = subjects::join('courses', 'subjects.course_id', 'courses.course_id')
            ->join('semesters', 'subjects.semester_id', 'semesters.semester_id')
            ->leftjoin('sub_tech', 'sub_tech.subject_id', 'subjects.subject_id')
            ->leftjoin('teachers', 'teachers.teacher_id', 'sub_tech.teacher_id')
            ->where('subjects.subject_id', $subject_id)
            ->get(['subject_name', 'semester_name', 'course_name', 'teachers.teacher_name'])->toarray();

        $total_classes = classes::where('subject_id', $subject_id)->count() ;

        $classes = classes::join('subjects', 'subjects.subject_id', 'classes.subject_id')->join('courses', 'courses.course_id', 'subjects.course_id')->join('semesters', 'semesters.semester_id', 'subjects.semester_id')->where('subjects.subject_id', $subject_id)->orderby('date', 'DESC')->limit(10)->get(['class_id', 'class_code', 'subject_name', 'semester_name', 'date'])->toarray();

        $jan = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 1 and year(date) = year(curdate())')->get('att_json')->toarray();
        $feb = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 2 and year(date) = year(curdate())')->get('att_json')->toarray();
        $mar = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 3 and year(date) = year(curdate())')->get('att_json')->toarray();
        $apr = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 4 and year(date) = year(curdate())')->get('att_json')->toarray();
        $may = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 5 and year(date) = year(curdate())')->get('att_json')->toarray();
        $jun = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 6 and year(date) = year(curdate())')->get('att_json')->toarray();
        $jul = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 7 and year(date) = year(curdate())')->get('att_json')->toarray();
        $aug = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 8 and year(date) = year(curdate())')->get('att_json')->toarray();
        $sep = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 9 and year(date) = year(curdate())')->get('att_json')->toarray();
        $oct = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 10 and year(date) = year(curdate())')->get('att_json')->toarray();
        $nov = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 11 and year(date) = year(curdate())')->get('att_json')->toarray();
        $dec = att_jsons::join('classes', 'att_jsons.class_id', 'classes.class_id')->where('classes.subject_id', $subject_id)->whereraw('month(date) = 12 and year(date) = year(curdate())')->get('att_json')->toarray();

        $total_stu = round(students::join('courses', 'students.course_id', 'courses.course_id')->join('subjects', 'subjects.course_id', 'courses.course_id')->where('subjects.subject_id', $subject_id)->get('students.student_id')->count());

        $a = get_average($total_stu, $jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

        $avg = $a[0];
        $total_stu_str = $a[1];

        return view('attendance.subject_attendance', compact('user_role', 'avg', 'subject_details', 'total_stu_str','total_classes', 'classes'));
    }

    public function student_index(Request $req)
    {
        $user = Auth::user();
        $user_role = $user->role_id;
        $uid = $user->id;
        $classes = array();

        $query = $req->input('query') ?? '';

        // get students
        $resuest = Request::create(route('get.students', $uid), 'POST');
        $response = Route::dispatch($resuest);
        $students = json_decode($response->getContent(), true);

        // dump($students);die;

        $c = new Collection($students);
        $students = $c->paginate(10);

        return view('attendance.student', compact('user_role', 'uid', 'students' ,'query'));
    }
}
