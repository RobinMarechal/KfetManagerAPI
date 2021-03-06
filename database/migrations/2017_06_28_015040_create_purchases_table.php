<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesTable extends Migration {

	public function up()
	{
		Schema::create('purchases', function(Blueprint $table) {
			$table->increments('id');
			$table->float('cost')->default('0');
			$table->integer('quantity')->default('1');
			$table->date('date')->nullable();
			$table->text('description')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('purchases');
	}
}