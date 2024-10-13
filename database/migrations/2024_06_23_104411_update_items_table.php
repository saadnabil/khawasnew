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
        //
        Schema::table('items', function (Blueprint $table) {
            $table->integer('min')->default(0)->nullable()->after('quantity');
            $table->integer('max')->default(0)->nullable()->after('min');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['min', 'max']);
        });
        //
    }
};
