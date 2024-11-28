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
        if (!Schema::hasColumn('grades', 'is_hidden'))
        {
            Schema::table('grades', function(Blueprint $table)
            {
                $table->boolean('is_hidden')->nullable()->default(0);
            });
        }
        if (!Schema::hasColumn('grade_items', 'is_hidden'))
        {
            Schema::table('grade_items', function(Blueprint $table)
            {
                $table->boolean('is_hidden')->nullable()->default(0);
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
