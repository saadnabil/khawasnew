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
        
 Schema::create('contactus', function (Blueprint $table) {
            $table->id();
           $table->string('phone')->nullable();
           $table->string('email')->nullable();
           $table->string('CompanyName')->nullable();
           $table->string('address')->nullable();
           $table->string('street')->nullable();
           $table->string('zip')->nullable();
           $table->string('UrlLink')->nullable();
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('contactus');
        //
    }
};
