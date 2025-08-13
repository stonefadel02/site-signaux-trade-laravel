<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    protected $fillable = [
        'plan_id',
        'Code',
        'DureeEnJours',
        'Compteur',
        'CompteurMax',
        'ExpireLe',
    ];

    protected $casts = [
        'DureeEnJours' => 'integer',
        'Compteur' => 'integer',
        'CompteurMax' => 'integer',
        'ExpireLe' => 'date',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
