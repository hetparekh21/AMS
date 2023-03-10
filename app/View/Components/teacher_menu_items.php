<?php

namespace App\View\Components;

use Illuminate\View\Component;

class teacher_menu_items extends Component
{
    public $dashboard, $class, $subject, $attendance , $student;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dashboard, $class, $attendance, $subject,$student)
    {
        $this->dashboard = $dashboard;
        $this->class = $class;
        $this->subject = $subject;
        $this->attendance = $attendance;
        $this->student = $student;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.teacher_menu_items');
    }
}
