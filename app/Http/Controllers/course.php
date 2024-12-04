<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courses;
use App\Models\subjects;

class course extends Controller
{

    public function create_course(Request $request)
    {

        // validate
        $request->validate([
            'course_name' => 'required',
            'course_code' => 'required',
            'semesters' => 'required|numeric|min:1|max:10'
        ]);

        echo "validated";

        $course_name = $request->course_name;
        $course_code = $request->course_code;
        $semesters = $request->semesters;

        if (Courses::where('course_code', $course_code)->count() > 0) {

            $status = 'danger';
            $message = 'Course Code Already Exists';
        } else {

            $course = new Courses;

            $course->course_name = $course_name;
            $course->course_code = $course_code;
            $course->semesters = $semesters;

            $course->save();

            $status = 'success';
            $message = 'Course Created Successfully';
        }

        $notification = [$status, $message];

        return redirect()->route('admin.course')->with('notification', $notification);
    }

    public function manage_course($course_id)
    {
        $course = Courses::where('course_id', $course_id)->get()->toarray();
        $course = $course[0];

        $semesters = Courses::find($course_id)->semesters;

        $subjects = subjects::where('course_id', $course_id)->orderby('semester_id')->get('*')->toarray();

        return view('admin.manage_course', compact('course', 'subjects', 'semesters'));
    }

    public function edit_course(Request $request, $id)
    {
        $request->validate([
            'course_name' => 'required',
            'course_code' => 'required',
            'semesters' => 'required|numeric|min:1|max:10'
        ]);

        $course_name = $request->course_name;
        $course_code = $request->course_code;
        $semesters = $request->semesters;

        $course = Courses::find($id);

        if ($course->course_code != $course_code) {
            if (Courses::where('course_code', $course_code)->count() > 0) {

                $status = 'danger';
                $message = 'Course Code Already Exists';

                $notification = [$status, $message];

                return redirect()->route('admin.course')->with('notification', $notification);
            }
        }

        if ($course->semesters > $semesters) {

            $sub = subjects::where('course_id', $id)->where('semester_id', '>', $semesters)->update(['semester_id' => null, 'course_id' => null]);
        }

        $course->course_name = $course_name;
        $course->course_code = $course_code;
        $course->semesters = $semesters;

        $course->save();

        $status = 'success';
        $message = 'Course Updated Successfully';

        $notification = [$status, $message];

        return redirect()->route('course.manage',$course->course_id)->with('notification', $notification);
    }

    public function delete_course($id)
    {
        $course = Courses::find($id);

        $course->delete();

        $status = 'success';
        $message = 'Course Deleted Successfully';

        $notification = [$status, $message];

        return redirect()->route('admin.course')->with('notification', $notification);
    }

    public function remove_subject($course_id, $subject_id)
    {

        $subject = subjects::where("subject_id", $subject_id)->where("course_id", $course_id)->first();

        if ($subject->count() > 0) {

            $subject->course_id = null;
            $subject->semester_id = null;
            $subject->save();

            $status = 'success';
            $message = 'Subject Removed Successfully';
        } else {

            $status = 'warning';
            $message = 'Subject Not Found';
        }

        $notification = [$status, $message];

        return redirect()->route('course.manage', $course_id)->with('notification', $notification);
    }

    public function add_subject(Request $request)
    {
        $composite = $request->input('composite');
        $subject_id = $request->input('subject_id');

        $composite = explode('_', $composite);

        $course_id = $composite[0];
        $semester_id = $composite[1];

        $subject = subjects::where("subject_id", $subject_id)->first();

        if ($subject->count() > 0) {

            if ($subject->course_id != null) {

                $status = 'warning';
                $message = 'Subject already assigned to another Course';
            } else {

                $subject->course_id = $course_id;
                $subject->semester_id = $semester_id;
                $subject->save();

                $status = 'success';
                $message = 'Subject Added Successfully';
            }
        } else {

            $status = 'warning';
            $message = 'Subject Not Found';
        }

        $notification = [$status, $message];

        return redirect()->route('course.manage', $course_id)->with('notification', $notification);
    }
}
