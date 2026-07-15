<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_name',
        'address',
        'district',
        'city',
        'province',
        'postal_code',
        'phone',
        'whatsapp',
        'email',
        'latitude',
        'longitude',
        'google_maps_embed',
        'google_maps_url',
        'operating_hours',
    ];
}
