<?php

namespace App\View\Components;

use Closure;
use App\Models\TypeMarch;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class TypeMarcheCrud extends Component
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
        $datas = TypeMarch::all(); // Fetch all market types
        return view('components.type-marche-crud', compact('datas'));
    }
}
