<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Student;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    public function index()
    {
        // 1. Status Breakdown
        $statusCounts = Registration::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $total = $statusCounts->sum();

        // 2. Gender Demographics
        $genderCounts = Student::whereHas('registration')->selectRaw('gender, count(*) as count')
            ->groupBy('gender')
            ->pluck('count', 'gender');
            
        // 3. Age Groups (Kelompok A: < 5 tahun, Kelompok B: >= 5 tahun)
        // Since sqlite doesn't have simple DATEDIFF, we can calculate via PHP
        $students = Student::whereHas('registration')->get();
        $kelompokA = 0;
        $kelompokB = 0;
        
        foreach ($students as $student) {
            $age = Carbon::parse($student->birth_date)->age;
            if ($age >= 5) {
                $kelompokB++;
            } else {
                $kelompokA++;
            }
        }

        // 4. Registration Trends (Last 7 Days)
        $trends = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $count = Registration::whereDate('created_at', $date)->count();
            $trends[] = [
                'date' => Carbon::now()->subDays($i)->format('d M'),
                'count' => $count
            ];
        }

        return view('admin.reports.index', compact(
            'statusCounts', 
            'total', 
            'genderCounts', 
            'kelompokA', 
            'kelompokB',
            'trends'
        ));
    }

    public function export(Request $request)
    {
        $fileName = 'Laporan_Pendaftaran_' . date('Ymd_His') . '.xls';

        $statusCounts = Registration::selectRaw('status, count(*) as count')->groupBy('status')->pluck('count', 'status');
        $total = $statusCounts->sum();
        
        $genderCounts = Student::whereHas('registration')->selectRaw('gender, count(*) as count')->groupBy('gender')->pluck('count', 'gender');
        
        $students = Student::whereHas('registration')->get();
        $kelA = 0; $kelB = 0;
        foreach ($students as $s) {
            if (\Carbon\Carbon::parse($s->birth_date)->age >= 5) { $kelB++; } else { $kelA++; }
        }

        $applicants = Registration::with(['student', 'parent', 'address'])->latest()->get();

        return response(view('admin.exports.reports', compact('statusCounts', 'total', 'genderCounts', 'kelA', 'kelB', 'applicants')))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}
