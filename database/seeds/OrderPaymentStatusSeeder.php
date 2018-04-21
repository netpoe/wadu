<?php

use Illuminate\Database\Seeder;

use App\Model\Order\OrderPaymentStatusAdapter as OrderPaymentStatus;

class OrderPaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new OrderPaymentStatus;

        foreach (OrderPaymentStatus::DATA as $value) {
            DB::table($model->getTable())->insert($value);
        }
    }
}
