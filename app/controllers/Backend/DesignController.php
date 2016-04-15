<?php

namespace Backend;

use AdminAuthController;
use Settings;
use Block;
use View;
use Input;
use Redirect;
use Validator;
use Image;
use Design;


class DesignController extends AdminAuthController  {

    protected $layout = 'layouts.backend';

    public function displayDesignerInfo() {
        $block = Design::all();
        $this->layout->content = View::make('backend.designer.index',compact('block'));
    }

    public function alterDesignerInfo() {
        $block = Design::all();
//        $block = Design::findOrFail($id);
        return View::make('backend.designer.edit', compact('block'));
    }

    public function updateDesignerInfo($id){
                $block = Design::findOrFail($id);
                
                
		$validator = Validator::make($data = Input::all(), Design::$aboutdesigner);
		
		if ($validator->fails()){ 
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
                if ($block != null){    
//              $block->title = Input::get('title');
//		$block->alt = Input::get('alt');
                $block->content = Input::get('content');
                if (Input::file('image')){
                $image = Input::file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image->getRealPath())->resize(448, 674)->save(public_path() . '/images/' . $filename);
                $block->image = $filename;
                }
                $block->save();
                }
                
		return Redirect::back()->with('message', 'About Designer Updated');
		}
	}

    
}

