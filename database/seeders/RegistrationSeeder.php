<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Registration;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Address;
use App\Models\Document;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        // Dummy 1: Verifying
        $parent1 = User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@email.com',
            'password' => Hash::make('password123'),
            'role' => 'parent',
        ]);

        $reg1 = Registration::create([
            'user_id' => $parent1->id,
            'reg_number' => 'REG-2024-0892',
            'status' => 'verifying',
        ]);

        Student::create([
            'registration_id' => $reg1->id,
            'full_name' => 'Ahmad Fathoni',
            'nickname' => 'Toni',
            'nik' => '3174091206190001',
            'gender' => 'L',
            'birth_place' => 'Jakarta',
            'birth_date' => '2019-06-12',
        ]);

        StudentParent::create([
            'registration_id' => $reg1->id,
            'father_name' => 'Ahmad Fauzi',
            'father_job' => 'Karyawan Swasta',
            'father_phone' => '081234567890',
            'mother_name' => 'Siti Aminah',
            'mother_job' => 'Ibu Rumah Tangga',
            'mother_phone' => '081298765432',
        ]);

        Address::create([
            'registration_id' => $reg1->id,
            'address_line' => 'Jl. Melati Raya No. 12, Komplek Permata Hijau',
            'province' => 'DKI Jakarta',
            'city' => 'Jakarta Selatan',
            'district' => 'Kebayoran Lama',
            'postal_code' => '12240',
        ]);

        Document::create(['registration_id' => $reg1->id, 'type' => 'akta', 'file_path' => 'dummy_akta.jpg', 'status' => 'verified']);
        Document::create(['registration_id' => $reg1->id, 'type' => 'kk', 'file_path' => 'dummy_kk.jpg', 'status' => 'verified']);
        Document::create(['registration_id' => $reg1->id, 'type' => 'ktp_ortu', 'file_path' => 'dummy_ktp.jpg', 'status' => 'pending']);

        // Dummy 2: Accepted
        $parent2 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'password' => Hash::make('password123'),
            'role' => 'parent',
        ]);

        $reg2 = Registration::create([
            'user_id' => $parent2->id,
            'reg_number' => 'REG-2024-0891',
            'status' => 'accepted',
        ]);

        Student::create([
            'registration_id' => $reg2->id,
            'full_name' => 'Siti Aisyah',
            'nickname' => 'Aisyah',
            'nik' => '3174091206190002',
            'gender' => 'P',
            'birth_place' => 'Bandung',
            'birth_date' => '2019-05-10',
        ]);

        StudentParent::create([
            'registration_id' => $reg2->id,
            'father_name' => 'Budi Santoso',
            'father_job' => 'PNS',
            'father_phone' => '081234567891',
            'mother_name' => 'Rina Melati',
            'mother_job' => 'PNS',
            'mother_phone' => '081298765433',
        ]);

        Address::create([
            'registration_id' => $reg2->id,
            'address_line' => 'Jl. Mawar Merah No. 5',
            'province' => 'Jawa Barat',
            'city' => 'Bandung',
            'district' => 'Coblong',
            'postal_code' => '40135',
        ]);

        Document::create(['registration_id' => $reg2->id, 'type' => 'akta', 'file_path' => 'dummy_akta2.jpg', 'status' => 'verified']);
        Document::create(['registration_id' => $reg2->id, 'type' => 'kk', 'file_path' => 'dummy_kk2.jpg', 'status' => 'verified']);
        Document::create(['registration_id' => $reg2->id, 'type' => 'ktp_ortu', 'file_path' => 'dummy_ktp2.jpg', 'status' => 'verified']);
    }
}
