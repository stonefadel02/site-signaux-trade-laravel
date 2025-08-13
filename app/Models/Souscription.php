<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Souscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'Montant',
        'Devise',
        'DateHeureDebut',
        'DateHeureFin',
        'Status',
    ];

    protected $casts = [
        'Montant' => 'decimal:4',
        'DateHeureDebut' => 'datetime',
        'DateHeureFin' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
