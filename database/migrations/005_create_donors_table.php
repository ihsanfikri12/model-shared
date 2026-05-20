<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donors', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->uuid('branch_id');
            $table->uuid('employee_id');
            $table->string('identification_number');
            $table->string('name');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('donor_phone_id')->nullable();
            $table->timestamps();
        });

        Schema::create('donor_phones', function (Blueprint $table): void {
            $table->id();
            $table->uuid('donor_id');
            $table->string('number');
            $table->string('type');
            $table->string('country_code')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_valid_format')->default(false);
            $table->boolean('is_support_whatsapp')->default(false);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::table('donors', function (Blueprint $table): void {
            $table->foreign('donor_phone_id')->references('id')->on('donor_phones')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('donors', function (Blueprint $table): void {
            $table->dropForeign(['donor_phone_id']);
        });

        Schema::dropIfExists('donor_phones');
        Schema::dropIfExists('donors');
    }
};
