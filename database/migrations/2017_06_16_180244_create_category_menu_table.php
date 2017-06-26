<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryMenuTable extends Migration {

	public function up()
	{
		Schema::create('category_menu', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('menu_id')->unsigned()->nullable();
			$table->integer('category_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('category_menu');
	}
}