<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $orders = Order::all();
        $products = Product::pluck('id')->all();

        foreach ($orders as $order) {
            $itemsCount = rand(1, 5); // Each order has between 1 and 5 items
            $totalPrice = 0;

            foreach (range(1, $itemsCount) as $index) {
                $product = Product::find($faker->randomElement($products));
                $quantity = rand(1, 5);
                $subtotalPrice = $product->price * $quantity;
                $totalPrice += $subtotalPrice;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'subtotal_price' => $subtotalPrice,
                    'created_at' => $faker->dateTimeBetween('-2 months', 'now'),
                    'updated_at' => now(),
                ]);
            }

            // Update the total price of the order
            $order->update(['total_price' => $totalPrice]);
        }
    }
}
