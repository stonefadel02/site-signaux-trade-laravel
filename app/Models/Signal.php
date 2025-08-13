<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'DateHeureEmission',
        'DateHeureExpire',
        'DureeTrade',
        'Actifs',
        'Timeframe',
        'PrixEntree',
        'PrixSortieReelle',
        'TakeProfit',
        'StopLoss',
        'Direction',
        'Resultat',
        'Pips',
        'Confiance',
        'Commentaire',
        'Status',
    ];

    protected $casts = [
        'DateHeureEmission' => 'datetime',
        'DateHeureExpire' => 'datetime',
        'DureeTrade' => 'datetime:H:i:s',
        'PrixEntree' => 'float',
        'PrixSortieReelle' => 'float',
        'TakeProfit' => 'float',
        'StopLoss' => 'float',
        'Pips' => 'integer',
        'Confiance' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function session()
    {
        return $this->belongsTo(SessionSignal::class, 'session_id');
    }

    public function signalPlans()
    {
        return $this->hasMany(SignalPlan::class);
    }
}
