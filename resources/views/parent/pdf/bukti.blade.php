<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - {{ $registration->reg_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #111827;
            margin: 0;
            padding: 30px;
            font-size: 14px;
            background-color: #fff;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #111827;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .kop-surat h1 {
            margin: 0;
            font-size: 28px;
            color: #047857;
            text-transform: uppercase;
            letter-spacing: 1.5px;
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
            margin-bottom: 30px;
        }
        .title h3 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
            text-decoration: underline;
        }
        .title p {
            margin: 5px 0 0;
            font-size: 14px;
            font-weight: bold;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .content-table th, .content-table td {
            padding: 8px 0;
            vertical-align: top;
        }
        .content-table th {
            width: 35%;
            text-align: left;
            font-weight: normal;
            color: #4b5563;
        }
        .content-table td {
            font-weight: bold;
        }
        .colon {
            width: 20px;
            text-align: center;
            font-weight: normal;
        }
        .info-box {
            background-color: #f3f4f6;
            border: 1px dashed #9ca3af;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 40px;
            font-size: 12px;
            color: #4b5563;
        }
        .info-box h4 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #111827;
            font-size: 14px;
        }
        .info-box ul {
            margin: 0;
            padding-left: 20px;
        }
        .info-box li {
            margin-bottom: 5px;
        }
        .signature-section {
            width: 100%;
            margin-top: 50px;
        }
        .signature-box {
            width: 40%;
            float: right;
            text-align: center;
        }
        .signature-box p {
            margin: 0 0 70px 0;
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
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>RAUDHATUL ATHFAL (RA) AN-NUUR</h1>
        <h2>YAYASAN AN-NUUR NURUL IMAN</h2>
        <p>NSPAUD: 101232030134</p>
        <p>Alamat: Kp. Cijeruk RT.04/RW.02, Desa Waringinsari, Kec. Takokak, Kab. Cianjur</p>
    </div>

    <div class="title">
        <h3>Tanda Bukti Pendaftaran</h3>
        <p>Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
    </div>

    <table class="content-table">
        <tr>
            <th>Nomor Pendaftaran</th>
            <td class="colon">:</td>
            <td style="font-size: 16px; color: #047857;">{{ $registration->reg_number }}</td>
        </tr>
        <tr>
            <th>Tanggal Pendaftaran</th>
            <td class="colon">:</td>
            <td>{{ $registration->created_at->format('d F Y') }}</td>
        </tr>
        <tr>
            <td colspan="3"><br><strong>A. DATA CALON SISWA</strong></td>
        </tr>
        <tr>
            <th>NIK Siswa</th>
            <td class="colon">:</td>
            <td>{{ $registration->student->nik ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td class="colon">:</td>
            <td>{{ $registration->student->full_name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td class="colon">:</td>
            <td>{{ ($registration->student->gender ?? '') == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td class="colon">:</td>
            <td>{{ $registration->student->birth_place ?? '-' }}, {{ $registration->student->birth_date ? \Carbon\Carbon::parse($registration->student->birth_date)->format('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <td colspan="3"><br><strong>B. DATA ORANG TUA / WALI</strong></td>
        </tr>
        <tr>
            <th>Nama Ayah / Wali</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->father_name ?? '-' }}</td>
        </tr>
        <tr>
            <th>NIK Ayah</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->father_nik ?? '-' }}</td>
        </tr>
        <tr>
            <th>Pekerjaan Ayah</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->father_job ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon / WA</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->father_phone ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nama Ibu</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->mother_name ?? '-' }}</td>
        </tr>
        <tr>
            <th>NIK Ibu</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->mother_nik ?? '-' }}</td>
        </tr>
        <tr>
            <th>Pekerjaan Ibu</th>
            <td class="colon">:</td>
            <td>{{ $registration->parent->mother_job ?? '-' }}</td>
        </tr>
    </table>

    <div class="info-box">
        <h4>Pemberitahuan Penting:</h4>
        <ul>
            <li>Simpan bukti pendaftaran ini dengan baik sebagai syarat untuk tahapan seleksi/wawancara.</li>
            <li>Harap melengkapi dokumen persyaratan (Akta Kelahiran, KK, dll) melalui portal orang tua.</li>
            <li>Informasi lebih lanjut mengenai jadwal wawancara/observasi akan diumumkan melalui portal atau dihubungi via WhatsApp.</li>
        </ul>
    </div>

    <div class="signature-section clearfix">
        <div class="signature-box">
            <p>Panitia Penerimaan Siswa Baru,<br>{{ date('d F Y') }}</p>
            <div class="signature-line"></div>
            <span>( ........................................... )</span>
        </div>
    </div>

</body>
</html>
