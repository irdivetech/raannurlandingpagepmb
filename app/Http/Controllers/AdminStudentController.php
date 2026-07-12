<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = Registration::where('status', 'accepted')
            ->with(['student', 'parent', 'address'])
            ->latest()
            ->paginate(10);
        
        return view('admin.students.index', compact('students'));
    }

    public function edit($id)
    {
        $registration = Registration::with(['student', 'parent', 'address'])->findOrFail($id);
        return view('admin.students.edit', compact('registration'));
    }

    public function update(Request $request, $id)
    {
        $registration = Registration::findOrFail($id);
        
        $request->validate([
            'full_name' => 'required|string',
            'nik' => 'required|string',
            'no_kk' => 'nullable|string',
            'child_order' => 'nullable|integer',
            'siblings_count' => 'nullable|integer',
            'gender' => 'required|in:L,P',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'father_phone' => 'required|string',
            'address_line' => 'required|string'
        ]);

        if($registration->student) {
            $registration->student->update($request->only([
                'full_name', 'nickname', 'nik', 'no_kk', 'child_order', 'siblings_count', 'gender', 'birth_place', 'birth_date'
            ]));
        }

        if($registration->parent) {
            $registration->parent->update($request->only([
                'father_name', 'father_job', 'father_phone',
                'mother_name', 'mother_job', 'mother_phone'
            ]));
        }

        if($registration->address) {
            $registration->address->update($request->only([
                'address_line', 'province', 'city', 'district', 'postal_code'
            ]));
        }

        return redirect()->route('admin.students.index')->with('success', 'Data keseluruhan siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil dihapus secara permanen.');
    }
}
