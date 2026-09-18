<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->unsignedInteger('correct_answers')->default(0)->after('score');
            $table->unsignedTinyInteger('remaining_lives')->default(0)->after('correct_answers');
        });
    }

    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropColumn(['correct_answers', 'remaining_lives']);
        });
    }
};