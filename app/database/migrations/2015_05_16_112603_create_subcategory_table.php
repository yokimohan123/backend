<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subcategory', function(Blueprint $table)
		{
                    $table->increments('id');
                    $table->string('choose_cate');
                    $table->string('choose_subcate');
                    $table->string('prices');
                    $table->string('quantities');
                    $table->string('image');
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
		//
	}

}
