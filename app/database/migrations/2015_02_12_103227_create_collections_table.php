<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('collections', function(Blueprint $table)
		{
                    $table->increments('id');
                    $table->string('title');
                    $table->string('alt');
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
            Schema::drop('collections');
	}

}
