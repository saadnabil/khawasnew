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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
            ->nullable()
            ->constrained('items')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('order_id')
            ->nullable()
            ->constrained('orders')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->integer('quantity')->nullable();
            $table->double('total_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
