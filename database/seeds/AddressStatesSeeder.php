<?php

use Illuminate\Database\Seeder;

use App\Model\Address\AddressStateAdapter as AddressState;

class AddressStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new AddressState;

        foreach (AddressState::DATA as $value) {
            DB::table($model->getTable())->insert($value);
        }
    }
}
