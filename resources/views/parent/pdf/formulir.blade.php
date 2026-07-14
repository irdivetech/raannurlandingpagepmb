<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran - {{ $registration->reg_number ?? 'Anonim' }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #111827;
            margin: 0;
            padding: 30px;
            font-size: 13px;
            background-color: #fff;
            line-height: 1.5;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #111827;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .kop-surat h1 {
            margin: 0;
            font-size: 26px;
            color: #047857;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .kop-surat h2 {
            margin: 5px 0 0;
            font-size: 16px;
            font-weight: normal;
            color: #374151;
        }
        .kop-surat p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #6b7280;
        }
        .title {
            text-align: center;
            margin-bottom: 25px;
        }
        .title h3 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
            text-decoration: underline;
        }
        .title p {
            margin: 5px 0 0;
            font-size: 14px;
            font-weight: bold;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .sub-section-title {
            font-size: 13px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 5px;
            text-decoration: underline;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .content-table th, .content-table td {
            padding: 4px 0;
            vertical-align: top;
        }
        .content-table th {
            width: 35%;
            text-align: left;
            font-weight: normal;
        }
        .content-table td {
            font-weight: bold;
        }
        .colon {
            width: 20px;
            text-align: center;
            font-weight: normal;
        }
        ul.checklist {
            list-style-type: square;
            padding-left: 20px;
            margin-top: 5px;
        }
        .signature-section {
            width: 100%;
            margin-top: 40px;
        }
        .signature-box {
            width: 40%;
            float: right;
            text-align: center;
        }
        .signature-box p {
            margin: 0 0 60px 0;
        }
        .signature-line {
            border-bottom: 1px solid #111827;
            margin-bottom: 5px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .photo-box {
            position: absolute;
            top: 130px;
            right: 30px;
            width: 3cm;
            height: 4cm;
            border: 1px solid #111827;
            text-align: center;
            line-height: 4cm;
            font-size: 10px;
            color: #6b7280;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>RAUDHATUL ATHFAL (RA) AN-NUUR</h1>
        <h2>YAYASAN AN-NUUR NURUL IMAN</h2>
        <p>Nomor Ijin Operasional (NSPAUD): 101232030134</p>
        <p>Alamat: Kp. Cijeruk RT.04/RW.02, Desa Waringinsari, Kec. Takokak, Kab. Cianjur</p>
    </div>

    <div class="title">
        <h3>Formulir Pendaftaran Siswa RA AN-NUUR</h3>
        <p>Tahun Ajaran {{ date('Y') }} / {{ date('Y')+1 }}</p>
    </div>

    <div class="photo-box">
        Pas Foto 3x4
    </div>

    <div class="section-title">A. DATA CALON PESERTA DIDIK</div>
    <table class="content-table">
        <tr>
            <th>Nomor Pendaftaran</th>
            <td class="colon">:</td>
            <td style="color: #047857;">{{ $registration->reg_number ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nomor KK</th>
            <td class="colon">:</td>
            <td>{{ $registration->student->no_kk ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td class="colon">:</td>
            <td>{{ $registration->student->full_name ?? '-' }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td class="colon">:</td>
            <td>{{ $registration->student->nik ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td class="colon">:</td>
            <td>{{ $registration->student->birth_place ?? '-' }}, {{ $registration->student->birth_date ? \Carbon\Carbon::parse($registration->student->birth_date)->format('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td class="colon">:</td>
            <td>{{ ($registration->student->gender ?? '') == 'L' ? 'Laki-laki' : (($registration->student->gender ?? '') == 'P' ? 'Perempuan' : '-') }}</td>
        </tr>
        <tr>
            <th>Anak Ke</th>
            <td class="colon">:</td>
            <td>{{ $registration->student->child_order ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jumlah Saudara</th>
            <td class="colon">:</td>
            <td>{{ $registration->student->siblings_count ?? '-' }}</td>
        </tr>
        <tr>
            <th>Cita-cita</th>
            <td class="colon">:</td>
            <td>{{ $registration->student->cita_cita ?? '-' }}</td>
        </tr>
        <tr>
            <th>Alamat Lengkap</th>
            <td class="colon">:</td>
            <td>{{ $registration->address->address_line ?? '-' }}, {{ $registration->address->district ?? '' }}, {{ $registration->address->city ?? '' }}, {{ $registration->address->province ?? '' }} {{ $registration->address->postal_code ?? '' }}</td>
        </tr>
    </table>

    <div class="section-title">B. DATA ORANG TUA</div>
    
    <div class="sub-section-title">Data Ayah</div>
    <table class="content-table">
        <tr>
            <th>Nama Ayah</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->father_name ?? '-' }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->father_nik ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->father_birth_place ?? '-' }}, {{ $registration->parent->father_birth_date ? \Carbon\Carbon::parse($registration->parent->father_birth_date)->format('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <th>Pekerjaan</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->father_job ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->father_phone ?? '-' }}</td>
        </tr>
    </table>

    <div class="sub-section-title">Data Ibu</div>
    <table class="content-table">
        <tr>
            <th>Nama Ibu</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->mother_name ?? '-' }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->mother_nik ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->mother_birth_place ?? '-' }}, {{ $registration->parent->mother_birth_date ? \Carbon\Carbon::parse($registration->parent->mother_birth_date)->format('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <th>Pekerjaan</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->mother_job ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->mother_phone ?? '-' }}</td>
        </tr>
        <tr>
            <th>No. Kartu PKH/KKS (Opsional)</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->no_pkh_kks ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">C. BERKAS YANG HARUS DILAMPIRKAN</div>
    <ul class="checklist">
        <li>Fotokopi Kartu Keluarga (KK)</li>
        <li>Fotokopi Akta Kelahiran</li>
        <li>Fotokopi KTP Orang Tua (Ayah dan Ibu)</li>
        <li>Pas Foto Calon Siswa (Ukuran 3x4)</li>
        <li>Fotokopi Kartu PKH/KKS (Jika ada)</li>
    </ul>

    <div class="signature-section clearfix">
        <div class="signature-box" style="float: left;">
            <p>Panitia Penerimaan Siswa Baru,</p>
            <div class="signature-line"></div>
            <span>( ........................................... )</span>
        </div>
        <div class="signature-box">
            <p>Orang Tua / Wali Calon Siswa,</p>
            <div class="signature-line"></div>
            <span>( {{ $registration->parent->father_name ?? $registration->parent->mother_name ?? '...........................................' }} )</span>
        </div>
    </div>

</body>
</html>
