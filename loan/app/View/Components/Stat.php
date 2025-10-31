<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Stat extends Component
{
    public $value;
    public $label;

    public function __construct($value, $label)
    {
        $this->value = $value;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.stat');
    }
}
