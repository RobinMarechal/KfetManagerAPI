<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderProductTable extends Migration {

	public function up()
	{
		Schema::create('order_product', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned()->nullable();
			$table->integer('order_id')->unsigned()->nullable();
			$table->integer('menu_id')->unsigned()->nullable();
			$table->integer('quantity')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('order_product');
	}
}