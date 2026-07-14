<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('cita_cita')->nullable()->after('siblings_count');
        });

        Schema::table('student_parents', function (Blueprint $table) {
            $table->string('father_nik')->nullable()->after('father_name');
            $table->string('father_birth_place')->nullable()->after('father_nik');
            $table->date('father_birth_date')->nullable()->after('father_birth_place');
            
            $table->string('mother_nik')->nullable()->after('mother_name');
            $table->string('mother_birth_place')->nullable()->after('mother_nik');
            $table->date('mother_birth_date')->nullable()->after('mother_birth_place');
            
            $table->string('no_pkh_kks')->nullable()->after('mother_phone');
        });

        DB::statement("ALTER TABLE documents MODIFY COLUMN type ENUM('akta', 'kk', 'ktp_ortu', 'foto', 'pkh_kks')");
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('cita_cita');
        });

        Schema::table('student_parents', function (Blueprint $table) {
            $table->dropColumn([
                'father_nik',
                'father_birth_place',
                'father_birth_date',
                'mother_nik',
                'mother_birth_place',
                'mother_birth_date',
                'no_pkh_kks'
            ]);
        });
        
        DB::statement("ALTER TABLE documents MODIFY COLUMN type ENUM('akta', 'kk', 'ktp_ortu', 'foto')");
    }
};
