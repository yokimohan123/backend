<?php

class ProductAttributePrice extends \Eloquent {
	public static $rules = [
		 'product_id' => 'required',
		 'attribute_value_id' => 'required',
		 'price' => 'required|regex:/^\d*(\.\d{2})?$/'
	];
        
	protected $fillable = ['product_id','attribute_value_id','price'];
        
    public function product(){
		return $this->belongsTo('Product');
    }
}