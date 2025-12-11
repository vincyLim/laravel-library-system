<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formSelect extends Component
{
    public $class;
    public $name;
    public $label;

    public $selectClass;

    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $class = "", $selectClass = "formSelect", $required = "")
    {
        $this->class = $class;
        $this->name = $name;
        $this->label = $label;
        $this->selectClass = $selectClass;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-select');
    }
}
