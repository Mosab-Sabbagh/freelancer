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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('job_type', ['full_time','part_time'])->default('full_time');
            $table->decimal('salary_amount', 10, 2)->nullable();
            $table->date('deadline')->nullable();
            $table->enum('status', ['open','closed'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
