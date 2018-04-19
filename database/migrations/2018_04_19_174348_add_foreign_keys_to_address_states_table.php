<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAddressStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('address_states', function(Blueprint $table)
		{
			$table->foreign('country_id', 'address_states_to_address_countries')->references('id')->on('address_countries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('address_states', function(Blueprint $table)
		{
			$table->dropForeign('address_states_to_address_countries');
		});
	}

}
