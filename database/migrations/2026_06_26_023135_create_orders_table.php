<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade');
            $table->string('client');
            $table->string('game');
            $table->string('service_name');
            $table->integer('price');
            $table->string('status')->default('Menunggu Dikerjakan');
            $table->string('session_status')->default('unlocked');
            $table->string('stream_url')->nullable();

            $table->string('game_id')->nullable();
            $table->string('game_password')->nullable();
            $table->string('game_server')->nullable();
            $table->string('payment_receipt')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
