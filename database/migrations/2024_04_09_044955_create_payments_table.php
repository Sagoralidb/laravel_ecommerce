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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();    // লারাভেলের নিজস্ব কনভেশন বা রীতি ফল করলে কন্সট্রেন্ট এর ভিতর টেবিল নেম উল্লেখ করার দরকার নেই।
            $table->text('transaction_id');
            $table->bigInteger('amount');
            $table->tinyText('currency');
            $table->string('product_name');
            $table->integer('quantity')->default(1);
           $table->string('status')->default('in-active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
