<?php

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
        $this->call(AddressCountriesSeeder::class);
        $this->call(AddressStatesSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(OrderPaymentTypeSeeder::class);
    }
}
