<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(1)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'user_type' => 'admin',
            'password' => '1234',
        ]);

        $this->call([
            Product2Seeder::class,
        ]);
        
        // Schema::disableForeignKeyConstraints() ;
        // Product::truncate();
        // Schema::enableForeignKeyConstraints();
        // // Product::factory(10)->create();
        // Gallery::factory(10)->create();
    }

}
