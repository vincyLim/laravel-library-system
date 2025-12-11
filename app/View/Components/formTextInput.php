<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formTextInput extends Component
{
    public $class;
    public $name;
    public $label;
    public $value;
    public $type;
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $class = "", $value = "", $type = null, $required = "")
    {
        $this->class = $class;
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->type = $type ?? "text";
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-text-input');
    }
}
