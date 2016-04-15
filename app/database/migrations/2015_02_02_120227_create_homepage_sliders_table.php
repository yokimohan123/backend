<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomepageSlidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	Schema::create('homepage_sliders', function(Blueprint $table)
		{
                    $table->increments('id');
                    $table->string('title');
                    $table->string('alt');
                    $table->string('image');
                    $table->boolean('enabled');
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
		Schema::drop('homepage_sliders');
	}

}
