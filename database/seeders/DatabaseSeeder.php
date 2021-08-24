<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //User::factory(10)->create();
        Role::factory(3)->create();
        Profile::factory(10)->create();
        Product::factory(5)->create();
        Order::factory(10)->create()->each(function($order){
            $ids = range(1, 5);
            shuffle($ids);//trộn
            $sliced = array_slice($ids, 1, 3);
            $order->products()->attach($sliced);
        });
    }
}
