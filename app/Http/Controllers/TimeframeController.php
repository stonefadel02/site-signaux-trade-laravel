<?php

namespace App\Http\Controllers;

use App\Models\Timeframe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TimeframeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TimeframeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $timeframes = Timeframe::paginate();

        return view('timeframe.index', compact('timeframes'))
            ->with('i', ($request->input('page', 1) - 1) * $timeframes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $timeframe = new Timeframe();

        return view('timeframe.create', compact('timeframe'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeframeRequest $request): RedirectResponse
    {
        Timeframe::create($request->validated());

        return Redirect::route('parametrage-signaux', ['tab' => 'timeframes'])
            ->with('success', 'Timeframe created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $timeframe = Timeframe::find($id);

        return view('timeframe.show', compact('timeframe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $timeframe = Timeframe::find($id);

        return view('timeframe.edit', compact('timeframe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimeframeRequest $request, Timeframe $timeframe): RedirectResponse
    {
        $timeframe->update($request->validated());

        return Redirect::route('parametrage-signaux', ['tab' => 'timeframes'])
            ->with('success', 'Timeframe updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Timeframe::find($id)->delete();

        return Redirect::route('parametrage-signaux', ['tab' => 'timeframes'])
            ->with('success', 'Timeframe deleted successfully');
    }
}
