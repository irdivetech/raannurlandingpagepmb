<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SatisfactionRating extends Model
{
    protected $fillable = [
        'ticket_id',
        'rating',
        'comment',
    ];

    // Relasi ke tiket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
