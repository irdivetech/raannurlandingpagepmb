<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('registrations', 'notes')) {
                $table->text('notes')->nullable()->after('status');
            }
            if (!Schema::hasColumn('registrations', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('status');
            }
        });

        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'notes')) {
                $table->text('notes')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn('notes');
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
};
