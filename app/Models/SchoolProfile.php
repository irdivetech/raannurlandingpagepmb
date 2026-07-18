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

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /**
     * Get the single school profile (singleton pattern).
     */
    public static function getProfile(): ?self
    {
        return static::first();
    }

    /**
     * Get full formatted address.
     */
    public function getFullAddress(): string
    {
        $parts = array_filter([
            $this->address,
            $this->district ? 'Kec. ' . $this->district : null,
            $this->city ? 'Kab. ' . $this->city : null,
            $this->province,
            $this->postal_code,
        ]);

        return implode(', ', $parts);
    }
}
