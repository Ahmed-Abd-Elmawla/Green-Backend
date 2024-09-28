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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('email_confirmation_token')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('phone_confirmation_token')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->default('admin');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_banned')->default(false);
            $table->boolean('require_login')->default(false);
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
        Schema::dropIfExists('admins');
    }
};
