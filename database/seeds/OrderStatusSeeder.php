<?php

use Illuminate\Database\Seeder;

use App\Model\Order\OrderStatusAdapter as OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new OrderStatus;

        foreach (OrderStatus::DATA as $value) {
            DB::table($model->getTable())->insert($value);
        }
    }
}
