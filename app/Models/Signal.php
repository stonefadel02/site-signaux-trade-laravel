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
        'Actif', // FK vers table actifs
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
        // clé étrangère correcte dans la migration: Actif
        return $this->belongsTo(Actif::class, 'Actif');
    }

    public function timeframes()
    {
        // Relation many-to-many via pivot personnalisé (clé primaire string sur timeframe)
        return $this->belongsToMany(Timeframe::class, 'signal_timeframes', 'SignalId', 'Timeframe', 'id', 'Nom');
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'signal_plans', 'signal_id', 'plan_id');
    }

}
