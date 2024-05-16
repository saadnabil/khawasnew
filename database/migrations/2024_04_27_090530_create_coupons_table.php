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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Unique coupon code
            $table->string('description')->nullable(); // Description of the coupon (optional)
            $table->unsignedDecimal('discount')->default(0)->nullable(); // Discount amount (e.g., 10.00 for $10 discount)
            $table->unsignedInteger('quantity'); // Total quantity of this coupon available
            $table->unsignedInteger('used_quantity')->default(0); // Total quantity of this coupon used
            $table->dateTime('valid_from')->nullable(); // Start date of validity (optional)
            $table->dateTime('valid_to')->nullable(); // End date of validity (optional)
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
