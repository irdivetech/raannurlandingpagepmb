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
        'father_nik',
        'father_birth_place',
        'father_birth_date',
        'father_job',
        'father_phone',
        'mother_name',
        'mother_nik',
        'mother_birth_place',
        'mother_birth_date',
        'mother_job',
        'mother_phone',
        'no_pkh_kks',
    ];

    protected $casts = [
        'father_birth_date' => 'date',
        'mother_birth_date' => 'date',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
