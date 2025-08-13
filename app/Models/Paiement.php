<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'user_id',
        'souscription_id',
        'Montant',
        'Devise',
        'ModeDePaiement',
        'DateHeurePaiement',
        'Status',
        'TransactionId',
        'Details',
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
}
