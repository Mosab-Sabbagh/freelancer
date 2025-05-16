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
        Schema::table('work_samples', function (Blueprint $table) {
            $table->string('technologies')->nullable();   // التقنيات المستخدمة
            $table->string('preview_link')->nullable();   // رابط المعاينة
            $table->string('duration')->nullable();       // المدة الزمنية (مثلاً: "3 شهور")
            $table->string('category')->nullable();       // الفئة (مثلاً: "ويب", "موبايل")            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_samples', function (Blueprint $table) {
            //
        });
    }
};
