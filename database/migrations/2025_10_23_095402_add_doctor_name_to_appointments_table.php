<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('doctor_name')->nullable()->after('speciality');
        });

        // Update existing appointments with doctor names from speciality field
        DB::statement("
            UPDATE appointments 
            SET doctor_name = TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(speciality, '--', 1), 'Doctor ', -1))
            WHERE speciality LIKE 'Doctor%'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('doctor_name');
        });
    }
};
