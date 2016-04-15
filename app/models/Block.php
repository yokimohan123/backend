<?php

class Block extends \Eloquent {
    protected $fillable = ['slug', 'title', 'content', 'image', 'keyword','alt','meta_title','meta_description','meta_keyword'];
    
    protected $table = 'blocks';
    
    public static $rules = array(
	   
        'title' => 'required',
        'content' => 'required',
       
        
    );

    public static $iconrules = array(
	'footer_facebook' => 'required',
        // 'footer_pinterest' => 'required',
        // 'footer_instagram' => 'required',
        'footer_twitter' => 'required',
        'footer_linkedin' => 'required'
      
    );
    
    public static $generalrules = array (
          'general_admin_email' => 'required|email'
    );
    
    public static $imagerules = array(
        'project_main_image' => 'required',
        'project_image_1' => 'required',
        'project_image_2' => 'required',
        'project_image_3' => 'required',
        'project_image_4' => 'required',
        'project_image_5' => 'required',
        'project_image_6' => 'required'
      
    );
    
    public static $alterrules = array (
          'aboutalter' => 'required',
          'meta_title' => 'required',
          'meta_description' => 'required',
          'meta_keyword' => 'required',
          'alt' => 'required',
          'image' => 'required'

         
    );

    public static $designrules = array (
          'cmsdesign' => 'required',
          'meta_title' => 'required',
          'meta_description' => 'required',
          'meta_keyword' => 'required',
          'alt' => 'required',
          'image' => 'required'
    );


    public static $furniturerules = array (
          'cmsfurniture' => 'required',
          'meta_title' => 'required',
          'meta_description' => 'required',
          'meta_keyword' => 'required',
          'alt' => 'required',
          'image' => 'required'
    );
    
    public static $reupholsteryrules = array (
          'cmsreupholstery' => 'required',
          'meta_title' => 'required',
          'meta_description' => 'required',
          'meta_keyword' => 'required',
          'alt' => 'required',
          'image' => 'required'
    );
    public static $seo_feedback = array (         
          'meta_title' => 'required',
          'meta_description' => 'required',
          'meta_keyword' => 'required',
          'alt' => 'required'
    );
    public static $bespokecontactrules = array (         
          'meta_title' => 'required',
          'meta_description' => 'required',
          'meta_keyword' => 'required',
          'alt' => 'required'
    );
   
}