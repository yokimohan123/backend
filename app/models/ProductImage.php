<?php

class ProductImage extends \Eloquent {

	public static $rules = [
//             'id' => 'required',
//             'position_id' => 'required'
    ];
    
    protected $fillable = ['id','product_id', 'image_path', 'title', 'alt','position_id'];

    public function product() {
        return $this->belongsTo('Product');
    }
    

}
