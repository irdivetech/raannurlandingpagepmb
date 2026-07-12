<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'full_name',
        'nickname',
        'nik',
        'no_kk',
        'gender',
        'child_order',
        'siblings_count',
        'birth_place',
        'birth_date',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
