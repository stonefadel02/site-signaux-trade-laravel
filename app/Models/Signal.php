<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signal extends Model
{
    /** @use HasFactory<\Database\Factories\SignalFactory> */
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'user_id',
        'session_id',
        'DateHeureEmission',
        'DateHeureExpire',
        'DureeTrade',
        'Actif',
        'PrixEntree',
        'PrixSortieReelle',
        'TakeProfit',
        'StopLoss',
        'Direction',
        'Resultat',
        'Pips',
        'Confiance',
        'Commentaire',
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

    public function actif()
    {
        return $this->belongsTo(Actif::class, 'Actifs');
    }
    public function timeframes()
    {
        return $this->belongsToMany(Timeframe::class, 'signal_timeframes', 'SignalId', 'Timeframe');
    }

}
