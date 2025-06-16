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
        Schema::create('project_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_seeker_id')->constrained('job_seekers')->onDelete('cascade');
            $table->text('delivery_notes')->nullable();
            $table->string('delivery_file')->nullable(); // ملف التسليم إن وجد
            $table->timestamp('delivered_at')->nullable(); // وقت تسليم السيكر
            $table->timestamp('confirmed_at')->nullable(); // وقت تأكيد البوستر
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_deliveries');
    }
};
