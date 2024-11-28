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
        Schema::create('user_regular_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_group_id');
            $table->unsignedBigInteger('job_item_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('job_item_id')->on('job_items')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_regular_jobs');
    }
};
