<?php

namespace App\View\Components;

use Illuminate\View\Component;

class confirm extends Component
{

    public $text , $modalname ;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text,$modalname)
    {
        $this->text = $text;
        $this->modalname = $modalname;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.confirm');
    }
}
