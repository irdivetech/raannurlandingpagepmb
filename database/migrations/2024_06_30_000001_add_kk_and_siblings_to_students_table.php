<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('no_kk')->nullable()->after('nik');
            $table->integer('child_order')->nullable()->after('gender');
            $table->integer('siblings_count')->nullable()->after('child_order');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['no_kk', 'child_order', 'siblings_count']);
        });
    }
};
