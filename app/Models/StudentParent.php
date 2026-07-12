<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'father_name',
        'father_job',
        'father_phone',
        'mother_name',
        'mother_job',
        'mother_phone',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
