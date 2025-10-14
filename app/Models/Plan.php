<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'Titre',
        'Prix',
        'Devise',
        'DureeEnJours',
        'NombreDeSignaux',
        'AutresAvantages',
        'Visibilite',
        'isPopular',
    ];

    protected $casts = [
        'AutresAvantages' => 'array',
        'Prix' => 'decimal:4',
        'DureeEnJours' => 'integer',
        'NombreDeSignaux' => 'integer',
        'isPopular' => 'boolean',
    ];
    public function getFrequence()
    {
        switch ($this->DureeEnJours) {
            case 1:
                return 'Jour';
            case 7:
                return 'Semaine';
            case 30:
                return 'Mois';
            default:
                return $this->Titre;
        }
    }
    public function souscriptions()
    {
        return $this->hasMany(Souscription::class);
    }

    public function accessCodes()
    {
        return $this->hasMany(AccessCode::class);
    }

    public function signalPlans()
    {
        return $this->hasMany(SignalPlan::class);
    }

    public function signals()
    {
        return $this->hasManyThrough(Signal::class, SignalPlan::class, 'plan_id', 'id', 'id', 'signal_id');
    }

    function getFeatures(): array
    {
        $rest = [];
        $rest[] = round($this->NombreDeSignaux / 30) . ' Signaux par Jour';
        $rest[] = 'Accès illimité pendant ' . $this->NombreDeSignaux . ' Jour(s)';
        foreach (json_decode($this->AutresAvantages) as $avantage) {
            $rest[] = $avantage;
        }
        return $rest;
    }
}