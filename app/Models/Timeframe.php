<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Timeframe
 *
 * @property string $Nom
 * @property string|null $Description
 * @property $created_at
 * @property $updated_at
 *
 * @property SignalTimeframe[] $signalTimeframes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Timeframe extends Model
{
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
    public function signalTimeframes()
    {
        return $this->hasMany(\App\Models\SignalTimeframe::class, 'Timeframe', 'Nom');
    }
}
