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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('code')->nullable();
            // $table->string('invoice_type');

            $table->enum('payment_type',['cash','postpaid']);
            $table->float('total_amount');
            $table->float('paid')->default(0);
            $table->float('remaining')->default(0);
            // $table->string('client_name')->nullable();

            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
