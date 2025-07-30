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
            $table->string('name');
            $table->string('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('contact');
            $table->string('parent_contact');
            $table->enum('role', ['high_school', 'college'])->default('high_school');
            $table->string('address')->nullable();
            $table->string('password'); // Password field
            $table->string('email')->unique();
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
