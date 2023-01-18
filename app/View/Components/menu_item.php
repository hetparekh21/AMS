<?php

namespace App\View\Components;

use Illuminate\View\Component;

class menu_item extends Component
{
    public $link, $name, $icon, $active ;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link, $name, $icon, $active)
    {
        $this->link = $link;
        $this->name = $name;
        $this->icon = $icon;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu_item');
    }
}
