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
        if (Schema::hasColumn('user_regular_jobs', 'job_group_id'))
        {
            Schema::table('user_regular_jobs', function(Blueprint $table)
            {
                $table->unsignedBigInteger('job_group_id')->nullable()->default(0)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
