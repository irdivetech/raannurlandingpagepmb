<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->string('father_name');
            $table->string('father_job');
            $table->string('father_phone');
            $table->string('mother_name');
            $table->string('mother_job');
            $table->string('mother_phone');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_parents');
    }
};
