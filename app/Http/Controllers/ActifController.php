<?php

namespace App\Http\Controllers;

use App\Models\Actif;
use App\Models\TypeMarch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ActifRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ActifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $actifs = Actif::paginate();

        return view('actif.index', compact('actifs'))
            ->with('i', ($request->input('page', 1) - 1) * $actifs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $actif = new Actif();
        $typeMarches = TypeMarch::orderBy('Nom')->pluck('Nom');

        return view('actif.create', compact('actif', 'typeMarches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActifRequest $request): RedirectResponse
    {
        Actif::create($request->validated());

        return Redirect::route('parametrage-signaux', ['tab' => 'actifs'])
            ->with('success', 'Actif created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $actif = Actif::find($id);

        return view('actif.show', compact('actif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $actif = Actif::find($id);
        $typeMarches = TypeMarch::orderBy('Nom')->pluck('Nom');

        return view('actif.edit', compact('actif', 'typeMarches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActifRequest $request, Actif $actif): RedirectResponse
    {
        $actif->update($request->validated());

        return Redirect::route('parametrage-signaux', ['tab' => 'actifs'])
            ->with('success', 'Actif updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Actif::find($id)->delete();

        return Redirect::route('parametrage-signaux', ['tab' => 'actifs'])
            ->with('success', 'Actif deleted successfully');
    }
}
