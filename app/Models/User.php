<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    public function registration()
    {
        return $this->hasOne(Registration::class);
    }

    // Tiket yang dibuat oleh user ini (sebagai reporter)
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'reporter_id');
    }

    // Tiket yang ditangani oleh user ini (sebagai operator/admin)
    public function operatedTickets()
    {
        return $this->hasMany(Ticket::class, 'operator_id');
    }
}
