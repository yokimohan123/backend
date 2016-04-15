<?php

class PaymentInfo extends \Eloquent {
    
    protected $fillable = ['year'];
    
    protected $table = 'payment_info';
        
    public static $rules = array(       
        'year' => 'required'
    );
    
}