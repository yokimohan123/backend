<?php

class Attribute extends \Eloquent {

    protected $fillable = ['name', 'description', 'attribute_type', 'attribute_group', 'price_mode', 'price_value', 'has_price'];
    public static $pricerule = array(
		'attribute_group' => 'required|Integer|Min:1',
		'name' => 'required',
		'attribute_type' => 'required',
		'price_mode' => 'required',
		'price_value' => 'required',
		'has_price' => 'required'
    );
	public static $simplerule = array(
		'attribute_group' => 'required|Integer|Min:1',
		'name' => 'required',
		'has_price' => 'required'
	);
	
	public function attribute_values(){
        return $this->hasMany('AttributeValues');
    }
	public function attribute_group(){
        return $this->belongsTo('AttributeGroup');
    }
}
