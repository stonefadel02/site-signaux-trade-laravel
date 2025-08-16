<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AccessCode
 *
 * @property $id
 * @property $plan_id
 * @property $Code
 * @property $DureeEnJours
 * @property $Compteur
 * @property $CompteurMax
 * @property $ExpireLe
 * @property $created_at
 * @property $updated_at
 *
 * @property Plan $plan
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AccessCode extends Model
{

    protected $perPage = 20;


    protected $casts = [
        'DureeEnJours' => 'integer',
        'Compteur' => 'integer',
        'CompteurMax' => 'integer',
        'ExpireLe' => 'date',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['plan_id', 'Code', 'DureeEnJours', 'Compteur', 'CompteurMax', 'ExpireLe'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(\App\Models\Plan::class, 'plan_id', 'id');
    }

    public function souscriptions()
    {
        // Relation via champ string AccessCode dans souscriptions
        return $this->hasMany(Souscription::class, 'AccessCode', 'Code')->with('user');
    }

}
