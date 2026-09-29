<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
/*
        $categories = Category::createMany([
            ['name' => 'Electonics'],
            ['name' => 'House & kichen'],
            ['name' => 'Health Care'],
            ['name' => 'Toys'],
        ]);
*/
    // Category::create(['name' => 'Electonics']);
    // Category::create(['name' => 'House & kichen']);
    // Category::create(['name' => 'Health Care']);
    // Category::create(['name' => 'Toys']);

        Product::factory(20)->create();

    }
}
