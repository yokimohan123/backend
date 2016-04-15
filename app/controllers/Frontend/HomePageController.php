<?php

namespace Frontend;

use FrontOfficeController;
use View;
use HomepageSlider;
use Category;
use Product;

class HomePageController extends FrontOfficeController {

    protected $layout = 'layouts.homepage';

    public function breadcrum() {
        $category = Category::getRoots();
		$subcategories = Category::all();
		$products = Product::all();	
        return View::make('frontend.shop.shop', compact('category','subcategories', 'products'));
    }
    
        
}