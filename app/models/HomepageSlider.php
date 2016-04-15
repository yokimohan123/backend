<?php

class HomepageSlider extends \Eloquent {
    
    protected $fillable = ['title','alt','image', 'link','month','color'];
        
    public static $rules = array(
        'title' => 'required',
        'image' => 'required', 
        'month' => 'required',
        'alt'   => 'required',
        'month' => 'required',
        'link'  => 'required',
        'color' => 'required'

    );
    
    public static $editrules = array(
        'title' => 'required',
        'alt'   => 'required',
        'link'  => 'required' ,
        'color' => 'required'       
    );

    public static function edit_image($id){
        return array_merge([
            'title' => 'required',
            'image' => 'required', 
            'month' => 'required',
            'alt'   => 'required',
            'month' => 'required',
            'link'  => 'required'  ,
            'color' => 'required'    
        ]);
    }
    
    
}