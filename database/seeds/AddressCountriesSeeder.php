<?php

use Illuminate\Database\Seeder;

use App\Model\Address\AddressCountryAdapter as AddressCountry;

class AddressCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new AddressCountry;

        foreach (AddressCountry::DATA as $value) {
            DB::table($model->getTable())->insert($value);
        }
    }
}
