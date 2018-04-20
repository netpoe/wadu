<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkStatusIdAndPaymentTypeIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('status_id', 'orders_to_order_status')->references('id')->on('order_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('payment_type_id', 'orders_to_order_payment_type')->references('id')->on('order_payment_type')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_to_order_status');
            $table->dropForeign('orders_to_order_payment_type');
        });
    }
}
