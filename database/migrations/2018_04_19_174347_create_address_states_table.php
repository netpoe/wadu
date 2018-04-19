<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('address_states', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->integer('country_id')->unsigned()->index('address_states_to_address_countries');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('address_states');
	}

}
