<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->string('id', 20)->default('')->primary();
			$table->integer('business_id')->unsigned()->index('orders_to_business');
			$table->integer('user_id')->unsigned()->index('orders_to_users');
			$table->integer('product_id')->unsigned()->nullable();
			$table->integer('status_id')->unsigned()->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
