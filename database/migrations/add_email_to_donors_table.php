<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donors', static function (Blueprint $table): void {
            $table->string('email')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('donors', function (Blueprint $table): void {
            $table->dropColumn('email');
        });
    }
};
