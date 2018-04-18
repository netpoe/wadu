<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->foreign('business_id', 'products_to_business')->references('id')->on('business')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('product_category_id', 'products_to_product_category')->references('id')->on('product_category')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropForeign('products_to_business');
			$table->dropForeign('products_to_product_category');
		});
	}

}
