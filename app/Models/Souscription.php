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
        'AccessCode'
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
        $res = $this->Status === 'ACTIVE' &&
            $this->DateHeureDebut <= $dateNow &&
            $this->DateHeureFin >= $dateNow;
        // if (!$res && $this->Status != 'ACTIVE') {
        //     $this->Status = 'EXPIRED';
        //     $this->save();
        // }

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

    static function nouvelleSouscription()
    {
        return new Souscription();
    }

    function toString()
    {
        return $this->plan->Titre . ' (' . $this->DateHeureDebut->format('d/m/Y') . ' - ' . $this->DateHeureFin->format('d/m/Y') . ')';
    }
}
