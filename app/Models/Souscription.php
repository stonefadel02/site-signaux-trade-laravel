<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Souscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'Montant',
        'Devise',
        'DateHeureDebut',
        'DateHeureFin',
        'Status',
    ];

    protected $casts = [
        'Montant' => 'decimal:4',
        'DateHeureDebut' => 'datetime',
        'DateHeureFin' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
    function isValid(): bool
    {
        $dateNow = now();
        $res =
            $this->DateHeureDebut <= $dateNow &&
            $this->DateHeureFin >= $dateNow;
        if (!$res && $this->Status != 'EXPIRED') {
            $this->Status = 'EXPIRED';
            $this->save();
        } elseif ($res && $this->Status != 'ACTIVE') {
            $this->Status = 'ACTIVE';
            $this->save();
        }

        return $res;
    }

    public static function revenuMensuel()
    {
        $now = Carbon::now();

        return self::where('Status', 'ACTIVE')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->sum('Montant');
    }
}
