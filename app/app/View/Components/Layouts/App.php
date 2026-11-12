<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    public string $lang;

    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?string $thumbnail = null,
    ) {
        $this->title = $title ? $title.' | '.config('app.name') : config('app.name');
        $this->description = $description ?? '';
        $this->thumbnail = $thumbnail ?: asset('images/logo.jpg');
        $this->lang = str_replace('_', '-', app()->getLocale());
    }

    public function render(): View|Closure|string
    {
        return view('components.layouts.app');
    }
}
