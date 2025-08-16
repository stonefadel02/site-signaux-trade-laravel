<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Actif
 *
 * @property $id
 * @property $TypeMarche
 * @property $Symbole
 * @property $Nom
 * @property $created_at
 * @property $updated_at
 *
 * @property TypeMarch $typeMarch
 * @property Signal[] $signals
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Actif extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['TypeMarche', 'Symbole', 'Nom'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeMarch()
    {
        return $this->belongsTo(\App\Models\TypeMarch::class, 'TypeMarche', 'Nom');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function signals()
    {
        return $this->hasMany(\App\Models\Signal::class, 'id', 'Actif');
    }
    
}
