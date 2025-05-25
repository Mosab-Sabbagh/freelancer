<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // "يُمنع أن يُقدم نفس الباحث (job_seeker_id) عرضًا على نفس المشروع (project_id) أكثر من مرة".
    public function up()
    {
        Schema::table('project_applications', function (Blueprint $table) {
            $table->unique(['project_id', 'job_seeker_id'], 'unique_project_seeker');
        });
    }

    public function down()
    {
        Schema::table('project_applications', function (Blueprint $table) {
            $table->dropUnique('unique_project_seeker');
        });
    }
};
