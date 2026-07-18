<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolProfile;

class SchoolProfileSeeder extends Seeder
{
    public function run(): void
    {
        SchoolProfile::updateOrCreate(
            ['id' => 1],
            [
                'school_name'      => 'RA AN-NUUR',
                'address'          => 'KP. CIJERUK RT.04 RW.02, Desa Waringinsari',
                'district'         => 'Takokak',
                'city'             => 'Cianjur',
                'province'         => 'Jawa Barat',
                'postal_code'      => '43265',
                'phone'            => '081395496112',
                'whatsapp'         => '6281395496112',
                'email'            => 'raannurtakokak@gmail.com',
                'latitude'         => -7.1627,
                'longitude'        => 107.1382,
                'google_maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0!2d107.1382!3d-7.1627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMDknNDUuNyJTIDEwN8KwMDgnMTcuNSJF!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'google_maps_url'  => 'https://maps.google.com/?q=-7.1627,107.1382',
                'operating_hours'  => 'Senin - Sabtu, 07:00 - 14:00 WIB',
            ]
        );
    }
}
