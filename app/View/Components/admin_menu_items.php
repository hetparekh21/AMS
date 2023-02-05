<?php

namespace App\View\Components;

use Illuminate\View\Component;

class admin_menu_items extends Component
{
    public $dashboard , $attendance;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dashboard , $attendance)
    {
        $this->dashboard = $dashboard;
        $this->attendance = $attendance;
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
