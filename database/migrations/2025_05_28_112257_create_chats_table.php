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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('seeker_id');
            $table->unsignedBigInteger('poster_id');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('seeker_id')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->foreign('poster_id')->references('id')->on('job_posters')->onDelete('cascade');

            $table->unique(['project_id', 'seeker_id', 'poster_id']); // لمنع تكرار نفس المحادثة
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
