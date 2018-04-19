<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_address', function(Blueprint $table)
		{
			$table->foreign('country_id', 'user_address_to_address_countries')->references('id')->on('address_countries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('state_id', 'user_address_to_address_states')->references('id')->on('address_states')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'user_address_to_users')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_address', function(Blueprint $table)
		{
			$table->dropForeign('user_address_to_address_countries');
			$table->dropForeign('user_address_to_address_states');
			$table->dropForeign('user_address_to_users');
		});
	}

}
