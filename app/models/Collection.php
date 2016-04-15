<?php

class Collection extends \Eloquent {
    
    protected $fillable = ['title','alt','image','color'];
    
    protected $table = 'collections';
        
    public static $rules = array(
        'title' => 'required',
        'image' => 'required',
        'alt' => 'required'
    );


    public static function edit($id){
        return array_merge([			
			'title' => 'required',			
			'alt' => 'required'	
			]);		
	}
	public static function edit_image($id){
        return array_merge([
			'image' => 'required',			
			'alt' => 'required',
			'title' => 'required'		
		]);
	}
	public function collection_images(){
        return $this->hasMany('CollectionImages','collections_id');
    }
    
}