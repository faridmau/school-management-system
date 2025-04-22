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
            $table->string('status')->default('active'); // e.g., active, inactive
            $table->string('phone_number')->nullable();
            $table->string('position')->nullable(); // e.g., teacher, administrator
            $table->string('employee_code')->unique()->nullable(); // unique identifier for the employee
            $table->decimal('salary')->nullable(); // salary of the employee
            $table->string('bank_account_number')->nullable(); // bank account number for salary deposits
            $table->string('bank_name')->nullable(); // bank name
            $table->string('bank_branch')->nullable(); // bank branch
            $table->string('tax_id')->nullable(); // tax identification number
            $table->date('hire_date')->nullable(); // date of hire
            $table->string('notes')->nullable(); // any additional notes
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
