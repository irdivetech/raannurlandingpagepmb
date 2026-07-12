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
}
