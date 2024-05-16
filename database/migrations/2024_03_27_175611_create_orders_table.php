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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->double('total_price')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_type')->nullable()->default('cash');
            $table->foreignId('address_id')
                    ->nullable()
                    ->constrained('addresses')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->date('shipped_date')->nullable();
            $table->string('payment_status')->default('not_paid');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
