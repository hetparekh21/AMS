<?php

namespace App\View\Components;

use Illuminate\View\Component;

class class_modal extends Component
{

    public $title, $action,$button, $modalname, $name ;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $title, $action,$button, $modalname, $name)
    {
        $this->title = $title;
        $this->action = $action;
        $this->button = $button;
        $this->modalname = $modalname;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.class_modal');
    }
}
