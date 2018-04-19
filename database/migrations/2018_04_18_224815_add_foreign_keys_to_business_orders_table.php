<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBusinessOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('business_orders', function(Blueprint $table)
		{
			$table->foreign('business_id', 'business_orders_to_business')->references('id')->on('business')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('business_orders', function(Blueprint $table)
		{
			$table->dropForeign('business_orders_to_business');
		});
	}

}
