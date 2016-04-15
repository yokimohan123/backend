<?php

class Design extends \Eloquent {
    protected $fillable = ['image','description'];
    
    protected $table = 'designers';
    
 
    
    public static $aboutdesigner = array (
//        'image' => 'required',
        'content' => 'required'
    );



   
   
}