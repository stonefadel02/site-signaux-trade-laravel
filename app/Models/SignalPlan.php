<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignalPlan extends Model
{
    protected $fillable = [
        'plan_id',
        'signal_id',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function signal()
    {
        return $this->belongsTo(Signal::class);
    }
}
