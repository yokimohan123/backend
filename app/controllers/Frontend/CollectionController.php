<?php

namespace Frontend;

use FrontOfficeController;
use View;
use Collection;
use CollectionImages;

class CollectionController extends FrontOfficeController {

    protected $layout = 'layouts.collection';
    
    public function collection() {
        
        $collections = Collection::with('collection_images')->get()->toArray(); 
        return View::make('frontend.collection',compact('collections'));
    }
    
}