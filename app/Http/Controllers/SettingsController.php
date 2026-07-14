<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        
        $target_kuota = $settings->has('target_kuota') ? $settings['target_kuota']->value : 120;
        $biaya_batik = $settings->has('biaya_batik') ? $settings['biaya_batik']->value : '150000';
        $biaya_olahraga = $settings->has('biaya_olahraga') ? $settings['biaya_olahraga']->value : '110000';
        $biaya_lka = $settings->has('biaya_lka') ? $settings['biaya_lka']->value : '120000';
        $biaya_buku = $settings->has('biaya_buku') ? $settings['biaya_buku']->value : '120000';
        $biaya_sampul = $settings->has('biaya_sampul') ? $settings['biaya_sampul']->value : '50000';
        $spp_bulanan = $settings->has('spp_bulanan') ? $settings['spp_bulanan']->value : '20000';
        $biaya_akhir_tahun = $settings->has('biaya_akhir_tahun') ? $settings['biaya_akhir_tahun']->value : '10000';

        $kontak_wa = $settings->has('kontak_wa') ? $settings['kontak_wa']->value : '628174935445';
        $kontak_alamat = $settings->has('kontak_alamat') ? $settings['kontak_alamat']->value : 'Kp. Pasir Nangka RT.003/RW.001, Ds. Sukasirna, Kec. Campakamulya, Kab. Cianjur, Jawa Barat 43269';
        $kontak_email = $settings->has('kontak_email') ? $settings['kontak_email']->value : 'info@raannuur.sch.id';
        $formulir_pdf_path = $settings->has('formulir_pdf_path') ? $settings['formulir_pdf_path']->value : null;
        
        return view('admin.settings.index', compact(
            'target_kuota', 'biaya_batik', 'biaya_olahraga', 'biaya_lka', 'biaya_buku', 'biaya_sampul', 'spp_bulanan', 'biaya_akhir_tahun', 'kontak_wa', 'kontak_alamat', 'kontak_email', 'formulir_pdf_path'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'target_kuota' => 'required|integer|min:1',
            'biaya_batik' => 'required|string',
            'biaya_olahraga' => 'required|string',
            'biaya_lka' => 'required|string',
            'biaya_buku' => 'required|string',
            'biaya_sampul' => 'required|string',
            'spp_bulanan' => 'required|string',
            'biaya_akhir_tahun' => 'required|string',
            'kontak_wa' => 'required|string',
            'kontak_alamat' => 'required|string',
            'kontak_email' => 'required|email',
            'formulir_pdf' => 'nullable|file|mimes:pdf|max:5120'
        ]);

        Setting::set('target_kuota', $request->target_kuota, 'integer', 'Total kuota siswa baru yang diterima');
        Setting::set('biaya_batik', $request->biaya_batik, 'string', 'Biaya Seragam Batik');
        Setting::set('biaya_olahraga', $request->biaya_olahraga, 'string', 'Biaya Kaos Olahraga');
        Setting::set('biaya_lka', $request->biaya_lka, 'string', 'Biaya LKA');
        Setting::set('biaya_buku', $request->biaya_buku, 'string', 'Biaya Buku Paket 9 Buku');
        Setting::set('biaya_sampul', $request->biaya_sampul, 'string', 'Biaya Sampul Rapot');
        Setting::set('spp_bulanan', $request->spp_bulanan, 'string', 'Biaya SPP Bulanan');
        Setting::set('biaya_akhir_tahun', $request->biaya_akhir_tahun, 'string', 'Biaya Akhir Tahun per bulan');
        Setting::set('kontak_wa', $request->kontak_wa, 'string', 'Nomor WA kontak resmi (gunakan kode negara 62)');
        Setting::set('kontak_alamat', $request->kontak_alamat, 'string', 'Alamat resmi yayasan');
        Setting::set('kontak_email', $request->kontak_email, 'string', 'Email resmi lembaga');

        if ($request->hasFile('formulir_pdf')) {
            $path = $request->file('formulir_pdf')->storeAs('downloads', 'formulir_pendaftaran_ra_annuur.pdf', 'public');
            Setting::set('formulir_pdf_path', $path, 'string', 'Path to formulir PDF');
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
