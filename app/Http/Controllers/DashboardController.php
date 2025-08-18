<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Signal;
use App\Models\SessionSignal;
use App\Models\Souscription;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   
    public function __invoke()

    {
        $user = Auth::user();

        if ($user->hasRole('Super-admin')) {
            return $this->adminDashboard();
        }

        return $this->userDashboard();
    }

    
    public function userDashboard()
    {
        $user = Auth::user();
        $souscription = $user->getActiveSouscription();

        $now = now()->format('H:i:s');
        $prochaineSession = SessionSignal::where('HeureDebut', '>', $now)
                                        ->orderBy('HeureDebut', 'asc')
                                        ->first();
        if (!$prochaineSession) {
            $prochaineSession = SessionSignal::orderBy('HeureDebut', 'asc')->first();
        }
        
        $signaux = collect();
        if ($souscription && $souscription->plan) {
            $signaux = Signal::whereHas('plans', function ($query) use ($souscription) {
                                $query->where('plan_id', $souscription->plan_id);
                            })
                            ->with('actif')
                            ->latest('DateHeureEmission')
                            ->take(5)
                            ->get();
        }

        return view('dashboard', compact('user', 'souscription', 'prochaineSession', 'signaux'));
    }

    
    private function adminDashboard()
    {
        $users = User::count();
        $abonnements = Souscription::where('Status', 'ACTIVE')->count();
        $revenuMensuel = 0;
        $signaux7DerniersJours = Signal::where('created_at', '>=', now()->subDays(7))->count();
        $users = User::count();
        $abonnements = Souscription::where('Status', 'ACTIVE')->count();
        $revenuMensuel = 0; 

        return view('dashboard-admin', compact('users', 'abonnements', 'revenuMensuel','signaux7DerniersJours'));
    }

    public function signalStats()
    {
        $stats = Signal::query()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = $stats->pluck('date')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('d/m');
        });
        $data = $stats->pluck('count');

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}