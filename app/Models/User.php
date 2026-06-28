<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Helpers
    public function isAdmin(): bool       { return $this->role === 'admin'; }
    public function isKepDusun(): bool    { return $this->role === 'kepala_dusun'; }
    public function isKepDesa(): bool     { return $this->role === 'kepala_desa'; }
    public function isBpd(): bool         { return $this->role === 'bpd'; }

    public function roleName(): string
    {
        return match($this->role) {
            'admin'         => 'Administrator',
            'kepala_dusun'  => 'Kepala Dusun',
            'kepala_desa'   => 'Kepala Desa',
            'bpd'           => 'BPD',
            default         => ucfirst($this->role),
        };
    }
}
