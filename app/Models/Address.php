<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'address_line',
        'province',
        'city',
        'district',
        'postal_code',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
