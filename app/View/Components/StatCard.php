<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public function __construct(
        public string $title,
        public int|string $value
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.stat-card');
    }
}