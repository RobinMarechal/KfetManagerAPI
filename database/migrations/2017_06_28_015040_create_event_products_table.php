<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventProductsTable extends Migration {

	public function up()
	{
		Schema::create('event_products', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned()->nullable();
			$table->integer('event_id')->unsigned()->nullable();
			$table->float('cost')->default('0');
			$table->float('price')->nullable();
			$table->integer('quantity_sold')->default('0');
			$table->integer('quantity_bought')->default('0');
			$table->string('name', 255)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('event_products');
	}
}