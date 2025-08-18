<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Souscription;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

// class User extends Authenticatable implements MustVerifyEmail 
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function souscriptions(): HasMany
    {
        return $this->hasMany(Souscription::class);
    }

    function hasAccessToSignals(): bool
    {
        $activeSouscription = $this->getActiveSouscription();
        return $activeSouscription !== null;
    }
    function getActiveSouscription(): ?Souscription
    {
        $dateNow = now();
        return Souscription::where('user_id', $this->id)
            ->where('Status', 'ACTIVE')
            ->where('DateHeureFin', '>=', $dateNow)
            ->where('DateHeureDebut', '<=', $dateNow)
            ->latest()
            ->first();
    }
    function getLastSouscription(): ?Souscription
    {
        return Souscription::where('user_id', $this->id)
            ->orderBy('DateHeureFin', 'desc')
            ->first();
    }
}