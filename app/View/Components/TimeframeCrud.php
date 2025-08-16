<?php

namespace App\View\Components;

use App\Models\Timeframe;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TimeframeCrud extends Component
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
        $datas = Timeframe::all(); // Fetch all timeframes
        return view('components.timeframe-crud', compact('datas'));
    }
}
