<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sub_tech;
use App\Models\subjects;

class subject extends Controller
{

    public function delete_subject($subject_id)
    {

        if ($subject_id == null || $subject_id == '' || subjects::where('subject_id', $subject_id)->count() == 0) {

            $status = 'danger';
            $message = 'Subject Not Found';

            $notification = [$status, $message];

            return redirect()->route('admin.subject')->with('notification', $notification);
        }

        sub_tech::where('subject_id', $subject_id)->delete();
        subjects::where('subject_id', $subject_id)->delete();

        $status = 'success';
        $message = 'Subject Deleted Successfully';

        $notification = [$status, $message];

        return redirect()->route('admin.subject')->with('notification', $notification);
    }

    public function create_subject(Request $request)
    {

        $request->validate([
            'subject_name' => 'required',
            'subject_code' => 'required',
        ]);

        $subject_name = $request->subject_name;
        $subject_code = $request->subject_code;
        $teacher_id = $request->teacher_id;

        if (subjects::where('subject_code', $subject_code)->count() > 0) {

            $status = 'danger';
            $message = 'Subject Code Already Exists';
        } else {

            $subject = new subjects;
            $subject->subject_name = $subject_name;
            $subject->subject_code = $subject_code;
            $subject->save();

            $status = 'success';
            $message = 'Subject Created Successfully';
        }

        $notification = [$status, $message];

        return redirect()->route('admin.subject')->with('notification', $notification);
    }

    public function edit_subject(Request $request)
    {

        $request->validate([
            'subject_name' => 'required',
            'subject_code' => 'required',
        ]);

        $subject_id = $request->subject_id;
        $subject_name = $request->subject_name;
        $subject_code = $request->subject_code;
        $teacher_id = $request->teacher_id;

        $subject = subjects::where('subject_id', $subject_id)->first();

        if ($subject->subject_code != $subject_code && subjects::where('subject_code', $subject_code)->count() > 0) {

            $status = 'danger';
            $message = 'Subject Code Already Exists';
        } else {

            $temp = update_teacher($subject->subject_id, $teacher_id);

            if ($temp[0] !== 'success') {

                $status = $temp[0];
                $message = $temp[1];
            } else {

                $subject->subject_name = $subject_name;
                $subject->subject_code = $subject_code;
                $subject->save();

                $status = 'success';
                $message = 'Subject Updated Successfully';
            }
        }

        $notification = [$status, $message];

        return redirect()->route('admin.subject')->with('notification', $notification);
    }
}
