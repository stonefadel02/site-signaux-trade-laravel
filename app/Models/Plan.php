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
    ];

    protected $casts = [
        'AutresAvantages' => 'array',
        'Prix' => 'decimal:4',
        'DureeEnJours' => 'integer',
        'NombreDeSignaux' => 'integer',
    ];

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
}
