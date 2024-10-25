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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products2')->onDelete('cascade'); // Foreign key constraint
            $table->string('name');
            $table->integer('qty');
            $table->double('price',10,2);
            $table->double('total',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
