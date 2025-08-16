<?php

namespace App\View\Components;

use Closure;
use App\Models\SessionSignal;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SessionCrud extends Component
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
        $datas = SessionSignal::all(); // Assuming you want to fetch all session signals
        return view('components.session-crud', compact('datas'));
    }
}
