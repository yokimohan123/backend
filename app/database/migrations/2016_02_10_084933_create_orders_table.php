<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('reference_no',25)->unique();;
			$table->integer('user_id');
			$table->string('payment_type');
			$table->string('invoice_no',25);
			$table->string('invoice_date');
			$table->float('discount_price');
			$table->float('tax_price_total');
			$table->float('shipping_price_total');
			$table->float('order_price_total');
			$table->string('order_date');
			$table->string('shipping_date');
			$table->string('delivery_date');
			$table->integer('order_status');
			$table->integer('address');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
