<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productName   = 'Product'.rand(1, 100);
        return [
            'name'      =>  'product'.rand(1,100),
            'slug'      =>  Str::slug($productName) .str::random(2),
            'quantity'  =>  rand(10,80),
            'price'     =>  $this->faker->numberBetween(10,500),
        ];
    }
}
