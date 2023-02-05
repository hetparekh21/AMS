<?php

namespace App\View\Components;

use Illuminate\View\Component;

class teacher_menu_items extends Component
{
    public $dashboard, $class, $account, $attendance;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dashboard, $class, $attendance, $account)
    {
        $this->dashboard = $dashboard;
        $this->class = $class;
        $this->account = $account;
        $this->attendance = $attendance;
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
