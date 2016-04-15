<?php

class CouponCode extends \Eloquent {
    
    protected $fillable = ['name','code','highlight','partial_use','priority','status','valid_from','valid_to','free_shipping','discount','free_gift'];
    
    protected $table = 'coupon_code';
        
    public static $rules = array(
        'name' => 'required',
        'code' => 'required'
    );
    public static function edit($id){
        return array_merge([			
			// 'name' => 'required',
   //      	'code' => 'required'
			]);		
	}

    public function users() {
        return $this->belongsTo('User');
    }
    
}