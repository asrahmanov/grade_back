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
        Schema::create('user_grade_items_scopes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grade_item_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('score_id');
            $table->foreign('grade_item_id')->references('id')->on('grade_items');
            $table->foreign('user_id')->on('users')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_grade_items_scopes');
    }
};
