<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255)->unique();
			$table->text('description');
			$table->decimal('price')->default('0');
			$table->integer('quantity')->default('0');
			$table->integer('subcategory_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}