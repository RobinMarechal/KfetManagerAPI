<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('event_products', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('event_products', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('subcategory_id')->references('id')->on('subcategories')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('event_accessories', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('customers', function(Blueprint $table) {
			$table->foreign('staff_id')->references('id')->on('staff')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('customer_id')->references('id')->on('customers')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('menu_id')->references('id')->on('menus')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('subcategories', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('product_restocking', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('product_restocking', function(Blueprint $table) {
			$table->foreign('restocking_id')->references('id')->on('restockings')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('category_menu', function(Blueprint $table) {
			$table->foreign('menu_id')->references('id')->on('menus')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('category_menu', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('event_products', function(Blueprint $table) {
			$table->dropForeign('event_products_product_id_foreign');
		});
		Schema::table('event_products', function(Blueprint $table) {
			$table->dropForeign('event_products_event_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_subcategory_id_foreign');
		});
		Schema::table('event_accessories', function(Blueprint $table) {
			$table->dropForeign('event_accessories_event_id_foreign');
		});
		Schema::table('customers', function(Blueprint $table) {
			$table->dropForeign('customers_staff_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_customer_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_menu_id_foreign');
		});
		Schema::table('subcategories', function(Blueprint $table) {
			$table->dropForeign('subcategories_category_id_foreign');
		});
		Schema::table('product_restocking', function(Blueprint $table) {
			$table->dropForeign('product_restocking_product_id_foreign');
		});
		Schema::table('product_restocking', function(Blueprint $table) {
			$table->dropForeign('product_restocking_restocking_id_foreign');
		});
		Schema::table('category_menu', function(Blueprint $table) {
			$table->dropForeign('category_menu_menu_id_foreign');
		});
		Schema::table('category_menu', function(Blueprint $table) {
			$table->dropForeign('category_menu_category_id_foreign');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->dropForeign('order_product_product_id_foreign');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->dropForeign('order_product_order_id_foreign');
		});
	}
}