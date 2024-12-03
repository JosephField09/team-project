<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'order_number' => 'OR 254685',
            'purchase_date' => '2024-11-13',
            'status' => 'Order Placed',
            'total' => 40.00,
            'returnable' => false,
        ]);

        Order::create([
            'order_number' => 'OR 254686',
            'purchase_date' => '2024-11-11',
            'status' => 'Dispatched',
            'total' => 21.50,
            'returnable' => false,
        ]);

        // Add more orders as necessary...
    }
}

