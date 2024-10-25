<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// use Database\Factories\Str;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product2>
 */
class Product2Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title  = fake()->unique()->name();
        $slug   =  Str::slug($title);

        $description  = fake()->name();
        
        // $subCategories  = [17,18];
        $subCategories  = [19,20,21,22];
        $subCatRandKey  =   array_rand($subCategories);

        $brands  = [1,2,3,4,5,6,7,8,9,10,];
        $brandRandKey  =   array_rand($brands);
        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            // 'category_id'   =>  7,
            'category_id'   =>  14,
            'sub_category_id'  =>  $subCategories[$subCatRandKey],
            'brand_id'      =>  $brands[$brandRandKey],
            'price'         => rand(10,1000) ,
            'compare_price' => rand(12,1500) ,
            'sku'           => rand(1000,100000),
            'track_qty'     => 'Yes',
            'qty'           => 10,
            'is_featured'   =>'Yes',
            'status'        => 1,
        ];  
    }
}
