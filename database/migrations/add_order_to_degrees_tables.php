<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('degrees', static function (Blueprint $table): void {
            $table->integer('sort_order')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('degrees', function (Blueprint $table): void {
            $table->dropColumn('sort_order');
        });
    }
};
