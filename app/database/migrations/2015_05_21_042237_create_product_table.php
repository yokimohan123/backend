<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
                    $table->increments('id');
                    $table->integer('main_id')->unsigned();
                    $table->string('title');
                    $table->string('description');
                    $table->string('prices');
                    $table->string('quantities');
                    $table->string('image');
                    $table->timestamps();

                    $table->foreign('main_id')
				  ->references('id')
				  ->on('maincategory');
				  
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product');
	}

}
