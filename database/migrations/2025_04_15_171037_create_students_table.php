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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete(); // foreign key to schools table
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // foreign key to schools table
            $table->string('gender');
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('enrollment_status')->default('active'); // e.g., active, inactive
            $table->string('student_code')->unique()->nullable(); // unique identifier for the student
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('medical_conditions')->nullable(); // any medical conditions
            $table->string('allergies')->nullable(); // any allergies
            $table->string('special_needs')->nullable(); // any special needs
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
