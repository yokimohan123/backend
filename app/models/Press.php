<?php

class Press extends \Eloquent {
    
    protected $fillable = ['title','alt','image'];
    
    protected $table = 'press';
        
    public static $rules = array(
        'title' => 'required',
        'image' => 'required'
    );
    
}