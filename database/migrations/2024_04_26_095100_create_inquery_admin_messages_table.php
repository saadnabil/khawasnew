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
        Schema::create('inquery_admin_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('admins')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                $table->foreignId('user_id')
                ->nullable()
                ->constrained('admins')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('subject')->nullable();
            $table->text('message')->nullanble();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquery_admin_messages');
    }
};
