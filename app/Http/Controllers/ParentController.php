<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $registration = $user->registration()->with(['student', 'parent', 'address', 'documents'])->first();

        return view('parent.dashboard', compact('registration', 'user'));
    }

    public function downloadDashboardPdf()
    {
        $user = Auth::user();
        $registration = $user->registration()->with(['student', 'parent', 'address', 'documents'])->first();

        $pdf = app('dompdf.wrapper')->loadView('parent.pdf.dashboard', compact('registration', 'user'));
        
        return $pdf->download('ringkasan_dashboard_' . ($registration->reg_number ?? 'anon') . '.pdf');
    }

    public function announcements()
    {
        $announcements = \App\Models\Announcement::where('is_active', true)->latest()->get();
        return view('parent.announcements', compact('announcements'));
    }

    public function status()
    {
        $registration = Auth::user()->registration()->with(['student', 'documents'])->first();
        return view('parent.status', compact('registration'));
    }

    public function downloadBuktiPdf()
    {
        $registration = Auth::user()->registration()->with(['student', 'parent', 'address'])->first();

        if (!$registration) {
            return back()->with('error', 'Data registrasi tidak ditemukan.');
        }

        $pdf = app('dompdf.wrapper')->loadView('parent.pdf.bukti', compact('registration'));
        
        return $pdf->download('bukti_pendaftaran_' . $registration->reg_number . '.pdf');
    }

    public function documents()
    {
        $registration = Auth::user()->registration()->with('documents')->first();
        return view('parent.documents', compact('registration'));
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'type' => 'required|in:akta,kk,ktp_ortu,foto',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $registration = Auth::user()->registration()->first();

        if (!$registration) {
            return back()->with('error', 'Data registrasi tidak ditemukan.');
        }

        if ($request->hasFile('file')) {
            // Store in public disk → storage/app/public/documents/
            // Path saved: 'documents/xxx.jpg'
            // URL: /storage/documents/xxx.jpg  ✓
            $path = $request->file('file')->store('documents', 'public');
            
            \App\Models\Document::updateOrCreate(
                ['registration_id' => $registration->id, 'type' => $request->type],
                ['file_path' => $path, 'status' => 'pending']
            );
        }

        return back()->with('success', 'Dokumen berhasil diunggah! Menunggu verifikasi admin.');
    }

    public function profile()
    {
        $user = Auth::user();
        $parentData = $user->registration ? $user->registration->parent : null;
        $addressData = $user->registration ? $user->registration->address : null;

        return view('parent.profile', compact('user', 'parentData', 'addressData'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'father_name' => 'required|string',
            'father_job' => 'nullable|string',
            'father_phone' => 'required|string',
            'address_line' => 'required|string',
        ]);

        $user = Auth::user();
        if ($user->registration && $user->registration->parent) {
            $user->registration->parent->update([
                'father_name' => $request->father_name,
                'father_job' => $request->father_job,
                'father_phone' => $request->father_phone,
            ]);
        }
        
        if ($user->registration && $user->registration->address) {
            $user->registration->address->update([
                'address_line' => $request->address_line
            ]);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function editStudent()
    {
        $user = Auth::user();
        $studentData = $user->registration ? $user->registration->student : null;

        return view('parent.student-edit', compact('user', 'studentData'));
    }

    public function updateStudent(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'gender' => 'required|in:L,P',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'nik' => 'nullable|string|max:16',
        ]);

        $user = Auth::user();
        if ($user->registration && $user->registration->student) {
            $user->registration->student->update([
                'full_name' => $request->full_name,
                'gender' => $request->gender,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'nik' => $request->nik,
            ]);
        }

        return redirect()->back()->with('success', 'Data Calon Siswa berhasil diperbarui.');
    }
}
