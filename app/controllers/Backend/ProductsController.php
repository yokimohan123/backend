<?php
namespace Backend;

use AdminAuthController;
use View;
use Slides;
use Redirect;
use Image;
use Input;
use Validator;
use File;
use Product;
use Category;
use ProductImage;
use Response;
use Attribute;
use ProductAttribute;
use Session;
use ProductAttributePrice;
use Ftp;

class ProductsController extends AdminAuthController {

	public function __construct() {
        parent::__construct();
    }

	protected $layout = 'layouts.backend';
 
    public function index(){

    	$categories = Category::getRoots();

        return View::make('backend.products.index', compact('categories'));
	}

	public function productlist($category_id) {
        
        $products = Product::where('parent_category_id', '=', $category_id)->get();
        $category = Category::where('id', '=', $category_id)->first();

        return View::make('backend.products.list', compact('category','products', 'category_id'));
    }
    
    public function getCreate($category_id) {
        $product = new Product;
        $tree = Category::getTree(array('id', 'name'))->toArray();
        $selection_flag = 'false';
        foreach ($tree as $key => $val) {
            if ($category_id == $val['id']) {
                $newtree[] = $tree[$key];
                $selection_flag = 'true';
            }
        }
        if ($selection_flag == 'false') {
            $newtree = $tree;
        }
        return View::make('backend.products.create')->with(array('product' => $product, 'tree' => $newtree, 'category' => $category_id));
    }

    /**
     * Store a newly created backendproduct in storage.
     *
     * @return Response
     */
    public function postCreate() {
        $product = new Product;
        $product->name = Input::get('name');
        $url = $product->slug = strtolower(Input::get('slug')) . "-" . strtolower(Input::get('reference'));
        $product->reference = Input::get('reference');
        $product->offer_price = Input::get('offer_price');
        $product->offer_price_yes = Input::get('offer_price_yes');
        $product->original_price = Input::get('original_price');
        $product->quantity = Input::get('quantity');
        $product->short_description = Input::get('short_description');
        $product->description = Input::get('description');
        $product->parent_category_id = Input::get('parent_category_id');
        $product->category_id = Input::get('category_id');
        $product->child_category_id = Input::get('child_category_id');

        if (Input::get('enabled') == 1) {
            $product->enabled = 1;
        } else {
            $product->enabled = 0;
        }

        if (Input::get('new_tag') == 1) {
            $product->new_tag = 1;
        } else {
            $product->new_tag = 0;
        }

        if (Input::get('sale_tag') == 1) {
            $product->sale_tag = 1;
        } else {
            $product->sale_tag = 0;
        }


        if (Input::get('out_of_stock') == 1) {
            $product->out_of_stock = 1;
        } else {
            $product->out_of_stock = 0;
        }
        
        if (Input::get('installation_charges') == 1) {
            $product->installation_charges = 1;
        } else {
            $product->installation_charges = 0;
        }

        if (Input::get('offer_price_yes') == 1) {
            $product->offer_price_yes = 1;
        } else {
            $product->offer_price_yes = 0;
        }

        $child_count = Category::where('parent_id', '=', $product->category_id)->get()->toArray();     
        
        if(count( $child_count) > 0) {
            
            $validator = Validator::make($data = Input::all(), Product::$category_rules, array($product->slug = Product::replaceSlug($url)));
        } else {
            $validator = Validator::make($data = Input::all(), Product::$rules, array($product->slug = Product::replaceSlug($url)));
        }
        
        if ($validator->fails()) {
                                                                        
                return Redirect::back()->withErrors($validator)->withInput();                
        }             
        
                        
        $product->save();

        // Product::create($data);
        if (Input::get('stay') == 1) {
                return Redirect::back()->withErrors($validator)->withInput();
        } else {
            return Redirect::route('backend.productlist.list', array('category_id' => Input::get('parent_category_id')));
        }
    }


