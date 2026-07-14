<table border="1" style="border-collapse: collapse; width: 100%; font-family: sans-serif;">
    <thead>
        <tr>
            <th colspan="33" style="background-color: #059669; color: #ffffff; font-size: 18px; font-weight: bold; text-align: center; height: 50px; vertical-align: middle;">
                DATA CALON SISWA - RA AN-NUUR ISLAMIC KINDERGARTEN
            </th>
        </tr>
        <tr>
            <th colspan="33" style="text-align: center; font-style: italic; background-color: #f3f4f6; height: 30px; vertical-align: middle;">
                Tanggal Export: {{ date('d-m-Y H:i') }} | Total Data: {{ count($applicants) }} Pendaftar
            </th>
        </tr>
        <tr>
            <th colspan="33" style="height: 15px; border: none;"></th>
        </tr>
        <tr>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; height: 35px; width: 50px;">No</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 120px;">No. Registrasi</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 200px;">Nama Lengkap</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 120px;">Panggilan</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 150px;">NIK</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 150px;">No. KK</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 100px;">Jenis Kelamin</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 150px;">Tempat Lahir</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 120px;">Tanggal Lahir</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 80px;">Usia</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 80px;">Anak Ke</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 100px;">Jml Saudara</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 150px;">Cita-cita</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 180px;">Nama Ayah</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 150px;">NIK Ayah</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 150px;">Tempat Lahir Ayah</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 120px;">Tgl Lahir Ayah</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 150px;">Pekerjaan Ayah</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 130px;">No HP Ayah</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 180px;">Nama Ibu</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 150px;">NIK Ibu</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 150px;">Tempat Lahir Ibu</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 120px;">Tgl Lahir Ibu</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 150px;">Pekerjaan Ibu</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 130px;">No HP Ibu</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 150px;">No PKH/KKS</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 300px;">Alamat</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 150px;">Kecamatan</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 150px;">Kota/Kabupaten</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: left; width: 150px;">Provinsi</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 100px;">Kode Pos</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 120px;">Status</th>
            <th style="background-color: #059669; color: white; font-weight: bold; text-align: center; width: 150px;">Tanggal Daftar</th>
        </tr>
    </thead>
    <tbody>
        @php
            $statusMap = [
                'pending'   => 'Menunggu',
                'verifying' => 'Verifikasi',
                'accepted'  => 'Diterima',
                'rejected'  => 'Ditolak',
            ];
        @endphp
        @foreach($applicants as $index => $app)
            @php
                $student = $app->student;
                $parent  = $app->parent;
                $address = $app->address;
                $age = $student ? \Carbon\Carbon::parse($student->birth_date)->age . ' Thn' : '-';
                $gender = ($student && $student->gender == 'L') ? 'Laki-laki' : 'Perempuan';
                $bgColor = $index % 2 == 0 ? '#ffffff' : '#f9fafb';
            @endphp
            <tr>
                <td style="text-align: center; background-color: {{ $bgColor }};">{{ $index + 1 }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }}; font-weight: bold; mso-number-format:'\@';">{{ $app->reg_number ?? '-' }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $student->full_name ?? '-' }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $student->nickname ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }}; mso-number-format:'\@';">{{ $student->nik ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }}; mso-number-format:'\@';">{{ $student->no_kk ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }};">{{ $gender }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $student->birth_place ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }};">{{ $student ? \Carbon\Carbon::parse($student->birth_date)->format('d-m-Y') : '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }};">{{ $age }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }};">{{ $student->child_order ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }};">{{ $student->siblings_count ?? '-' }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $student->cita_cita ?? '-' }}</td>
                
                <td style="background-color: {{ $bgColor }};">{{ $parent->father_name ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }}; mso-number-format:'\@';">{{ $parent->father_nik ?? '-' }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $parent->father_birth_place ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }};">{{ $parent->father_birth_date ? \Carbon\Carbon::parse($parent->father_birth_date)->format('d-m-Y') : '-' }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $parent->father_job ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }}; mso-number-format:'\@';">{{ $parent->father_phone ?? '-' }}</td>
                
                <td style="background-color: {{ $bgColor }};">{{ $parent->mother_name ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }}; mso-number-format:'\@';">{{ $parent->mother_nik ?? '-' }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $parent->mother_birth_place ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }};">{{ $parent->mother_birth_date ? \Carbon\Carbon::parse($parent->mother_birth_date)->format('d-m-Y') : '-' }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $parent->mother_job ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }}; mso-number-format:'\@';">{{ $parent->mother_phone ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }}; mso-number-format:'\@';">{{ $parent->no_pkh_kks ?? '-' }}</td>
                
                <td style="background-color: {{ $bgColor }};">{{ $address->address_line ?? '-' }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $address->district ?? '-' }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $address->city ?? '-' }}</td>
                <td style="background-color: {{ $bgColor }};">{{ $address->province ?? '-' }}</td>
                <td style="text-align: center; background-color: {{ $bgColor }}; mso-number-format:'\@';">{{ $address->postal_code ?? '-' }}</td>
                
                <td style="text-align: center; background-color: {{ $bgColor }}; font-weight: bold;">
                    {{ $statusMap[$app->status] ?? strtoupper($app->status) }}
                </td>
                <td style="text-align: center; background-color: {{ $bgColor }};">{{ $app->created_at ? $app->created_at->format('d-m-Y H:i') : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
