<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketResponse extends Model
{
    protected $fillable = [
        'ticket_id',
        'responder_id',
        'message',
        'is_auto_reply',
    ];

    protected function casts(): array
    {
        return [
            'is_auto_reply' => 'boolean',
        ];
    }

    // Relasi ke tiket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Relasi ke user yang membalas
    public function responder()
    {
        return $this->belongsTo(User::class, 'responder_id');
    }
}