    public function edit($id) {                
        $line = Product::where('id', '=', $id)->first()->toArray();       
        //return parent::__construct();
        $product = Product::with('product_images')->with('product_attributes')->with('product_attribute_prices')->where('products.id', $id)->first();
        $attribute_master = Attribute::with('attribute_values')->get()->toArray();
        $product_price_attributes = ProductAttribute::leftjoin('attribute_values', 'product_attributes.attribute_value_id', '=', 'attribute_values.id')->leftjoin('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')->where('product_id', '=', $id)->where('price_mode', '!=', '')->get(array('product_attributes.attribute_value_id as attribute_value_id', 'attribute_values.value as attribute_value', 'attributes.name as attribute_name', 'price_mode', 'price_value'))->toArray();
        
        $tree = Category::getTree(array('id', 'name'))->toArray();        
        return View::make('backend.products.create', compact('product', 'tree', 'attribute_master', 'product_price_attributes', 'line','true','false'));
    }

   

    public function update($id) {
        $product = Product::findOrFail($id);

        $product->name = Input::get('name');
        $url = $product->slug = strtolower(Input::get('slug'));
        
        $product->reference = Input::get('reference');
        $product->offer_price = Input::get('offer_price');
        $product->original_price = Input::get('original_price');
        $product->quantity = Input::get('quantity');
        $product->short_description = Input::get('short_description');
        $product->description = Input::get('description');
        $can_update = Input::get('can_update_category');
        if ($can_update) {
            $product->parent_category_id = Input::get('parent_category_id');
            $product->category_id = Input::get('category_id');
            $product->child_category_id = Input::get('child_category_id');
            
            if($product->category_id == ''){
                 return Redirect::back()->withMessage('Kindly Please Select the Category');
            } else {
                // to check whether category_id has any child
                $child_count = Category::where('parent_id', '=', $product->category_id)->get()->toArray();                              
                if(count( $child_count) > 0 && $product->child_category_id == '') {
                     return Redirect::back()->withMessage('Kindly Please Select the Child Category');
                }
            }
        }
        if (Input::get('enabled') == 1) {
            $product->enabled = 1;
        } else {
            $product->enabled = 0;
        }

        if (Input::get('new_tag') == 1) {
            $product->new_tag = 1;
        } else {
            $product->new_tag = 0;
        }

        if (Input::get('sale_tag') == 1) {
            $product->sale_tag = 1;
        } else {
            $product->sale_tag = 0;
        }


        if (Input::get('out_of_stock') == 1) {
            $product->out_of_stock = 1;
        } else {
            $product->out_of_stock = 0;
        }
        
        if (Input::get('installation_charges') == 1) {
            $product->installation_charges = 1;
        } else {
            $product->installation_charges = 0;
        }

        if (Input::get('offer_price_yes') == 1) {
            $product->offer_price_yes = 1;
        } else {
            $product->offer_price_yes = 0;
        }
        

        $validator = Validator::make($data = Input::all(), Product::updaterules($id), array($product->slug = Product::replaceSlug($url)));
      

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
       
        $product->save($data);
      
        if (Input::get('stay') == 1) {
            Session::flash('message', "Product has been updated successfully!");
            return Redirect::back()->withErrors($validator)->withInput();
        } else {            
            return Redirect::route('backend.productlist.list', array('category_id' => $product->parent_category_id))->withMessage('Product has been updated successfully!');
        }
    }

    public function seoUpdate($id) {        
        $product = Product::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Product::$seorules);        
        if ($validator->fails()) {
            return Redirect::back()->with('tab', 'tab_seo')->withErrors($validator)->withInput();
        }
        $product->meta_title = Input::get('meta_title');
        $product->meta_description = Input::get('meta_description');
        $product->meta_keyword = Input::get('meta_keyword');
        
