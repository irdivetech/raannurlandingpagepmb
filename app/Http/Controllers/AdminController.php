<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\Address;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function dashboard()
    {
        $total = Registration::count();
        $verifying = Registration::where('status', 'verifying')->count();
        $accepted = Registration::where('status', 'accepted')->count();
        $rejected = Registration::where('status', 'rejected')->count();

        $recentApplicants = Registration::with('student')->latest()->take(5)->get();
        
        $target_kuota = \App\Models\Setting::get('target_kuota', 120);

        // Data untuk Grafik Perkembangan Murid (Tahun ke Tahun)
        $yearlyData = Registration::where('status', 'accepted')
            ->get()
            ->groupBy(function($reg) {
                return $reg->created_at->format('Y');
            })
            ->map(function($group) {
                return $group->count();
            })
            ->sortKeys();
            
        $yearlyLabels = $yearlyData->keys()->toJson();
        $yearlyCounts = $yearlyData->values()->toJson();

        return view('admin.dashboard', compact('total', 'verifying', 'accepted', 'rejected', 'recentApplicants', 'target_kuota', 'yearlyLabels', 'yearlyCounts'));
    }

    public function applicants(Request $request)
    {
        $query = Registration::with('student');

        // Apply Search Filter
        if ($request->has('q') && $request->q !== '') {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('reg_number', 'like', "%{$searchTerm}%")
                  ->orWhereHas('student', function($sq) use ($searchTerm) {
                      $sq->where('full_name', 'like', "%{$searchTerm}%")
                         ->orWhere('nik', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Apply Status Filter
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        } else {
             // By default, show all relevant statuses (excluding pending if you want, or just show all)
            $query->whereIn('status', ['pending', 'verifying', 'rejected', 'accepted']);
        }

        // Apply Sorting
        if ($request->has('sort')) {
            if ($request->sort === 'oldest') {
                $query->oldest();
            } elseif ($request->sort === 'name_asc') {
                $query->join('students', 'registrations.student_id', '=', 'students.id')
                      ->orderBy('students.full_name', 'asc')
                      ->select('registrations.*');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $applicants = $query->paginate(10)->withQueryString();
        return view('admin.applicants.index', compact('applicants'));
    }

    public function exportApplicants(Request $request)
    {
        $query = Registration::with(['student', 'parent', 'address']);

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $applicants = $query->latest()->get();
        $fileName = 'Data_Calon_Siswa_' . date('Ymd_His') . '.xls';

        return response(view('admin.exports.applicants', compact('applicants')))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function detail($reg_number)
    {
        $registration = Registration::with(['student', 'parent', 'address', 'documents'])
            ->where('reg_number', $reg_number)
            ->firstOrFail();

        return view('admin.applicants.detail', compact('registration'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:verifying,accepted,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $registration = Registration::findOrFail($id);

        // Quota check logic
        if ($request->status === 'accepted' && $registration->status !== 'accepted') {
            $target_kuota = \App\Models\Setting::get('target_kuota', 120);
            $accepted_count = Registration::where('status', 'accepted')->count();
            
            if ($accepted_count >= $target_kuota) {
                return redirect()->back()->with('error', "Gagal menyetujui. Kuota siswa telah penuh ({$accepted_count}/{$target_kuota}).");
            }
        }

        $registration->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function verifyDocument(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'notes' => 'nullable|string',
        ]);

        $document = \App\Models\Document::findOrFail($id);
        $data = ['status' => $request->status];
        if ($request->filled('notes')) {
            $data['notes'] = $request->notes;
        }
        $document->update($data);

        return redirect()->back()->with('success', 'Status dokumen berhasil diperbarui.');
    }

    public function createApplicant()
    {
        return view('admin.applicants.create');
    }

    public function storeApplicant(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'full_name' => 'required',
            'nik' => 'required|unique:students,nik',
            'no_kk' => 'nullable',
            'gender' => 'required|in:L,P',
            'birth_place' => 'required',
            'birth_date' => 'required|date',
            'father_name' => 'required',
            'mother_name' => 'required',
            'father_phone' => 'required',
            'address_line' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'postal_code' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // 0. Create Parent User Account (If requested)
            $userId = null;
            if ($request->has('create_account') && $request->create_account == '1') {
                $request->validate([
                    'email' => 'unique:users,email',
                    'password' => 'required|min:6',
                ]);

                $user = \App\Models\User::create([
                    'name' => $request->father_name ?? $request->mother_name,
                    'email' => $request->email,
                    'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                    'role' => 'parent'
                ]);
                $userId = $user->id;
            }

            // 1. Create Registration (Without User initially unless created above)
            $regNumber = 'REG-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $registration = Registration::create([
                'user_id' => $userId,
                'contact_email' => $request->email,
                'reg_number' => $regNumber,
                'status' => 'verifying'
            ]);

            // 2. Create Student
            Student::create([
                'registration_id' => $registration->id,
                'full_name' => $request->full_name,
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
                'province' => $request->province,
                'city' => $request->city,
                'district' => $request->district,
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

            return redirect()->route('admin.applicants.detail', $regNumber)->with('success', 'Pendaftaran manual berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors('Terjadi kesalahan saat pendaftaran: ' . $e->getMessage());
        }
    }
}
