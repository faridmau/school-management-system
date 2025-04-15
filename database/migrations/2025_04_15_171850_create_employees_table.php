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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // foreign key to schools table
            $table->string('name');
            $table->string('email')->unique();
            $table->string('status')->default('active'); // e.g., active, inactive
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('position')->nullable(); // e.g., teacher, administrator
            $table->string('employee_code')->unique()->nullable(); // unique identifier for the employee
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('medical_conditions')->nullable(); // any medical conditions
            $table->string('allergies')->nullable(); // any allergies
            $table->string('special_needs')->nullable(); // any special needs
            $table->decimal('salary')->nullable(); // salary of the employee
            $table->string('bank_account_number')->nullable(); // bank account number for salary deposits
            $table->string('bank_name')->nullable(); // bank name
            $table->string('bank_branch')->nullable(); // bank branch
            $table->string('tax_id')->nullable(); // tax identification number
            $table->date('hire_date')->nullable(); // date of hire
            $table->string('notes')->nullable(); // any additional notes
            $table->json('social_media_links')->nullable(); // social media links
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete(); // user who created the record
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete(); // user who created the record
            $table->softDeletes(); // for soft delete functionality
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
