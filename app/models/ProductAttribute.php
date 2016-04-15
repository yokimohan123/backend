<?php

class ProductAttribute extends \Eloquent {
	protected $table = 'product_attributes';

	public static $rules = [
		// 'title' => 'required'
	];
        
	protected $fillable = ['product_id','attribute_value_id'];
        
        public function product(){
            return $this->belongsTo('Product');
        }
}