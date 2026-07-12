<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'reporter_id',
        'operator_id',
        'subject',
        'description',
        'category',
        'priority',
        'status',
        'needs_admin',
        'first_response_at',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'first_response_at' => 'datetime',
            'resolved_at'       => 'datetime',
            'needs_admin'       => 'boolean',
        ];
    }

    // Relasi ke user yang membuat tiket
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    // Relasi ke admin yang menangani
    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    // Relasi ke semua balasan tiket
    public function responses()
    {
        return $this->hasMany(TicketResponse::class);
    }

    // Relasi ke rating kepuasan
    public function rating()
    {
        return $this->hasOne(SatisfactionRating::class);
    }

    // Helper: label kategori
    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'teknis'    => 'Teknis',
            'akademik'  => 'Akademik',
            'informasi' => 'Informasi',
            default     => 'Lainnya',
        };
    }

    // Helper: label status
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'open'        => 'Open',
            'in_progress' => 'In Progress',
            'resolved'    => 'Resolved',
            'closed'      => 'Closed',
            default       => ucfirst($this->status),
        };
    }

    // Helper: label priority
    public function getPriorityLabelAttribute(): string
    {
        return match ($this->priority) {
            'low'    => 'Low',
            'medium' => 'Medium',
            'high'   => 'High',
            default  => ucfirst($this->priority),
        };
    }
}
