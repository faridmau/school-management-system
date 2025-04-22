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
        Schema::create('parent_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // foreign key to users table
            $table->string('name');
            $table->string('email')->unique();
            $table->string('status')->default('active'); // e.g., active, inactive
            $table->string('phone_number')->nullable();
            $table->string('relationship')->nullable(); // e.g., mother, father, guardian
            $table->string('occupation')->nullable(); // occupation of the parent
            $table->date('date_of_birth')->nullable(); // date of birth
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
        Schema::dropIfExists('parent_profiles');
    }
};
