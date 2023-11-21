<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ItemSeeder;
use App\Models\Purchase;
use App\Models\Customer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ItemSeeder::class
        ]);

        Customer::factory(1000)->create();
        Purchase::factory(100)->create();

        $items = \App\Models\Item::all();
        Purchase::factory(100)->create()
            ->each(function (Purchase $purchase) use ($items) {
                $purchase->items()->attach(
                    $items->random(rand(1, 3))->pluck('id')->toArray(),
                    // 1～3個のitemをpurchaseにランダムに紐づけ
                    ['quantity' => rand(1, 5)]
                );
            });
    }
}
