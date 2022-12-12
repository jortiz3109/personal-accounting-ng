<?php

namespace App\View\Components\Forms\Inputs;

use Illuminate\View\Component;
use Illuminate\View\View;

class Email extends Component
{
    public function __construct(
        public string $name,
        public ?string $label = null,
        public ?string $placeholder = null,
        public ?string $value = null
    ){}

    public function render(): View
    {
        return view('components.forms.inputs.email');
    }
}
