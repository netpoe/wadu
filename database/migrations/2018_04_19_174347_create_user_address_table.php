<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_address', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('user_address_to_users');
			$table->integer('country_id')->nullable()->unsigned()->index('user_address_to_address_countries');
			$table->integer('state_id')->nullable()->unsigned()->index('user_address_to_address_states');
			$table->string('city')->nullable()->default('');
			$table->string('street')->default('');
			$table->string('interior_number')->nullable();
			$table->string('neighborhood')->default('');
			$table->string('zip_code')->nullable();
			$table->string('references')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_address');
	}

}
