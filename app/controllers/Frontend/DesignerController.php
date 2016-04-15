<?php

namespace Frontend;

use FrontOfficeController;
use View;
use Design;


class DesignerController extends FrontOfficeController {

    protected $layout = 'layouts.designer';
    
    public function designer() {
        $designers = Design::all();
        return View::make('frontend.designer',compact('designers'));
    }
    
}