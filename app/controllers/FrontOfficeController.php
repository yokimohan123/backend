<?php

class FrontOfficeController extends BaseController {

	public function __construct() {	
		$category = Category::getRoots();
		$footer = Block::where('slug', 'LIKE', '%footer%')->get()->toArray();
		// print_r($category);
		// exit;
		$subcategories = Category::all();
		$cart_items = Cart::content()->toArray();
        return View::share(array('menucategory'=>$category,'menusubcategories'=>$subcategories,'footer'=>$footer,'cart_items'=>$cart_items));

	}    

}