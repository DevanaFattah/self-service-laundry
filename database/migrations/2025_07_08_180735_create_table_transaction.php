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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            // $table->foreignId('coin_id');
            // $table->string('name');
            $table->string('weight');
            $table->boolean('approval');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('total');
            $table->string('payment_method');
            $table->date('reservation_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_transaction');
    }
};
