<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCategories = [
            // Dell Subcategories
            ['name' => 'Laptops', 'slug' => 'dell-laptops', 'status' => 1, 'showHome' => 'Yes', 'category_id' => Category::where('name', 'Dell')->first()->id],
            ['name' => 'Desktops', 'slug' => 'dell-desktops', 'status' => 1, 'showHome' => 'No', 'category_id' => Category::where('name', 'Dell')->first()->id],
            
            // Samsung Subcategories
            ['name' => 'Smartphones', 'slug' => 'samsung-smartphones', 'status' => 1, 'showHome' => 'Yes', 'category_id' => Category::where('name', 'Samsung')->first()->id],
            ['name' => 'Tablets', 'slug' => 'samsung-tablets', 'status' => 1, 'showHome' => 'No', 'category_id' => Category::where('name', 'Samsung')->first()->id],
            
            // Nokia Subcategories
            ['name' => 'Feature Phones', 'slug' => 'nokia-feature-phones', 'status' => 1, 'showHome' => 'Yes', 'category_id' => Category::where('name', 'Nokia')->first()->id],
            ['name' => 'Smartphones', 'slug' => 'nokia-smartphones', 'status' => 1, 'showHome' => 'No', 'category_id' => Category::where('name', 'Nokia')->first()->id],
            
            // Electronics Subcategories
            ['name' => 'Televisions', 'slug' => 'electronics-televisions', 'status' => 1, 'showHome' => 'Yes', 'category_id' => Category::where('name', 'Electronics')->first()->id],
            ['name' => 'Cameras', 'slug' => 'electronics-cameras', 'status' => 1, 'showHome' => 'No', 'category_id' => Category::where('name', 'Electronics')->first()->id],
            
            // Men's Fashion Subcategories
            ['name' => 'Clothing', 'slug' => 'mens-fashion-clothing', 'status' => 1, 'showHome' => 'Yes', 'category_id' => Category::where('name', 'Men\'s Fashion')->first()->id],
            ['name' => 'Shoes', 'slug' => 'mens-fashion-shoes', 'status' => 1, 'showHome' => 'No', 'category_id' => Category::where('name', 'Men\'s Fashion')->first()->id],
        ];

        foreach ($subCategories as $subCategory) {
            SubCategory::create($subCategory);
        }
    }
}
