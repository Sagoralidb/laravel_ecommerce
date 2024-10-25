<?php
// Project 2
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products2', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->text('shipping_returns')->nullable();
            $table->text('related_products')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('compare_price', 8, 2);
            $table->string('sku');
            $table->string('barcode')->nullable();
            $table->enum('track_qty', ['Yes', 'No'])->default('No');
            $table->integer('qty')->default(0);
            $table->enum('status', ['1', '0'])->default('1');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->enum('is_featured', ['Yes', 'No'])->default('No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products2');
    }
}
