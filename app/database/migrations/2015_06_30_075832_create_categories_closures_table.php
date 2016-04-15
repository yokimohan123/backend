<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesClosuresTable extends Migration {

    public function up()
    {
        Schema::table('categories_closure', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            Schema::create('categories_closure', function(Blueprint $t)
            {
                $t->increments('ctid');

                // $t->integer('ancestor', false, true);
                // $t->integer('descendant', false, true);
                $t->integer('depth', false, true);

                // $t->foreign('ancestor')->references('id')->on('categories');
                // $t->foreign('descendant')->references('id')->on('categories');
            });
        });
    }

    public function down()
    {
        Schema::table('categories_closure', function(Blueprint $table)
        {
            Schema::dropIfExists('categories_closure');
        });
    }
}
