<?php

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

function user_info()
{

    $user = Auth::user();

    $name = $user->name;
    $role = role::where('role_id', $user->role_id)->get('role_name')->toarray();

    return [$name, $role[0]['role_name']];
}

function get_average(string $total_stu, ...$months)
{

    $avg = '';
    $total_stu_str = '';

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
        $total_stu_str .= $total_stu . ",";
    }

    return [$avg, $total_stu_str];
}
