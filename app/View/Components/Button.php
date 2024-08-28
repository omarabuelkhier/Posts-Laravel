<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $color;
    public $message;
    public $route;

    /**
     * Create a new component instance.
     */

    public function __construct($color, $route, $message)
    {
        $this->color = $color;
        $this->message = $message;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
