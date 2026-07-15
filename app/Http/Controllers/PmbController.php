<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registration;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Address;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PmbController extends Controller
{
    public function landing()
    {
        $latestArticles = \App\Models\Article::with('category')
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();
            
        return view('welcome', compact('latestArticles'));
    }

    public function registerStart()
    {
        return view('pmb.register-start');
    }

    public function steps(Request $request)
    {
        // Pass initial data to the wizard view
        $childName = $request->query('childName');
        $email = $request->query('email');
        $phone = $request->query('phone');

        return view('pmb.steps.step-1-student', compact('childName', 'email', 'phone'));
    }

    public function submit(Request $request)
    {
        // Validasi secara sederhana
        $request->validate([
            'email' => 'required|email',
            'childName' => 'required',
            'nik' => 'required|unique:students,nik',
            'no_kk' => 'nullable',
            'child_order' => 'nullable|integer',
            'siblings_count' => 'nullable|integer',
        ]);

        try {
            DB::beginTransaction();

            // 1. Create Registration (Without User)
            $regNumber = 'REG-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $registration = Registration::create([
                'user_id' => null,
                'contact_email' => $request->email,
                'reg_number' => $regNumber,
                'status' => 'verifying'
            ]);

            // 2. Create Student
            Student::create([
                'registration_id' => $registration->id,
                'full_name' => $request->childName,
                'nickname' => $request->nickname,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'gender' => $request->gender,
                'child_order' => $request->child_order,
                'siblings_count' => $request->siblings_count,
                'cita_cita' => $request->cita_cita,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
            ]);

            // 3. Create Parent
            StudentParent::create([
                'registration_id' => $registration->id,
                'father_name' => $request->father_name,
                'father_nik' => $request->father_nik,
                'father_birth_place' => $request->father_birth_place,
                'father_birth_date' => $request->father_birth_date,
                'father_job' => $request->father_job,
                'father_phone' => $request->father_phone,
                'mother_name' => $request->mother_name,
                'mother_nik' => $request->mother_nik,
                'mother_birth_place' => $request->mother_birth_place,
                'mother_birth_date' => $request->mother_birth_date,
                'mother_job' => $request->mother_job,
                'mother_phone' => $request->mother_phone,
                'no_pkh_kks' => $request->no_pkh_kks,
            ]);

            // 4. Create Address
            Address::create([
                'registration_id' => $registration->id,
                'address_line' => $request->address_line,
                'province' => $request->province_name,
                'city' => $request->city_name,
                'district' => $request->district_name,
                'postal_code' => $request->postal_code,
            ]);

            // 5. Handle File Uploads (Optional)
            $documentTypes = ['akta', 'kk', 'ktp_ortu', 'foto', 'pkh_kks'];
            foreach ($documentTypes as $type) {
                if ($request->hasFile($type)) {
                    $path = $request->file($type)->store('documents', 'public');
                    Document::create([
                        'registration_id' => $registration->id,
                        'type' => $type,
                        'file_path' => $path,
                        'status' => 'pending',
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('pmb.success')->with([
                'regNumber' => $regNumber,
                'childName' => $request->childName,
                'email' => $request->email,
                'registration_id' => $registration->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors('Terjadi kesalahan saat pendaftaran: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('pmb.success');
    }
    
    public function createParentAccount(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        
        try {
            DB::beginTransaction();
            
            $user = User::create([
                'name' => 'Orang Tua Wali', // Could be updated later
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'parent'
            ]);
            
            $registration = Registration::findOrFail($request->registration_id);
            $registration->user_id = $user->id;
            $registration->save();
            
            DB::commit();
            
            return redirect()->route('parent.login')->with('success', 'Akun berhasil dibuat! Silakan login.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Terjadi kesalahan saat membuat akun: ' . $e->getMessage());
        }
    }

    public function tracking(Request $request)
    {
        $search = $request->query('query');
        $result = null;

        if ($search) {
            $result = Registration::where('reg_number', $search)
                ->orWhereHas('student', function($q) use ($search) {
                    $q->where('nik', $search);
                })->with('student')->first();
        }

        return view('pmb.tracking', compact('result'));
    }

    public function downloadBlankFormulir()
    {
        $setting = \App\Models\Setting::where('key', 'formulir_pdf_path')->first();
        if ($setting && $setting->value && \Illuminate\Support\Facades\Storage::disk('public')->exists($setting->value)) {
            return \Illuminate\Support\Facades\Storage::disk('public')->download($setting->value, 'Formulir_Pendaftaran_RA_AN_NUUR.pdf');
        }
        return back()->with('error', 'File formulir pendaftaran belum tersedia untuk diunduh.');
    }
}
