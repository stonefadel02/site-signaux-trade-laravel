<?php

namespace App\View\Components;

use Closure;
use App\Models\Plan;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class PricingSectionApp extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $plans = Plan::where('Visibilite', 'PUBLIQUE')->get();
        return view('components.pricing-section-app', compact('plans'));

    }
}
