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
        Schema::table('job_seekers', function (Blueprint $table) {
            $table->boolean('is_available')->default(true);
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->enum('experience_level', ['beginner', 'intermediate', 'expert'])->default('beginner');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_seekers', function (Blueprint $table) {
            //
        });
    }
};
