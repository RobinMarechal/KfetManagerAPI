<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventAccessoriesTable extends Migration {

	public function up()
	{
		Schema::create('event_accessories', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('event_id')->unsigned()->nullable();
			$table->string('name', 255);
			$table->float('cost')->default('0');
			$table->integer('quantity')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('event_accessories');
	}
}