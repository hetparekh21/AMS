<?php

use App\Models\Role;
use App\Models\students;
use App\Models\teachers;
use App\Models\sub_tech;
use App\Models\subjects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


function user_info()
{

    $user = Auth::user();
    $role_id = $user->role_id;
    $role = role::where('role_id', $role_id)->get('role_name')->toarray();

    if ($role_id == 1) {
        $name = "Admin";
    } else if ($role_id == 2) {
        $name = teachers::where('uid', $user->id)->get(['teacher_name'])->toarray()[0]['teacher_name'];
    } else {
        $name = students::where('uid', $user->id)->get(['student_name'])->toarray()[0]['student_name'];
    }

    return [$name, $role[0]['role_name']];
}

function get_average(string $total_stu, ...$months)
{

    $avg = '';
    $total_stu_str = '';
    $total_class ="";

    foreach ($months as $month) {

        $classes_len = count($month);

        $total_present = 0;

        for ($i = 0; $i < $classes_len; $i++) {
            $attendance = json_decode($month[$i]['att_json'], true);
            foreach ($attendance as $key => $value) {
                if ($value == 1) {
                    $total_present++;
                }
            }
        }

        $avg .= $classes_len != 0 ? round(($total_present / $classes_len)) . "," : 0 . ",";
        $total_class .= $classes_len . ",";
        $total_stu_str .= $total_stu . ",";
    }

    return [$avg,$total_stu_str,$total_class];
}

function get_average_attendance($student_id, ...$months)
{
    $avg = '';
    $total_class = '' ;

    foreach ($months as $month) {

        $classes_len = count($month);

        $total_present = 0;

        for ($i = 0; $i < $classes_len; $i++) {
            $attendance = json_decode($month[$i]['att_json'], true);
            if (isset($attendance[$student_id])) {
                if ($attendance[$student_id] == 1) {
                    $total_present++;
                }
            }
        }

        $avg .= $classes_len != 0 ? round(($total_present / $classes_len)) . "," : 0 . ",";
        $total_class .= $classes_len . ",";
    }

    return [$avg, $total_class];
}

function update_teacher($subject_id, $teacher_id)
{

    $sub_tech = sub_tech::where('subject_id', $subject_id)->get();

    if (subjects::where('subject_id', $subject_id)->where('course_id', "!=", null)->count() == 0) {
        $status = "danger";
        $message = "First assign the Course to the subject";
        return [$status, $message];
    }

    if ($sub_tech->count() == 0) {
        // insert 

        if ($teacher_id == null || $subject_id == null) {
            $status = "success";
            $message = "Teacher updated";
            // return [$status, $message];
        } else {

            $sub_tech = new sub_tech;
            $sub_tech->subject_id = $subject_id;
            $sub_tech->teacher_id = $teacher_id;
            $sub_tech->save();

            $status = "success";
            $message = "Teacher assigned successfully";

        }
    } else {

        if ($teacher_id == null) {
            sub_tech::where("subject_id", $subject_id)->delete();
            $status = "success";
            $message = "Teacher removed successfully";
        } else {
            sub_tech::where("subject_id", $subject_id)->update(["teacher_id" => $teacher_id]);
            $status = "success";
            $message = "Teacher updated successfully";
        }
    }

    return [$status, $message];
}

function get_hash($password)
{
    return Hash::make($password);
}

function rand_pass()
{
    $pass = "";
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    for ($i = 0; $i < 8; $i++) {
        $pass .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $pass;
}