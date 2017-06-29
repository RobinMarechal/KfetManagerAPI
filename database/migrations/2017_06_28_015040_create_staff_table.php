<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaffTable extends Migration {

	public function up()
	{
		Schema::create('staff', function(Blueprint $table) {
			$table->increments('id');
			$table->string('firstname', 255);
			$table->string('lastname', 255);
			$table->string('email', 255)->unique();
			$table->string('role', 255);
		});
	}

	public function down()
	{
		Schema::drop('staff');
	}
}