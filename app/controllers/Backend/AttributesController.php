<?php

namespace Backend;

use AdminAuthController;
use View;
use Input;
use Redirect;
use Paginator;
use Attribute;
use Validator;
use AttributeGroup;
use Image;
use AttributeValues;
use ProductAttribute;
use Category;
use Product;

class AttributesController extends AdminAuthController {

    public $layout = 'layouts.backend';

    public function index() {
        $attributes_query = Attribute::leftjoin('attribute_groups', 'attribute_groups.id', '=', 'attributes.attribute_group');
        $attributes = $attributes_query->get(array('attributes.id', 'attributes.name', 'attributes.price_mode', 'attributes.price_value', 'attribute_groups.group_name'))->toArray();
        $attribute_paginate = $attributes_query->paginate(10);
        $this->layout->content = View::make('backend.attributes.index', compact('attributes', 'attribute_paginate'));
    }

    public function create() {
        $attribute = new Attribute;
        $attribute_group = AttributeGroup::all()->toArray();       
        $this->layout->content = View::make('backend.attributes.create', compact('attribute', 'attribute_group'));
    }

    public function store() {
        $attribute = new Attribute;
        $attribute->name = Input::get('name');
        $attribute->description = Input::get('description');
        $attribute->attribute_type = Input::get('attribute_type');
        $attribute->attribute_group = Input::get('attribute_group');
        $attribute->price_mode = Input::get('price_mode');
        $attribute->price_value = Input::get('price_value');        
        $has_price = Input::get('has_price');
        $attribute->has_price = $has_price;
        if ($has_price == 'Yes') {
            $validator = Validator::make($data = Input::all(), Attribute::$pricerule);
        } else {
            $validator = Validator::make($data = Input::all(), Attribute::$simplerule);
        }        
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        //upload the image 
        $attribute_type_image = Input::file('attribute_type_image');
        if (isset($attribute_type_image) && $attribute_type_image != '') {
            $filename = time() . '_' . $attribute_type_image->getClientOriginalName();
            if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR)) {
                mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR, 0777, true);
            }
            if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'original'. DIRECTORY_SEPARATOR)) {
                mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR, 0777, true);
            }
            $original_image = Image::make($attribute_type_image->getRealPath())->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'original'. DIRECTORY_SEPARATOR . $filename);

            $resized_small_image = Image::make($attribute_type_image->getRealPath())->resize(120, 44)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR . $filename);

            $attribute->attribute_image = $filename;
        }

        if ($attribute->save()) {
            if (Input::get('stay') == 1) {
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                return Redirect::route('backend.attributes.index');
            }
        }
    }

    public function edit($id) {
        $attribute = Attribute::findOrfail($id);
        //dd($attribute);
        $attribute_group = AttributeGroup::all()->toArray();
        //dd($attribute_group);
        $this->layout->content = View::make('backend.attributes.create', compact('attribute', 'attribute_group'));
    }

    public function update($id) {
        $attribute = Attribute::findOrFail($id);

        $has_price = Input::get('has_price');
        if ($has_price == 'Yes') {
            $validator = Validator::make($data = Input::all(), Attribute::$pricerule);
        } else {
            $validator = Validator::make($data = Input::all(), Attribute::$simplerule);
        }


        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        //upload the image 
        $attribute_type_image = Input::file('attribute_type_image');
        if (isset($attribute_type_image) && $attribute_type_image != '') {
            //TODO:: Lowercase and remove special chars the file name
            //TODO:: Restrict everything else than image
            $filename = time() . '_' . $attribute_type_image->getClientOriginalName();
            if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR)) {
                mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR, 0777, true);
            }
            if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'original'. DIRECTORY_SEPARATOR)) {
                mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR, 0777, true);
            }
            $original_image = Image::make($attribute_type_image->getRealPath())->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'original'. DIRECTORY_SEPARATOR . $filename);

            $resized_small_image = Image::make($attribute_type_image->getRealPath())->resize(120, 44)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR . $filename);
            $attribute->attribute_image = $filename;
            //delete old file
            $previous_image = Input::get('attribute_type_image_exist');
            if(isset($previous_image) && $previous_image != '') {
                $prev_file_original_path_name = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $previous_image;
                $prev_file_small_path_name = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'attributes' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR . $previous_image;
                if (file_exists($prev_file_original_path_name) && file_exists($prev_file_small_path_name)) {
                    unlink($prev_file_original_path_name);
                    unlink($prev_file_small_path_name);
                }
            }
        }

        if ($attribute->update($data)) {
            if (Input::get('stay') == 1) {
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                return Redirect::route('backend.attributes.index');
            }
        }
    }

    public function destroy($id) {
        $attribute_values = AttributeValues::where('attribute_id', '=', $id)->get(array('id'));
        //$attribute_values = AttributeValues::all()->toArray();
        if (count($attribute_values) > 0) {
            foreach ($attribute_values as $attr_key => $attr_val) {
                $attr_val_ids[] = $attr_val['attributes'];
            }
            if (count($attr_val_ids) > 0) {
                ProductAttribute::whereIn('attribute_value_id', $attr_val_ids)->delete();
            }
        }
        AttributeValues::where('attribute_id', '=', $id)->delete();
        Attribute::destroy($id);
        return Redirect::route('backend.attributes.index');
    }

}
