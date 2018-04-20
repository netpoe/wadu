<?php

use Illuminate\Database\Seeder;

use App\Model\Order\OrderPaymentTypeAdapter as OrderPaymentType;

class OrderPaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new OrderPaymentType;

        foreach (OrderPaymentType::DATA as $value) {
            DB::table($model->getTable())->insert($value);
        }
    }
}
