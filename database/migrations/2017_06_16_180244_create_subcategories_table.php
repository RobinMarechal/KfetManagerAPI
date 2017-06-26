<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubcategoriesTable extends Migration {

	public function up()
	{
		Schema::create('subcategories', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->unsigned()->nullable();
			$table->string('name', 255)->unique();
			$table->decimal('price')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('subcategories');
	}
}