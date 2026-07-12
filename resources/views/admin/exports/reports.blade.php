<table style="font-family: 'Segoe UI', Arial, sans-serif; border-collapse: collapse; width: 100%;">
    <!-- HEADER REPORT (CLEAN, NO BORDER) -->
    <tr>
        <th colspan="23" style="font-size: 24px; font-weight: bold; color: #064E3B; text-align: left; height: 40px; vertical-align: bottom;">
            LAPORAN STATISTIK PENDAFTARAN
        </th>
    </tr>
    <tr>
        <th colspan="23" style="font-size: 14px; font-weight: bold; color: #059669; text-align: left; height: 25px; vertical-align: top;">
            RA AN-NUUR ISLAMIC KINDERGARTEN
        </th>
    </tr>
    <tr>
        <th colspan="23" style="font-size: 11px; color: #6B7280; text-align: left; height: 20px; font-style: italic;">
            Dicetak Pada: {{ date('d F Y, H:i') }} WIB
        </th>
    </tr>
    <tr><td colspan="23" style="height: 15px;"></td></tr>

    @php 
        $proses = ($statusCounts['pending'] ?? 0) + ($statusCounts['verifying'] ?? 0); 
    @endphp

    <!-- SUMMARY SECTION (CLEAN KEY-VALUE DASHBOARD) -->
    <!-- Baris 1: Total, Laki-laki, Kelompok A -->
    <tr>
        <th colspan="2" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; text-align: left; height: 25px;">Total Pendaftar</th>
        <td colspan="2" style="border: 1px solid #E5E7EB; text-align: center; font-weight: bold; color: #111827;">{{ $total }} Siswa</td>
        <td style="width: 15px;"></td>
        <th colspan="2" style="background-color: #F3F4F6; color: #374151; border: 1px solid #D1D5DB; text-align: left;">Laki-laki</th>
        <td colspan="2" style="border: 1px solid #E5E7EB; text-align: center; font-weight: bold; color: #111827;">{{ $genderCounts['L'] ?? 0 }} Siswa</td>
        <td style="width: 15px;"></td>
        <th colspan="2" style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; text-align: left;">Kelompok A (&lt; 5 Thn)</th>
        <td colspan="3" style="border: 1px solid #E5E7EB; text-align: center; font-weight: bold; color: #111827;">{{ $kelA }} Siswa</td>
        <td colspan="8"></td>
    </tr>
    
    <!-- Baris 2: Diterima, Perempuan, Kelompok B -->
    <tr>
        <th colspan="2" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; text-align: left; height: 25px;">Diterima</th>
        <td colspan="2" style="border: 1px solid #E5E7EB; text-align: center; font-weight: bold; color: #059669;">{{ $statusCounts['accepted'] ?? 0 }} Siswa</td>
        <td></td>
        <th colspan="2" style="background-color: #F3F4F6; color: #374151; border: 1px solid #D1D5DB; text-align: left;">Perempuan</th>
        <td colspan="2" style="border: 1px solid #E5E7EB; text-align: center; font-weight: bold; color: #111827;">{{ $genderCounts['P'] ?? 0 }} Siswa</td>
        <td></td>
        <th colspan="2" style="background-color: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; text-align: left;">Kelompok B (&ge; 5 Thn)</th>
        <td colspan="3" style="border: 1px solid #E5E7EB; text-align: center; font-weight: bold; color: #111827;">{{ $kelB }} Siswa</td>
        <td colspan="8"></td>
    </tr>

    <!-- Baris 3: Diproses -->
    <tr>
        <th colspan="2" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; text-align: left; height: 25px;">Sedang Diproses</th>
        <td colspan="2" style="border: 1px solid #E5E7EB; text-align: center; font-weight: bold; color: #D97706;">{{ $proses }} Siswa</td>
        <td colspan="19"></td>
    </tr>

    <!-- Baris 4: Ditolak -->
    <tr>
        <th colspan="2" style="background-color: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; text-align: left; height: 25px;">Ditolak / Batal</th>
        <td colspan="2" style="border: 1px solid #E5E7EB; text-align: center; font-weight: bold; color: #DC2626;">{{ $statusCounts['rejected'] ?? 0 }} Siswa</td>
        <td colspan="19"></td>
    </tr>

    <tr><td colspan="23" style="height: 25px;"></td></tr>

    <!-- MAIN DATA TABLE -->
    <tr>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; height: 35px; width: 50px;">No</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 130px;">No. Registrasi</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 220px; text-align: left;">Nama Lengkap</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 120px; text-align: left;">Panggilan</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 160px;">NIK</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 160px;">No. KK</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 100px;">Kelamin</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 150px; text-align: left;">Tempat Lahir</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 120px;">Tanggal Lahir</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 80px;">Usia</th>
        
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 180px; text-align: left;">Nama Ayah</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 150px; text-align: left;">Pekerjaan Ayah</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 140px;">No HP Ayah</th>
        
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 180px; text-align: left;">Nama Ibu</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 150px; text-align: left;">Pekerjaan Ibu</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 140px;">No HP Ibu</th>
        
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 350px; text-align: left;">Alamat Lengkap</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 150px; text-align: left;">Kecamatan</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 150px; text-align: left;">Kota/Kabupaten</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 150px; text-align: left;">Provinsi</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 100px;">Kode Pos</th>
        
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 120px;">Status</th>
        <th style="background-color: #059669; color: white; font-weight: bold; border: 1px solid #047857; width: 150px;">Tanggal Daftar</th>
    </tr>

    @php
        $statusMap = [
            'pending'   => 'Menunggu',
            'verifying' => 'Verifikasi',
            'accepted'  => 'Diterima',
            'rejected'  => 'Ditolak',
        ];
        $statusColor = [
            'pending'   => '#D97706', // amber
            'verifying' => '#D97706',
            'accepted'  => '#059669', // emerald
            'rejected'  => '#DC2626', // red
        ];
    @endphp

    @foreach($applicants as $index => $app)
        @php
            $student = $app->student;
            $parent  = $app->parent;
            $address = $app->address;
            $age = $student ? \Carbon\Carbon::parse($student->birth_date)->age . ' Thn' : '-';
            $gender = ($student && $student->gender == 'L') ? 'Laki-laki' : 'Perempuan';
            
            // Zebra striping colors (soft)
            $bgColor = $index % 2 == 0 ? '#ffffff' : '#F9FAFB';
            $bd = '1px solid #D1D5DB';
        @endphp
        <tr>
            <td style="text-align: center; border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $index + 1 }}</td>
            <td style="text-align: center; border: {{ $bd }}; font-weight: bold; background-color: {{ $bgColor }}; color: #111827; mso-number-format:'\@';">{{ $app->reg_number ?? '-' }}</td>
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #111827;">{{ $student->full_name ?? '-' }}</td>
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $student->nickname ?? '-' }}</td>
            <td style="text-align: center; border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151; mso-number-format:'\@';">{{ $student->nik ?? '-' }}</td>
            <td style="text-align: center; border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151; mso-number-format:'\@';">{{ $student->no_kk ?? '-' }}</td>
            <td style="text-align: center; border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $gender }}</td>
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $student->birth_place ?? '-' }}</td>
            <td style="text-align: center; border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $student ? \Carbon\Carbon::parse($student->birth_date)->format('d-m-Y') : '-' }}</td>
            <td style="text-align: center; border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $age }}</td>
            
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #111827;">{{ $parent->father_name ?? '-' }}</td>
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $parent->father_job ?? '-' }}</td>
            <td style="text-align: center; border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151; mso-number-format:'\@';">{{ $parent->father_phone ?? '-' }}</td>
            
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #111827;">{{ $parent->mother_name ?? '-' }}</td>
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $parent->mother_job ?? '-' }}</td>
            <td style="text-align: center; border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151; mso-number-format:'\@';">{{ $parent->mother_phone ?? '-' }}</td>
            
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $address->address_line ?? '-' }}</td>
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $address->district ?? '-' }}</td>
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $address->city ?? '-' }}</td>
            <td style="border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151;">{{ $address->province ?? '-' }}</td>
            <td style="text-align: center; border: {{ $bd }}; background-color: {{ $bgColor }}; color: #374151; mso-number-format:'\@';">{{ $address->postal_code ?? '-' }}</td>
            
            <td style="text-align: center; border: {{ $bd }}; font-weight: bold; background-color: {{ $bgColor }}; color: {{ $statusColor[$app->status] ?? '#111827' }};">
                {{ $statusMap[$app->status] ?? strtoupper($app->status) }}
            </td>
            <td style="text-align: center; border: {{ $bd }}; background-color: {{ $bgColor }}; color: #6B7280;">{{ $app->created_at ? $app->created_at->format('d-m-Y H:i') : '-' }}</td>
        </tr>
    @endforeach
</table>
