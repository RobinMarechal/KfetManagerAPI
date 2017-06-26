<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesTable extends Migration {

	public function up()
	{
		Schema::create('purchases', function(Blueprint $table) {
			$table->increments('id');
			$table->decimal('cost')->default('0');
			$table->integer('quantity')->default('1');
			$table->date('date');
			$table->text('description');
		});
	}

	public function down()
	{
		Schema::drop('purchases');
	}
}