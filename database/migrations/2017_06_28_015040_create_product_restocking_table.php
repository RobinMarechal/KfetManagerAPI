<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductRestockingTable extends Migration {

	public function up()
	{
		Schema::create('product_restocking', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned()->nullable();
			$table->integer('quantity')->default('1');
			$table->integer('restocking_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('product_restocking');
	}
}