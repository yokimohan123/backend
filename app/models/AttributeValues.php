<?php

class AttributeValues extends \Eloquent {

    protected $table = 'attribute_values';

    protected $fillable = ['attribute_id','value', 'image', 'price','color'];
    public static $rules = array(
        'attribute_id' => 'required',
        'value' => 'required',
        
    );
    public static $pricerules = array(
        'value' => 'required',
        'price' => 'required|regex:/^\d*(\.\d{2})?$/'
    );
    public static $edit_rules = array(
        'value' => 'required'
    );

    public function attribute(){
        return $this->belongsTo('Attribute');
    }
}
