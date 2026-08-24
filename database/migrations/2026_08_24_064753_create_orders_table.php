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
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('recipient_name', 64);
            $table->string('recipient_phone', 25);
            $table->string('pickup_method', 32);
            $table->text('shipping_address')->nullable();
            $table->date('delivery_date');
            $table->text('order_notes')->nullable();
            $table->string('reference_photo', 255)->nullable();
            $table->text('greeting_card')->nullable();
            $table->decimal('subtotal', 10,2);
            $table->decimal('shipping_cost', 10,2);
            $table->decimal('total_price', 10,2);
            $table->string('status', 32);
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
