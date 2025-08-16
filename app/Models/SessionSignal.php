<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionSignal extends Model
{
    protected $fillable = [
        'Titre',
        'HeureDebut',
        'HeureFin',
    ];

    protected $casts = [
        // 'HeureDebut' => 'datetime:H:i:s',
        // 'HeureFin' => 'datetime:H:i:s',
    ];

    public function signals()
    {
        return $this->hasMany(Signal::class, 'session_id');
    }
}
