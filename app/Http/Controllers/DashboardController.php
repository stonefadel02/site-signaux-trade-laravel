<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Souscription;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $abonnements = Souscription::where('Status', 'ACTIVE')->count();
        $revenuMensuel = Souscription::revenuMensuel();

        return view('dashboard-admin', compact('users', 'abonnements', 'revenuMensuel'));
    }
}