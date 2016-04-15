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
use Press;




class PressController extends AdminAuthController {

	protected $layout = 'layouts.backend';
 
        public function index()
	{
		$slides = Press::get()->toArray();
		$this->layout->content = View::make('backend.press.index',compact('slides'));
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /homepage/create
	 *
	 * @return Response
	 */
	public function createPressSlides()
	{
		$this->layout->content = View::make('backend.press.add_images');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /homepage
	 *
	 * @return Response
	 */
	public function storePressSlides()
	{
		$validator = Validator::make($data = Input::all(), Press::$rules);
		
		if ($validator->fails()){ 
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$slider = new Press;
			$slider->title = Input::get('title');
			$slider->alt = Input::get('alt');
                        
            $image = Input::file('image');
			$filename  = time() . '.' . $image->getClientOriginalExtension();
			if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR)) {
                mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR, 0777, true);
            }
            if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR)) {
                mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR, 0777, true);
            }
            if (!file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR)) {
                mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'small' . DIRECTORY_SEPARATOR, 0777, true);
            }
            $original_image = Image::make($image->getRealPath())->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'original'. DIRECTORY_SEPARATOR . $filename);

            $resized_medium_image = Image::make($image->getRealPath())->resize(391, 510)->save(public_path(). DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'medium'. DIRECTORY_SEPARATOR . $filename);
            $resized_small_image = Image::make($image->getRealPath())->resize(177, 243)->save(public_path(). DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'small'. DIRECTORY_SEPARATOR . $filename);
			$slider->image = $filename;
			$slider->save();

			return Redirect::route('backend.press')
				->with('message', 'Slides Created');
		}
                                

	}

	/**
	 * Remove the specified resource from storage.
	 * GET /homepage/{id}
	 *
	 * @param  int  $id 
	 * @return Response
	 */
	public function destroyPressSlides($id)
	{
		try {
			$slide = Press::find($id);
			$image = $slide->image;
		} catch (\Exception $e) {
			return Redirect::route('backend.press')
				->with('message', 'Something went wrong');
		}
		
		if($slide->delete()){
			File::delete(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'original'. DIRECTORY_SEPARATOR . $image);
			File::delete(public_path(). DIRECTORY_SEPARATOR .'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'medium'. DIRECTORY_SEPARATOR . $image);
			File::delete(public_path(). DIRECTORY_SEPARATOR .'uploads' . DIRECTORY_SEPARATOR . 'press' . DIRECTORY_SEPARATOR . 'small'. DIRECTORY_SEPARATOR . $image);
			return Redirect::route('backend.press')
				->with('message', 'Slider Destroyed');
		}
		return Redirect::route('backend.press')
				->with('message', 'Something went wrong');
	}

        
        
        
}