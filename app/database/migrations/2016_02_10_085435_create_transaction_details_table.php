<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('order_id',25)->unique();
			$table->string('transaction_id',50)->unique();
			$table->double('amount',25);
			$table->string('currency',25);
			$table->string('date',25);
			$table->string('payment_status',50);
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
		Schema::drop('transaction_details');
	}

}
