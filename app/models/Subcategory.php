<?php

class Subcategory extends \Eloquent {
    
    protected $fillable = ['cate','subcate','price','quantit','image'];
    
    protected $table = 'subcategory';
        
    public static $rules = array(
    	'cate' => 'required',
    	'subcate' => 'required',
        'price' => 'required',
        'quantit' => 'required',
        'image' => 'required'
    );
    
}