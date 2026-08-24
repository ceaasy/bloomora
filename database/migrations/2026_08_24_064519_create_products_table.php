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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('category', 32);
            $table->text('description')->nullable();
            $table->string('photo', 255)->nullable();
            $table->integer('stock');
            $table->decimal('price_small', 10,2);
            $table->decimal('price_medium', 10,2);
            $table->decimal('price_large', 10,2);
            $table->json('customization_options')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
