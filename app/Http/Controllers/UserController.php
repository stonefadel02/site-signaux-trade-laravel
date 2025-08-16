<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = \App\Models\User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Formulaire de gestion des rôles d'un utilisateur.
     */
    public function editRoles(User $user)
    {
        $roles = Role::orderBy('name')->get();
        $userRoleNames = $user->roles->pluck('name')->toArray();
        return view('users.roles', compact('user', 'roles', 'userRoleNames'));
    }

    /**
     * Met à jour les rôles (assignation & retrait) d'un utilisateur.
     */
    public function updateRoles(Request $request, User $user)
    {
        $validated = $request->validate([
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name'
        ]);

        $roles = $validated['roles'] ?? [];

        // Optionnel : empêcher qu'un super-admin retire son propre rôle super-admin
        if (auth()->id() === $user->id && !in_array('Super-admin', $roles) && $user->hasRole('Super-admin')) {
            return back()->with('error', "Vous ne pouvez pas retirer votre propre rôle 'Super-admin'.");
        }

        $user->syncRoles($roles);

        return redirect()->route('users.roles.edit', $user)->with('success', 'Rôles mis à jour avec succès.');
    }
}
