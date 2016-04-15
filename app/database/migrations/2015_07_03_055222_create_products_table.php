<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_category_id');
			$table->integer('category_id');
			$table->string('name');                    
            $table->text('description');
            $table->string('slug');
            $table->string('image');
			$table->integer('quantity');
			$table->float('price');                        
            $table->string('product_id');			
			$table->boolean('out_of_stock');
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
		Schema::drop('products');
	}

}
