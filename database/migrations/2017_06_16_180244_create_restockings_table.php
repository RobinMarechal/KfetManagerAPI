<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestockingsTable extends Migration {

	public function up()
	{
		Schema::create('restockings', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date');
			$table->decimal('cost')->default('0');
			$table->text('description');
		});
	}

	public function down()
	{
		Schema::drop('restockings');
	}
}