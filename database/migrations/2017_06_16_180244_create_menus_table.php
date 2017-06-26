<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration {

	public function up()
	{
		Schema::create('menus', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->text('description');
			$table->decimal('price')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('menus');
	}
}