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
        Schema::create('work_sample_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_sample_id');
            $table->string('file_path'); 
            // $table->string('file_type')->nullable(); // صورة - pdf - doc - الخ
            $table->timestamps();
        
            $table->foreign('work_sample_id')->references('id')->on('work_samples')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_sample_files');
    }
};
