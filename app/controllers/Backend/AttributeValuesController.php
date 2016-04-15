<?php

namespace Backend;

use AdminAuthController;
use View;
use Input;
use Redirect;
use Attribute;
use AttributeValues;
use Validator;
use DB;
use Session;
use Image;
use Ftp;
use File;
use ProductAttribute;

class AttributeValuesController extends AdminAuthController {

    public $layout = 'layouts.backend';
    
    public function index() {
		$attribute_values = AttributeValues::select(DB::raw('count(*) as attribute_value_count, attributes.id, attributes.name'))->join('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')->groupBy('attributes.id')->paginate(10);
		$this->layout->content = View::make('backend.attribute_values.index',compact('attribute_values'));
    }
    
    public function create(){
        $attribute_values = AttributeValues::all();
		$attribute_names = Attribute::select('attributes.*', 'attribute_groups.group_name')->leftjoin('attribute_groups', 'attribute_groups.id', '=', 'attributes.attribute_group')->get();
		$this->layout->content = View::make('backend.attribute_values.create',compact('attribute_names', 'attribute_values'));
    }
    
    public function store()
    {
        $attribute_values = Input::all();
        
        
		$attribute_price_values = Input::get('price');
		$image = Input::file('image');
		
		$attribute_id = Input::get('attribute_id');
		if($attribute_id <= 0) {
			return Redirect::back();
		}
		$attributes_data = Attribute::where('id', '=', $attribute_id)->get(array('price_mode'))->toArray();
		$attr_price = $attributes_data[0]; 
		foreach($attribute_values as $k => $v) {
			$insert_data = new AttributeValues;
			
			$insert_data->attribute_id = $attribute_id;
			$data_validation['attribute_id'] = $insert_data->attribute_id;
			$insert_data->value = $v;
			$data_validation['value'] = $insert_data->value;
			$validator = Validator::make($data_validation, AttributeValues::$rules);
			if ($validator->fails()) {
				$messages = $validator->messages();
            	return Redirect::back()->withErrors($validator)->withInput();
			} else{
				//check the price flag
				
				//upload image in  directory
				// $attribute_value_image = $image[$k];
				if(isset($attribute_value_image) && $attribute_value_image != '') {
					$filename = time(). '_' .$attribute_value_image->getClientOriginalName();
					if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR .
					 $insert_data->attribute_id)) {
						mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR .
							$insert_data->attribute_id, 0777, true);
					}
					if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR .
						 $insert_data->attribute_id)) {
						mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR .
						 $insert_data->attribute_id, 0777, true);
					}
					$original_image = Image::make($attribute_value_image->getRealPath())->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $insert_data->attribute_id. DIRECTORY_SEPARATOR . $filename);

					$resized_small_image = Image::make($attribute_value_image->getRealPath())->resize(120, 44)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR . $insert_data->attribute_id . DIRECTORY_SEPARATOR . $filename);

					$fileFrom = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR .
					$insert_data->attribute_id . DIRECTORY_SEPARATOR . $filename;

					$insert_data->image = $filename;
				}

				if($attr_price['price_mode'] == 'Common') {
					$insert_data->price = $attribute_price_values[$k];
				}
				$insert_data->save();
			}
		}
		
		if(Input::get('stay') == 1){
			return Redirect::back();
		} else {
			return Redirect::route('backend.attribute_values.index');
		}
    }
    
    public function edit($id){
        $attribute_values = AttributeValues::select('attributes.id as attribute_type_id', 'attributes.name', 'attributes.price_mode', 'attributes.price_value', 'attribute_values.id as attribute_value_id', 'attribute_values.value', 'attribute_values.image', 'attribute_values.price','attribute_values.color')->leftjoin('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')->where('attributes.id', '=', $id);
		$attribute_values = $attribute_values->get();
		$this->layout->content = View::make('backend.attribute_values.update',compact('attribute_values'));
    }
    
    public function update(){
		$request_data = Input::all();
		// print_r($request_data);
		// exit;
		for($i=1; $i<=$request_data['row_count']; $i++) {
			$value = $request_data['value_'.$i];
			$color = $request_data['color_'.$i];
			$id = $request_data['attribute_value_'.$i];
			// unset($data);
			$attribute_values = AttributeValues::findOrFail($id);
			$data['id'] = $id;
			$data['value'] = $value;
			$data['color'] = $color;
			//$validator = Validator::make($data, AttributeValues::$edit_rules);
			$price_validation = Input::get('price_validation');
			$price_mode = $request_data['price_mode'];
			if($price_mode == 'Common') {
					$price = $request_data['price_'.$i];
					$data['price'] = $price; 
			}
			if($price_validation == 'true') {
				$validator = Validator::make($data, AttributeValues::$pricerules);
			} else {
				$validator = Validator::make($data, AttributeValues::$edit_rules);
			}
			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator)->withInput();
			} else {
				$attribute_value_image = Input::file('image_'.$i);
				if(isset($attribute_value_image) && $attribute_value_image != '') {
					//upload image in  directory
					
					$filename = time(). '_' .$attribute_value_image->getClientOriginalName();
					if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR .
						$request_data['attribute_id'])) {
						mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR .
							$request_data['attribute_id'], 0777, true);
					}
					if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR .'small' . DIRECTORY_SEPARATOR .
						$request_data['attribute_id'])) {
						mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR .
							$request_data['attribute_id'], 0777, true);
					}
					$resized_small_image = Image::make($attribute_value_image->getRealPath())->resize(120, 44)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR .
						$request_data['attribute_id']. DIRECTORY_SEPARATOR . $filename);

					$original_image = Image::make($attribute_value_image->getRealPath())->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $request_data['attribute_id']. DIRECTORY_SEPARATOR . $filename);

					$fileFrom = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR .
					$request_data['attribute_id'] . DIRECTORY_SEPARATOR . $filename;
					
					
					$data['image'] = $filename;
					$data['color'] = $color;
					
					//delete old file
					$previous_image = Input::get('attribute_value_image_exist_'.$i);
					
					File::delete(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR .
						$request_data['attribute_id'] . DIRECTORY_SEPARATOR . $previous_image);
					File::delete(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attribute_values' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR .
						$request_data['attribute_id'] . DIRECTORY_SEPARATOR . $previous_image);
				}
				
				
				$attribute_values->update($data);
			}
			
		}
		
		if(Input::get('stay') == 1){
            return Redirect::back();
        }else {
			Session::flash('update_result', 'Attribute values has been updated.');
            return Redirect::route('backend.attribute_values.index');
        }
        
		
    }
    
    public function destroy($id){
        AttributeValues::destroy($id);
	    return Redirect::route('backend.attribute_values.index');
    }

}
