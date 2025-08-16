<?php

namespace App\Http\Controllers;

use App\Models\TypeMarch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TypeMarchRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TypeMarchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $typeMarches = TypeMarch::paginate();

        return view('type-march.index', compact('typeMarches'))
            ->with('i', ($request->input('page', 1) - 1) * $typeMarches->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $typeMarch = new TypeMarch();

        return view('type-march.create', compact('typeMarch'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeMarchRequest $request): RedirectResponse
    {
        TypeMarch::create($request->validated());

        return Redirect::route('parametrage-signaux', ['tab' => 'marche'])
            ->with('success', 'TypeMarch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $typeMarch = TypeMarch::find($id);

        return view('type-march.show', compact('typeMarch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $typeMarch = TypeMarch::find($id);

        return view('type-march.edit', compact('typeMarch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeMarchRequest $request, TypeMarch $typeMarch): RedirectResponse
    {
        $typeMarch->update($request->validated());

        return Redirect::route('parametrage-signaux', ['tab' => 'marche'])
            ->with('success', 'TypeMarch updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        TypeMarch::find($id)->delete();

        return Redirect::route('parametrage-signaux', ['tab' => 'marche'])
            ->with('success', 'TypeMarch deleted successfully');
    }
}
