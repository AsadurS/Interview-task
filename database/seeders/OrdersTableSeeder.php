<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $statuses = ['pending', 'shipped', 'delivered', 'canceled'];
        $users = User::pluck('id')->all();

        foreach (range(1, 200) as $index) {
            Order::create([
                'user_id' => $faker->randomElement($users),
                'total_price' => 0, // Will be updated later in OrderItemsTableSeeder
                'status' => $faker->randomElement($statuses),
                'created_at' => $faker->dateTimeBetween('-2 months', 'now'),
                'updated_at' => now(),
            ]);
        }
    }

}
