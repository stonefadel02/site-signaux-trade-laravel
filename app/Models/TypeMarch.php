<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeMarch
 *
 * @property string $Nom
 * @property string|null $Description
 * @property $created_at
 * @property $updated_at
 *
 * @property Actif[] $actifs
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TypeMarch extends Model
{
    // Use string primary key 'Nom'
    protected $primaryKey = 'Nom';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['Nom', 'Description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actifs()
    {
        return $this->hasMany(\App\Models\Actif::class, 'TypeMarche', 'Nom');
    }
}
