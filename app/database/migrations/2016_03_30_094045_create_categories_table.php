<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categories', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            Schema::create('categories', function(Blueprint $t)
            {
                $t->increments('id');
                $t->integer('parent_id')->unsigned()->nullable();
                $t->integer('position', false, true);
                $t->integer('real_depth', false, true);
                $t->string('name');
                $t->string('slug');
                $t->string('description');
                $t->integer('enabled');
                $t->softDeletes();

                $t->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            });
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categories', function(Blueprint $table)
        {
            Schema::dropIfExists('categories');
        });
	}

}
