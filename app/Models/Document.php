<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'type',
        'file_path',
        'status',
        'notes',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
