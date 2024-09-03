<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = ['Electronics', 'Books', 'Clothing', 'Home', 'Sports'];

        foreach (range(1, 50) as $index) {
            Product::create([
                'name' => $faker->unique()->words(2, true),
                'category' => $faker->randomElement($categories),
                'price' => $faker->randomFloat(2, 10, 500), // Price between $10 and $500
                'created_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
