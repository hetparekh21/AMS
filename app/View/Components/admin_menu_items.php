<?php

namespace App\View\Components;

use Illuminate\View\Component;

class admin_menu_items extends Component
{
    public $dashboard , $attendance ,$subject , $course , $teacher , $student;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dashboard , $attendance, $subject, $course , $teacher , $student)
    {
        $this->dashboard = $dashboard;
        $this->attendance = $attendance;
        $this->subject = $subject;
        $this->course = $course;
        $this->teacher = $teacher;
        $this->student = $student;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin_menu_items');
    }
}
