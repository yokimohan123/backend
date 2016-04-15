<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesignersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('designers', function(Blueprint $table)
		{
                    $table->increments('id');
                    $table->string('title');
                    $table->string('alt');
                    $table->string('image');
                    $table->string('description');
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
		Schema::drop('designers');
	}

}
