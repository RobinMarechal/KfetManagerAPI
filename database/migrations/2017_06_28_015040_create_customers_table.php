<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('firstname', 255);
			$table->string('lastname', 255);
			$table->integer('staff_id')->unsigned()->nullable();
			$table->float('balance')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('customers');
	}
}