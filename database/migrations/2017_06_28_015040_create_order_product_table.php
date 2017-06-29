<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderProductTable extends Migration {

	public function up()
	{
		Schema::create('order_product', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned()->nullable();
			$table->integer('order_id')->unsigned();
			$table->integer('quantity')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('order_product');
	}
}