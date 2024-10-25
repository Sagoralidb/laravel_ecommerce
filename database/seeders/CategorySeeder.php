<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Dell', 'slug' => 'dell', 'image' => 'dell.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Samsung', 'slug' => 'samsung', 'image' => 'samsung.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Nokia', 'slug' => 'nokia', 'image' => 'nokia.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Electronics', 'slug' => 'electronics', 'image' => 'electronics.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Men\'s Fashion', 'slug' => 'mens-fashion', 'image' => 'mens-fashion.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Women\'s Fashion', 'slug' => 'womens-fashion', 'image' => 'womens-fashion.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Baby Fashion', 'slug' => 'baby-fashion', 'image' => 'baby-fashion.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Home Appliances', 'slug' => 'home-appliances', 'image' => 'home-appliances.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Books', 'slug' => 'books', 'image' => 'books.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Sports Equipment', 'slug' => 'sports-equipment', 'image' => 'sports-equipment.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Health & Beauty', 'slug' => 'health-beauty', 'image' => 'health-beauty.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Toys & Games', 'slug' => 'toys-games', 'image' => 'toys-games.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Jewelry & Accessories', 'slug' => 'jewelry-accessories', 'image' => 'jewelry-accessories.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Automotive', 'slug' => 'automotive', 'image' => 'automotive.jpg', 'status' => 1, 'showHome' => 'Yes'],
            ['name' => 'Furniture & Decor', 'slug' => 'furniture-decor', 'image' => 'furniture-decor.jpg', 'status' => 1, 'showHome' => 'Yes'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
