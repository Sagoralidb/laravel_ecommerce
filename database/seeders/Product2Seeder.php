<?php

namespace Database\Seeders;

use App\Models\Product2;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class Product2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     \App\Models\Product2::factory(30)->create();
    // }
    public function run()
    {
    for ($i = 1; $i <= 30; $i++) {
        Product2::create([
            'title' => "Product $i",
            'slug' => Str::slug("Product $i"),
            'description' => "This is the description for Product $i",
            'short_description' => "This is the short description for Product $i",
            'shipping_returns' => "Shipping and returns information for Product $i",
            'related_products' => null,
            'price' => rand(100, 500),
            'compare_price' => rand(500, 1000),
            'sku' => "SKU$i",
            'barcode' => null,
            'track_qty' => 'No',
            'qty' => rand(0, 100),
            'status' => '1',
            'category_id' => 1, // Assuming category with ID 1 exists
            'sub_category_id' => null,
            'brand_id' => 1, // Assuming brand with ID 1 exists
            'is_featured' => 'No',
        ]);
    }
}
}