        if ($product->save()) {
            if (Input::get('stay') == 1) {
                return Redirect::back()->with('tab', 'tab_seo');
            } else {
                return Redirect::route('backend.productlist.list', array('category_id' => $product->parent_category_id))->withMessage('Product has been updated successfully!');
                //return Redirect::route('backend.products.index');
            }
        } else {
            return Redirect::back()->with(array('tab' => 'tab_seo', 'error' => 'Something wen\'t wrong'));
        }
    }

    public function uploadImages($id) {
        $product = Product::findOrFail($id);
        
        
        $image = Input::file('file');

        //TODO:: Lowercase and remove special chars the file name
        //TODO:: Restrict everything else than image
        $filename = time() . '_' . $image->getClientOriginalName();

        if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $product->id)) {
            mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $product->id, 0777, true);
        }
        if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'large' . DIRECTORY_SEPARATOR . $product->id)) {
            mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'large' . DIRECTORY_SEPARATOR . $product->id, 0777, true);
        }
        if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR . $product->id)) {
            mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR . $product->id, 0777, true);
        }
        if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR . $product->id)) {
            mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR . $product->id, 0777, true);
        }
        if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . $product->id)) {
            mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . $product->id, 0777, true);
        }
        try {
            $original_image = Image::make($image->getRealPath())->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $product->id . DIRECTORY_SEPARATOR . $filename);
        } catch (Exception $ex) {
            $upload_original_error = $ex;
        }
        if ($original_image) {
            
            $resized_large_image = Image::make($image->getRealPath())->resize(498, 498)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'large' . DIRECTORY_SEPARATOR . $product->id . DIRECTORY_SEPARATOR . $filename);
            $resized_medium_image = Image::make($image->getRealPath())->resize(200, 258)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR . $product->id . DIRECTORY_SEPARATOR . $filename);
            $resized_small_image = Image::make($image->getRealPath())->resize(160, 110)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR . $product->id . DIRECTORY_SEPARATOR . $filename);

            $resized_temp_image = Image::make($image->getRealPath())->resize(660, 960)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . $product->id . DIRECTORY_SEPARATOR . $filename);

            $product_image = new ProductImage(str_replace(" "."&@><*#?,/--:\\!", "_",(array('image_path' => $filename))));
            
            
            $product->product_images()->save($product_image);
            
            
            
            if ($product_image) {
                return Response::json('success', 200);
            }
            /* Ftp image upload ends */
        } else {
            return Response::json('error ' . $upload_original_error, 400);
        }
    }

    public function updateImageInfo($product_id, $image_id) {
        $image = ProductImage::findOrFail($image_id);
        $ftproot = '~/dimaayad/';

        if (Input::get('delete') == 1) {
            File::delete(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'large' . DIRECTORY_SEPARATOR . $product_id . DIRECTORY_SEPARATOR . $image->image_path);
            File::delete(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR . $product_id . DIRECTORY_SEPARATOR . $image->image_path);
            File::delete(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR . $product_id . DIRECTORY_SEPARATOR . $image->image_path);
            File::delete(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $product_id . DIRECTORY_SEPARATOR . $image->image_path);
            File::delete(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . $product_id . DIRECTORY_SEPARATOR . $image->image_path);
            $image->delete();
            return Redirect::back()->with('tab', 'tab_images')->with('success', 'Awesome! you have changed the image title/alt.');
        } else {
            $validator = Validator::make($data = Input::all(), ProductImage::$rules);

            if ($validator->fails()) {
                return Redirect::back()->with('tab', 'tab_images')->withErrors($validator)->withInput();
            }
            $image->title = Input::get('title');
            $image->alt = Input::get('alt');
            if ($image->save()) {
                return Redirect::back()->with('tab', 'tab_images')->with('success', 'Awesome! you have changed the image title/alt.');
            }
            return Redirect::back()->with('tab', 'tab_images')->with('error', 'Sad! Some error occured');
        }
    }

    

    public function updateAttachment($product_id, $image_id) {
        
        $file = ProductAttachment::findOrFail($image_id);
        


        if (Input::get('delete') == 1) {
            if (File::delete(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . $product_id . DIRECTORY_SEPARATOR . $file->file_path)) {
                
                
                

                

                
                
                
            }
            $file->delete();
            return Redirect::back()->with('tab', 'tab_attachments')->with('success', 'Awesome! you have changed the image title/alt.');
        } else {
            $validator = Validator::make($data = Input::all(), ProductImage::$rules);

            if ($validator->fails()) {
                return Redirect::back()->with('tab', 'tab_attachments')->withErrors($validator)->withInput();
            }
            $file->name = Input::get('name');
            $file->title = Input::get('title');
            if ($file->save()) {
                return Redirect::back()->with('tab', 'tab_attachments')->with('success', 'Awesome! you have changed the image title/alt.');
            }
            return Redirect::back()->with('tab', 'tab_attachments')->with('error', 'Sad! Some error occured');
        }
    }
    public function ImagePositionUpdate(){
        $imgorder = Input::get('listOrder');
        $i =0;
        foreach ($imgorder as $id) {
            $i = $i+1;
            $productimage = ProductImage::find($id);
            $productimage->position_id = $i;
            $productimage->save();
        }
        return Response::json('success', 200);  
    }

    public function PdfPositionUpdate(){
        $pdforder = Input::get('listPdf');               
        $i =0;
        foreach ($pdforder as $id) {            
            $i = $i+1;
            $productpdf = ProductAttachment::find($id);
            $productpdf->position_id = $i;
            $productpdf->save();
        }
        return Response::json('success', 200);  
    }

    

    
        
   

    /**
     * Remove the specified backendproduct from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $product_info = Product::findOrFail($id);
        $category_id = $product_info['parent_category_id'];
        Product::destroy($id);
        $directory_original = public_path() . "/uploads/products/original/" . $id;
        $directory_small = public_path() . "/uploads/products/small/" . $id;
        $directory_medium = public_path() . "/uploads/products/medium/" . $id;
        $directory_large = public_path() . "/uploads/products/large/" . $id;
        File::deleteDirectory($directory_original);
        File::deleteDirectory($directory_small);
        File::deleteDirectory($directory_medium);
        File::deleteDirectory($directory_large);
        $page = Input::get('page');
        if (!(isset($page)))
            $page = 1;
        return Redirect::route('backend.productlist.list', array('page' => $page, 'category_id' => $category_id));
    }

    /*
      Import products from CSV file
     */

    public function CSVimport($category_id) {
        $product = new Product;
        $category_name = Category::find($category_id);
        return View::make('backend.products.csvimport')->with(array('product' => $product, 'category_id' => $category_id, 'category_name' => $category_name));
    }

    public function CSVimportData() {

        $data = Input::all();
        $file = Input::file('csv_import');
        $file_name = $file->getClientOriginalName();
        //get file extension
        $file_extn = explode('.', $file_name);
        $lp = count($file_extn) - 1;
        $fe = strtolower($file_extn[$lp]);
        //custom validation for csv extension
        if ($fe == 'csv') {
            $validation_rules = ProductImport::$importrules;
        } else {
            $validation_rules = array(
                'csv_import' => 'required|max:10000|mimes:csv'
            );
        }
        //validation
        $validator = Validator::make($data, $validation_rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            //upload the file in csv folder
            $new_file_name = gmdate('YmdHis', time()) . '_' . $file_name;
            $csv_upload_directory = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR;
            $success = $file->move($csv_upload_directory, $new_file_name);

            $product_import = new ProductImport;
            //save it in database
            $product_import->file_name = $new_file_name;
            $product_import->created_at = date('Y-m-d H:i:s', time());

            //read data from uploaded file
            $file_to_read = $csv_upload_directory . $new_file_name;
            //$import_response = $product_import->loadData($file_to_read);

            $header = NULL;
            $csvdata = array();
            
            
                
                    
                        
                            
                       
                            
                    
                    
                
            
            
            
            $csv = new parseCSV();
            $csv->auto($file_to_read);
            //END NEW - file read
            $row_count = $row_added = $row_invalid = 0;
            if (count($csv->data) >= 1) {
            //if (count($csvdata) >= 1) {

                //insert data 
                foreach ($csv->data as $key => $row) {
                //foreach ($csvdata as $key => $row) {
                    if (is_array($row)) {
                        $product = new Product;
                        $row_validation = 'true';
                        //begin validation
                        //$parent_category_id = is_numeric($row['parent_category_id']);
                        $parent_category_id = $data['category_id'];
                        if ($parent_category_id == false) {
                            $row_validation = 'false';
                            $error_message[] = 'Invalid parent category id for row number ' . $row['row_number'];
                        }
                        $category_id = $row['category_id'];
                       
                          
                          
                          
                          
                          
                          
                         

                        $child_category_id = $row['child_category_id'];
                                              
                          
                          
                          
                          
                          
                          
                         

                        if (is_numeric($row['quantity'])) {
                            $quantity = $row['quantity'];
                        } else {
                            $row_validation = 'false';
                            $error_message[] = 'Invalid quantity for row number ' . $row['row_number'];
                        }

                        $price = $row['original_price'];
                        if (filter_var($price, FILTER_VALIDATE_FLOAT) == false) {
                            $row_validation = 'false';
                            $error_message[] = 'Invalid price for row number ' . $row['row_number'];
                        }

                        if (is_numeric($row['out_of_stock'])) {
                            $out_of_stock = $row['out_of_stock'];
                        } else {
                            $row_validation = 'false';
                            $error_message[] = 'Invalid stock value for row number ' . $row['row_number'];
                        }

                        if (is_numeric($row['enabled'])) {
                            $enabled = $row['enabled'];
                        } else {
                            $row_validation = 'false';
                            $error_message[] = 'Invalid status value for row number ' . $row['row_number'];
                        }
                        $slug = strtolower(str_replace(array("\\",":","--","/"," ","?","#","*","<",">","@","&","$","(",")","!","~","'","’","#","%","^","[","]","{","}","'",'!',')','(','+','=','{','}','|','"\"',';',"'",'/','`','%','[',']',","), '-',$row['slug']));
                        if ($this->validateSlug($slug) == 'false') {
                            $row_validation = 'false';
                            $error_message[] = 'Invalid slug value for row number ' . $row['row_number'];
                        }
                        //end validation
                        if ($row_validation == 'true') {
                            $product->parent_category_id = $parent_category_id;
                            $product->category_id = $category_id;
                            $product->child_category_id = $child_category_id;
                            $product->reference = $row['reference'];
                            $product->name = $row['name'];
                            //$product->slug = strtolower($row['slug']).'-'.strtolower($row['reference']);
                            $product->slug = $slug;
                            $product->short_description = $row['short_description'];
                            $product->description = $row['description'];
                            $product->meta_title = $row['meta_title'];
                            $product->meta_description = $row['meta_description'];
                            $product->meta_keyword = $row['meta_keyword'];
                            $product->quantity = (int) $quantity;
                            $product->original_price = $price;
                            $product->out_of_stock = $row['out_of_stock'];
                            $product->enabled = $row['enabled'];
                            $product->save();
                            $product_id = $product->id;
                            $row_added++;
                            //insert product attributes
                            if (isset($row['attribute_count']) && $row['attribute_count'] > 0) {
                                for ($pa = 1; $pa <= $row['attribute_count']; $pa++) {
                                    $attributte_id = $row['attribute_key_' . $pa];
                                    $attributte_value_id = $row['attribute_value_' . $pa];
                                    $pattribute_data = new ProductAttribute;
                                    $pattribute_data->product_id = $product_id;
                                    $pattribute_data->attribute_value_id = $attributte_value_id;
                                    $pattribute_data->save();
                                }
                            }
                        } else {
                            $row_invalid++;
                        }
                    }
                    $row_count++;
                }
            }
            $product_import->updated_at = date('Y-m-d H:i:s', time());
            $product_import->save();

            //message for data import
            if ($row_invalid > 0) {
                $message = implode('<br/>', $error_message);
                $message .= '<br/>' . $row_added . ' out of ' . $row_count . ' row are added to database.';
                $class_name = 'alert-danger';
            } else {
                $message = $row_added . ' row data are imported in to database.';
                $class_name = 'alert-success';
            }

            //session set for message and css
            Session::flash('import_result', $message);
            Session::flash('class_name', $class_name);
            return Redirect::back();
        }
    }

    public function validateSlug($slug) {

        $product_attributes = Product::where('slug', '=', $slug)->get()->toArray();

        if ($product_attributes) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function attributesUpdate($id) {
        //delete old records for the product_id
        ProductAttribute::where('product_id', '=', $id)->delete();
        $product = Product::findOrFail($id);

        $attribute_values = Input::get('attribute_value');
        $failed = $inserted = 0;
        if (count($attribute_values) > 0) {
            foreach ($attribute_values as $k => $v) {
                $insert_data = new ProductAttribute;
                $insert_data->product_id = $id;
                $data_validation['product_id'] = $insert_data->product_id;

                $insert_data->attribute_value_id = $v;
                $data_validation['attribute_value_id'] = $insert_data->attribute_value_id;
                $validator = Validator::make($data_validation, ProductAttribute::$rules);
                if ($validator->fails()) {
                    $failed++;
                } else {

                    $insert_data->save();
                    $inserted++;
                }
            }
        }
        //delete entries associated with Product Attribute Price table
        //$price_has = ProductAttributePrice::join('product_attributes', 'product_attribute_prices.product_id', '=', 'product_attributes.product_id')->join('product_attributes', 'product_attribute_prices.attribute_value_id', '=', 'product_attributes.attribute_value_id')->where('product_id', '=', $id)->get()->toArray();

        /* $price_has = ProductAttributePrice::join('product_attributes', function($join)
          {
          $join->on('product_attribute_prices.product_id', '=', 'product_attributes.product_id')
          ->on('product_attribute_prices.attribute_value_id', '=', 'product_attributes.attribute_value_id')
          ;
          })
          ->where('product_attribute_prices.product_id', '=', $id)
          ->get(array('product_attribute_prices.attribute_value_id'))->toArray(); */
        $price_has = ProductAttribute::where('product_id', '=', $id)->get(array('attribute_value_id'))->toArray();
        if (count($price_has) > 0) {
            $delete_no_values = ProductAttributePrice::whereNotIn('attribute_value_id', $price_has)->where('product_attribute_prices.product_id', '=', $id)->delete();
        }
        if (Input::get('stay') == 1) {
            return Redirect::back();
        } else {
            //return Redirect::route('backend.products.edit', array('id'=>$id));
            return Redirect::route('backend.productlist.list', array('category_id' => $product->parent_category_id))->withMessage('Product has been updated successfully!');
        }
    }

    public function attributesPriceUpdate($id) {
        //delete old records for the product_id
        ProductAttributePrice::where('product_id', '=', $id)->delete();

        $attribute_price_values = Input::get('attribute_price');
        $attribute_value_ids = Input::get('attribute_value_id');
        $failed = $inserted = 0;
        if (count($attribute_price_values) > 0) {
            foreach ($attribute_price_values as $k => $v) {
                $insert_data = new ProductAttributePrice;
                $insert_data->product_id = $id;
                $data_validation['product_id'] = $insert_data->product_id;
                if (isset($v) && $v != '') {
                    $insert_data->price = $v;
                    $insert_data->attribute_value_id = $attribute_value_ids[$k];
                    $data_validation['price'] = $insert_data->price;
                    $data_validation['attribute_value_id'] = $insert_data->attribute_value_id;
                    $validator = Validator::make($data_validation, ProductAttributePrice::$rules);
                    if ($validator->fails()) {
                        $failed++;
                    } else {
                        $insert_data->save();
                        $inserted++;
                    }
                }
            }
        }
        if (Input::get('stay') == 1) {
            return Redirect::back();
        } else {
            $product = Product::findOrFail($id);
            return Redirect::route('backend.productlist.list', array('category_id' => $product->parent_category_id))->withMessage('Product has been updated successfully!');
        }
    }    
    
    //search
    public function search() {
        $this->layout = View::make('layouts.ajax');
        
        $category_id = Input::get('category_id');
        $keyword = Input::get('keyword');
        
        $products_query = Product::where('parent_category_id', '=', $category_id);
        $products_query->whereRaw('(name LIKE "%' . $keyword . '%" OR slug LIKE "%' . $keyword . '%")');
        //$products = $products_query->paginate(10);
        $products = $products_query->get();
        
        $page = 1;
                
        return View::make('backend.products.search', compact('products', 'category_id', 'page'));
    }
        
}