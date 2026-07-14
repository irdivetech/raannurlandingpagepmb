<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ringkasan Dashboard - {{ $registration->reg_number ?? 'Anonim' }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            font-size: 14px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #10b981;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #10b981;
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 14px;
        }
        .content-section {
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
        }
        .section-title {
            background-color: #ecfdf5;
            color: #047857;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            border-left: 4px solid #10b981;
            margin-top: 0;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px 15px;
            text-align: left;
            border-bottom: 1px solid #f3f4f6;
        }
        th {
            width: 35%;
            color: #6b7280;
            font-weight: normal;
        }
        td {
            font-weight: bold;
            color: #111827;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-pending { background-color: #fef3c7; color: #d97706; }
        .status-verified { background-color: #d1fae5; color: #059669; }
        .status-rejected { background-color: #fee2e2; color: #dc2626; }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>RAUDHATUL ATHFAL (RA) AN-NUUR</h1>
        <p>Ringkasan Informasi Pendaftaran Calon Siswa</p>
    </div>

    <div class="content-section">
        <div class="section-title">Informasi Pendaftaran</div>
        <table>
            <tr>
                <th>Nomor Pendaftaran</th>
                <td>{{ $registration->reg_number }}</td>
            </tr>
            <tr>
                <th>Status Pendaftaran</th>
                <td>
                    @php
                        $statusClass = 'status-pending';
                        $statusText = 'Menunggu';
                        if ($registration->status == 'verified') {
                            $statusClass = 'status-verified';
                            $statusText = 'Terverifikasi';
                        } elseif ($registration->status == 'rejected') {
                            $statusClass = 'status-rejected';
                            $statusText = 'Ditolak';
                        } elseif ($registration->status == 'pending') {
                            $statusClass = 'status-pending';
                            $statusText = 'Pengisian Formulir';
                        }
                    @endphp
                    <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
                </td>
            </tr>
            <tr>
                <th>Tanggal Mendaftar</th>
                <td>{{ $registration->created_at->format('d F Y') }}</td>
            </tr>
        </table>
    </div>

    <div class="content-section">
        <div class="section-title">Data Calon Siswa</div>
        <table>
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $registration->student->full_name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ ($registration->student->gender ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <th>Tempat, Tanggal Lahir</th>
                <td>{{ $registration->student->birth_place ?? '-' }}, {{ $registration->student->birth_date ? \Carbon\Carbon::parse($registration->student->birth_date)->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <th>NIK</th>
                <td>{{ $registration->student->nik ?? '-' }}</td>
            </tr>
            <tr>
                <th>Cita-cita</th>
                <td>{{ $registration->student->cita_cita ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="content-section">
        <div class="section-title">Data Orang Tua / Wali</div>
        <table>
            <tr>
                <th>Nama Ayah / Wali</th>
                <td>{{ $registration->parent->father_name ?? '-' }}</td>
            </tr>
            <tr>
                <th>NIK Ayah</th>
                <td>{{ $registration->parent->father_nik ?? '-' }}</td>
            </tr>
            <tr>
                <th>Pekerjaan Ayah</th>
                <td>{{ $registration->parent->father_job ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nomor WhatsApp Ayah</th>
                <td>{{ $registration->parent->father_phone ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nama Ibu</th>
                <td>{{ $registration->parent->mother_name ?? '-' }}</td>
            </tr>
            <tr>
                <th>NIK Ibu</th>
                <td>{{ $registration->parent->mother_nik ?? '-' }}</td>
            </tr>
            <tr>
                <th>Pekerjaan Ibu</th>
                <td>{{ $registration->parent->mother_job ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nomor WhatsApp Ibu</th>
                <td>{{ $registration->parent->mother_phone ?? '-' }}</td>
            </tr>
            <tr>
                <th>No. Kartu PKH/KKS</th>
                <td>{{ $registration->parent->no_pkh_kks ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat Lengkap</th>
                <td>{{ $registration->address->address_line ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Dicetak pada {{ now()->format('d F Y H:i:s') }}<br>
        Dokumen ini adalah ringkasan sistem yang sah dari RA AN-NUUR.
    </div>

</body>
</html>
