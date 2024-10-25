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
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->id();
            $table->string('country_id');
            $table->double('amount',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. php artisan migrate --path=/database/migrations/2024_05_16_005559_create_customer_addressess_table.php

     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_charges');
    }
};
