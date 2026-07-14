<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class PublicController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function biaya()
    {
        return view('public.biaya');
    }

    public function kontak()
    {
        return view('public.kontak');
    }

    public function checkStatus(Request $request)
    {
        $registration = null;
        $error = null;

        if ($request->has('reg_number')) {
            $request->validate([
                'reg_number' => 'required|string|min:5'
            ]);

            $registration = Registration::with('student')->where('reg_number', $request->reg_number)->first();

            if (!$registration) {
                $error = 'Nomor Pendaftaran tidak ditemukan. Pastikan Anda memasukkan nomor yang benar.';
            }
        }

        return view('public.check-status', compact('registration', 'error'));
    }

    public function downloadFormulir()
    {
        $path = \App\Models\Setting::get('formulir_pdf_path');
        
        if ($path && \Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            return \Illuminate\Support\Facades\Storage::disk('public')->download($path, 'formulir_pendaftaran_ra_annuur.pdf');
        }
        
        return back()->with('error', 'File formulir belum tersedia.');
    }
}
