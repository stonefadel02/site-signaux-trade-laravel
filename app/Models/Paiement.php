<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'souscription_id',
        'Montant',
        'Devise',
        'ModeDePaiement',
        'DateHeurePaiement',
        'Status',
        'TransactionId',
        'Details',
        'gateway_payment_id',
        'switch_mode',
    ];

    protected $casts = [
        'Montant' => 'decimal:4',
        'DateHeurePaiement' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function souscription()
    {
        return $this->belongsTo(Souscription::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    function activerSouscription()
    {
        $user = $this->user;
        $plan = $this->plan;
        if (!$plan) {
            throw new \Exception("Le plan associé au paiement n'existe pas.", 800);
        }
        $lastSouscription = $user->getActiveSouscription() ?? $user->getLastSouscription();

        // par default
        $startDate = now();
        $endDate = now()->addDays($plan->DureeEnJours);

        if ($lastSouscription) {
            if ($lastSouscription->isActive()) {
                if ($this->switch_mode == 'immediate') {
                    // arreter ancienne souscription et commencer le nouveau
                    $lastSouscription->update(['Status' => 'EXPIRE', "DateHeureFin" => now()]);
                    //default
                } else {
                    // planifier un nouveau a la fin de l'ancien
                    $startDate = $user->getLastSouscription()->DateHeureFin;
                    $endDate = $startDate->copy()->addDays($plan->DureeEnJours);
                }
            } else {
                // commencer le nouveau
                //default
            }

        } else {

            //default
        }
        // mettre a jour les souscriptions expirées
        DB::transaction(function () use ($user, $plan, $startDate, $endDate) {
            Souscription::where('Status', 'ACTIVE')
                ->where('DateHeureFin', '<', now())
                ->update(['Status' => 'EXPIRE']);
            // Crée une nouvelle souscription
            $souscription = Souscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                "Montant" => $this->Montant,
                'Devise' => $this->Devise,
                'DateHeureDebut' => $startDate,
                'DateHeureFin' => $endDate,
                'Status' => 'ACTIVE',
            ]);
            // Associe le paiement à la nouvelle souscription
            $this->souscription_id = $souscription->id;
            $this->save();
        });
    }
}
