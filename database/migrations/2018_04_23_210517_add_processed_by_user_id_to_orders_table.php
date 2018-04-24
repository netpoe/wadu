<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProcessedByUserIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('processed_by_user_id')->unsigned()->nullable()->after('user_id');
            $table->integer('shipped_by_user_id')->unsigned()->nullable()->index('orders_to_business_users_who_deliver');
            $table->foreign('processed_by_user_id', 'orders_to_business_users')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('shipped_by_user_id', 'orders_to_business_users_who_deliver')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
            $table->dropColumn('processed_by_user_id');
            $table->dropColumn('shipped_by_user_id');
            $table->dropForeign('orders_to_business_users');
            $table->dropForeign('orders_to_business_users_who_deliver');
        });
    }
}
