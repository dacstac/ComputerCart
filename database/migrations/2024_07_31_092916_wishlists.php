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
        // migration for wishlists table
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('products_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whislists');
    }
};
