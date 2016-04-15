<?php

namespace Frontend;

use FrontOfficeController;
use View;
use Category;
use Product;
use ProductImage;
use ProductAttribute;
use Request;
use Response;
use Input;
use Session;

class ShopController extends FrontOfficeController {

    protected $layout = 'layouts.shop';
    
    public function shop() {
        $category = Category::getRoots();
		$subcategories = Category::all();
        $product_new = Product::with('product_images')->paginate(10);
		$products = Product::with('product_images')->paginate(10);

        $product = Product::with('product_images')->get();
        foreach ($product as $key => $value) {
            $product_attributes[] = ProductAttribute::leftjoin('attribute_values', 'product_attributes.attribute_value_id', '=', 'attribute_values.id')->leftjoin('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')->where('product_attributes.product_id', '=',$value->id)->orderBy('attributes.order_by')->get(array('product_attributes.product_id as product_attribute_product_id','product_attributes.id as product_attribute_value_id', 'attribute_values.value as attribute_value_name','attribute_values.color as attribute_value_color', 'attribute_values.image as attribute_value_image', 'attributes.name as attribute_name', 'attributes.attribute_type', 'attributes.attribute_image', 'product_attributes.attribute_value_id', 'attribute_values.attribute_id', 'attributes.attribute_group', 'attributes.attribute_type'))->toArray();
        }
        
        

        $page = Input::get('page');
        if (!(isset($page)))
            $page = 1;     

        //Search a product using Name and Description
           $search_term = Input::get('search_term');                                                   
            if ($search_term != "") {

                $product_search = Product::with('product_images')->where('name', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('description', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('short_description', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('reference', 'like', '%' . Input::get('search_term') . '%')
                                    ->get()->toArray(); 
                $products = $product_search;

                Session::push('search.keywords', $search_term);
            }
        //End Search

        if (Request::ajax()) {
            return Response::json('success');
        }
        View::share('search_slug', $search_term);
        return View::make('frontend.shop.shop', compact('category','subcategories', 'products','page','product_new','product_attributes'));
    }

    public function products($slug) {    	
    	$categories = Category::getRoots();
		$subcategories = Category::all();
        $category = Category::where('slug', '=', $slug)->first();
        $products = Product::with('product_images')->where('parent_category_id', '=', $category->id)
        ->orWhere('category_id', '=', $category->id)->get();  
        $product_new = Product::with('product_images')->paginate(10);

        $product = Product::with('product_images')->get();
        foreach ($product as $key => $value) {
            $product_attributes[] = ProductAttribute::leftjoin('attribute_values', 'product_attributes.attribute_value_id', '=', 'attribute_values.id')->leftjoin('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')->where('product_attributes.product_id', '=',$value->id)->orderBy('attributes.order_by')->get(array('product_attributes.product_id as product_attribute_product_id','product_attributes.id as product_attribute_value_id', 'attribute_values.value as attribute_value_name','attribute_values.color as attribute_value_color', 'attribute_values.image as attribute_value_image', 'attributes.name as attribute_name', 'attributes.attribute_type', 'attributes.attribute_image', 'product_attributes.attribute_value_id', 'attribute_values.attribute_id', 'attributes.attribute_group', 'attributes.attribute_type'))->toArray();
        }

        //Search a product using Name,description
        $search_term = Input::get('search_term');
                                              
        if ($search_term != "") {
            $product_search = Product::with('product_images')->where('name', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('description', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('short_description', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('reference', 'like', '%' . Input::get('search_term') . '%')
                                    ->get()->toArray(); 

                $products = $product_search;
                Session::push('search.keywords', $search_term);
        }
        $category_slug = $category->slug;
        View::share('search_slug', $category_slug);

        //End search
        return View::make('frontend.shop.products', compact('products', 'category', 'slug', 'categories', 'subcategories','product_new','product_attributes'));
    }

    public function product_details($id){
    	$product = Product::with('product_images')->where('products.id', $id)->first()->toArray();
        $product_ids = Product::with('product_images')->where('products.id', $id)->first();
        $products_images = Product::with('product_images')->where('products.id', $id)->get();

        if (!(is_null($product))) {   
            $product_id = $product_ids->id;         
            $product_attributes = ProductAttribute::leftjoin('attribute_values', 'product_attributes.attribute_value_id', '=', 'attribute_values.id')->leftjoin('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')->where('product_attributes.product_id', '=', $product_id)->orderBy('attributes.order_by')->get(array('product_attributes.id as product_attribute_value_id', 'attribute_values.value as attribute_value_name','attribute_values.color as attribute_value_color', 'attribute_values.image as attribute_value_image', 'attributes.name as attribute_name', 'attributes.attribute_type', 'attributes.attribute_image', 'product_attributes.attribute_value_id', 'attribute_values.attribute_id', 'attributes.attribute_group', 'attributes.attribute_type'))->toArray();
            return View::make('frontend.shop.product_details', compact('product','products_images','product_attributes'));            
        } else {
            return Redirect::route('');
        }        
    }



    public function sales(){
        $category = Category::getRoots();
        $subcategories = Category::all();
        $products = Product::with('product_images')->where('offer_price_yes','=',1)->get();        
        $page = Input::get('page');
        if (!(isset($page)))
            $page = 1;     

        //Search a product using Name and Description
           $search_term = Input::get('search_term');                                                   
            if ($search_term != "") {

                $product_search = Product::with('product_images')->where('name', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('description', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('short_description', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('reference', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('offer_price_yes','=',1)
                                    ->get()->toArray(); 
                $products = $product_search;

                Session::push('search.keywords', $search_term);
            }
        //End Search

        if (Request::ajax()) {
            return Response::json('success');
        }
        View::share('search_slug', $search_term);
        return View::make('frontend.shop.sales', compact('category','subcategories', 'products','page','product_new'));

    }

    public function salesProducts($slug) {       
        $categories = Category::getRoots();
        $subcategories = Category::all();
        $category = Category::where('slug', '=', $slug)->first();
        $products = Product::with('product_images')->where('parent_category_id', '=', $category->id)
        ->orWhere('category_id', '=', $category->id)
        ->orWhere('offer_price_yes','=',1)->get();  
        $product_new = Product::with('product_images')->paginate(10);

        //Search a product using Name,description
        $search_term = Input::get('search_term');
                                              
        if ($search_term != "") {
            $product_search = Product::with('product_images')->where('name', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('description', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('short_description', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('reference', 'like', '%' . Input::get('search_term') . '%')
                                    ->orWhere('offer_price_yes','=',1)
                                    ->get()->toArray(); 

                $products = $product_search;
                Session::push('search.keywords', $search_term);
        }
        $category_slug = $category->slug;
        View::share('search_slug', $category_slug);

        //End search
        return View::make('frontend.shop.sales_products', compact('products', 'category', 'slug', 'categories', 'subcategories','product_new'));
    }
    public function sales_product_details($id){
        $product = Product::with('product_images')->where('products.id', $id)->where('offer_price_yes','=',1)->first()->toArray();
        $product_ids = Product::with('product_images')->where('products.id', $id)->where('offer_price_yes','=',1)->first();
        $products_images = Product::with('product_images')->where('products.id', $id)->where('offer_price_yes','=',1)->get();

        if (!(is_null($product))) {   
            $product_id = $product_ids->id;         
            $product_attributes = ProductAttribute::leftjoin('attribute_values', 'product_attributes.attribute_value_id', '=', 'attribute_values.id')->leftjoin('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')->where('product_attributes.product_id', '=', $product_id)->orderBy('attributes.order_by')->get(array('product_attributes.id as product_attribute_value_id', 'attribute_values.value as attribute_value_name', 'attribute_values.image as attribute_value_image', 'attributes.name as attribute_name', 'attributes.attribute_type', 'attributes.attribute_image', 'product_attributes.attribute_value_id', 'attribute_values.attribute_id', 'attributes.attribute_group', 'attributes.attribute_type'))->toArray();
            return View::make('frontend.shop.sales_product_details', compact('product','products_images','product_attributes'));            
        } else {
            return Redirect::route('');
        }        
    }
    
}