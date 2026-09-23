<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->unsignedInteger('bonus_points')->default(0)->after('remaining_lives');
            $table->boolean('is_daily_bonus')->default(false)->after('bonus_points');
        });
    }

    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropColumn(['bonus_points', 'is_daily_bonus']);
        });
    }
};
