<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ItemSeeder;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Stylelist;
use Database\Seeders\CustomerSeeder;

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
            CustomerSeeder::class,
            ItemSeeder::class
        ]);

        Customer::factory(1000)->create();
        Stylelist::factory()->count(10)->create();


        $items = \App\Models\Item::all();
    }
}
