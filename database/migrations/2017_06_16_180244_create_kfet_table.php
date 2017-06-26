<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKfetTable extends Migration {

	public function up()
	{
		Schema::create('kfet', function(Blueprint $table) {
			$table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
			$table->float('balance')->default('0');
			$table->string('reason_table', 255)->nullable();
			$table->integer('reason_id')->nullable();
            $table->enum('reason_type', array('INSERT', 'UPDATE', 'DELETE'))->nullable();
		});
	}

	public function down()
	{
		Schema::drop('kfet');
	}
}