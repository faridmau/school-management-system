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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // unique slug for the school
            $table->text('about')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->string('timezone')->default('UTC'); // default timezone
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('type')->nullable(); // e.g., public, private, charter
            $table->string('school_code')->unique()->nullable(); // unique identifier for the school
            $table->string('status')->default('active'); // e.g., active, inactive
            $table->string('accreditation')->nullable(); // accreditation status
            $table->json('facilities')->nullable(); // facilities available at the school
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
        Schema::dropIfExists('schools');
    }
};
