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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('phone', 14);
            // $table->string('phone_code')->nullable();
            // $table->boolean('phone_confirmed')->default(false);

            $table->string('otp')->nullable();

            $table->string('password');
            $table->string('address')->nullable();
            $table->string('image')->nullable();

            $table->boolean('is_active')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};