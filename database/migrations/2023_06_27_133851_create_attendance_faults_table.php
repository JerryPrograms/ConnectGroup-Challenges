<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendance_faults', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('attendance_id');
            $table->string('fault_reason');
            // Add other relevant attributes for attendance faults

            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('attendance_id')->references('id')->on('attendances');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_faults');
    }
};
