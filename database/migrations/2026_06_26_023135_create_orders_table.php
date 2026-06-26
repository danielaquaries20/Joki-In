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
            $table->string('client');
            $table->string('game');
            $table->string('service_name');
            $table->integer('price');
            $table->string('status')->default('Menunggu Dikerjakan'); // Menunggu Dikerjakan, Sedang Dikerjakan, Selesai
            $table->string('session_status')->default('unlocked'); // unlocked, locked
            $table->string('stream_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
