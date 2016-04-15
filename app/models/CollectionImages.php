<?php

class CollectionImages extends \Eloquent { 

    public static $rules = [
            'link' => 'required|url',
            'title' =>'required'
    ];
    protected $fillable = ['collections_id', 'image','link'];

    protected $table = 'collection_images';

    public function collection() {
        return $this->belongsTo('Collection');
    }

}
