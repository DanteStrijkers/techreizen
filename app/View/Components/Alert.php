<?php

namespace App\View\Components;

use App\Enums\AlertType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $bootstrapType;
    public string $message;

    public function __construct(string|AlertType $type = AlertType::Info, string $message = '')
    {
        if (!$type instanceof AlertType) $type = AlertType::tryFrom($type) ?: AlertType::Info; // convert the string to an AlertType if necessary

        $this->bootstrapType = $type->value;
        $this->message = $message;
    }

    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
