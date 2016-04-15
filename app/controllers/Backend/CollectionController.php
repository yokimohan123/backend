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
use Collection;
use Session;
use CollectionImages;
use Response;



class CollectionController extends AdminAuthController {

	protected $layout = 'layouts.backend';
	protected $first_tab = 'active';
	protected $second_tab = '';
 	
        public function index()
	{
		$slides = Collection::get()->toArray();
		$this->layout->content = View::make('backend.collection.index',compact('slides'));
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /homepage/create
	 *
	 * @return Response
	 */
	public function createCollections()
	{
		$collection = new Collection;
		$first_tab = $this->first_tab;
        $second_tab = $this->second_tab;
		$this->layout->content = View::make('backend.collection.add_collections',compact('first_tab','second_tab','collection'));
	}
	public function correct_size($image) {
	    $maxHeight = 400;
	    $maxWidth = 600;            
	    list($width, $height) = getimagesize($image);
	    return ( ($width <= $maxWidth) && ($height <= $maxHeight) );
	}
	/**
	 * Store a newly created resource in storage.
	 * POST /homepage
	 *
	 * @return Response
	 */
	public function storeCollections()
	{
		$validator = Validator::make($data = Input::all(), Collection::$rules);

        if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
        }
		$newfilename = '';
		if (Input::file('image')) {
            $image = Input::file('image');
            $resize_image = Image::make($image->getRealPath());
			$width = $resize_image->width();
			$height = $resize_image->height();
			if($this->correct_size($image)){
				Session::flash('image_size', 'Image size must be greater than 600x400');
				return Redirect::back();
			}
			$filename = $image->getClientOriginalName();
			$extn = '.'.$image->getClientOriginalExtension(); 
			$fn = str_replace($extn, '', $filename);
			$frn = $fn."_".time();
			$newfilename = $frn . $extn;
			$data['image'] = $newfilename;
		} 
		$data['enabled'] = (Input::get('enabled')) ? '1' : '0';
        $id = Collection::create($data)->id;
		
		
		if($newfilename != '') {
			if(!(file_exists(public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'original'.DIRECTORY_SEPARATOR.$id))){
				 mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $id, 0777, true);
			}
			if(!(file_exists(public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'medium'.DIRECTORY_SEPARATOR.$id))){
				 mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR . $id, 0777, true);
			}
			if(!(file_exists(public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'cover'.DIRECTORY_SEPARATOR.$id))){
				 mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'cover' . DIRECTORY_SEPARATOR . $id, 0777, true);
			}
			//upload image in original folder without resize
			try {
				$original_image = Image::make($image->getRealPath())->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $newfilename);
			} catch (Exception $ex) {
				$upload_original_error = $ex;
			}
			
			if ($original_image) {
				$callback = function ($constraint) {
					$constraint->upsize();
				};
				//resize and upload the image in medium folder 230x130
				$resized_medium_image = Image::make($image->getRealPath())->resize(300,170)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $newfilename);
				
				//resize and upload the image in cover folder 850x470
				$resized_cover_image = Image::make($image->getRealPath())->resize(436,654)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'cover' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $newfilename);
			}
			
			
		}	
		Session::flash('collection_tab', 'Image');
		Session::flash('collect_msg', 'Collection has been added successfully.');
		return Redirect::route('backend.collection');
                                

	}
	public function editCollections($id) {
		$tab = Session::get('collection_tab');
        $collection = Collection::findOrFail($id);
		$collection_images = CollectionImages::where('collections_id', '=', $id)->get()->toArray();
		if(isset($tab) && $tab != '' && $tab == 'Image') {
			$first_tab = '';
			$second_tab = 'active';
  
		} else {
			$first_tab = $this->first_tab;
			$second_tab = $this->second_tab;                           
		}
        return View::make('backend.collection.add_collections', compact('collection','collection_images', 'first_tab', 'second_tab','tab'));
	}


	public function updateCollections($id) {
		$collection = Collection::findOrFail($id);
		if (Input::file('image')) {
			$validator = Validator::make($data = Input::all(), Collection::edit_image($id));
			//upload the image in the directory
			$image = Input::file('image');
			$resize_image = Image::make($image->getRealPath());
			$width = $resize_image->width();
			$height = $resize_image->height();
			if($this->correct_size($image)){
				Session::flash('image_size', 'Image size must be greater than 1300x560');
				return Redirect::back();
			}
			$filename = $image->getClientOriginalName();
			$extn = '.'.$image->getClientOriginalExtension(); 
			$fn = str_replace($extn, '', $filename);
			$frn = $fn."_".time();
			$newfilename = $frn . $extn;
			
			if(!(file_exists(public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'original'.DIRECTORY_SEPARATOR.$id))){
				 mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $id, 0777, true);
			}
			if(!(file_exists(public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'medium'.DIRECTORY_SEPARATOR.$id))){
				 mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR . $id, 0777, true);
			}
			if(!(file_exists(public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'cover'.DIRECTORY_SEPARATOR.$id))){
				 mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'cover' . DIRECTORY_SEPARATOR . $id, 0777, true);
			}
			
			//upload image in original folder without resize
			try {
				$original_image = Image::make($image->getRealPath())->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $newfilename);
			} catch (Exception $ex) {
				$upload_original_error = $ex;
			}
			
			if ($original_image) {
				$callback = function ($constraint) {
					$constraint->upsize();
				};
				//resize and upload the image in medium folder 230x130
				$resized_medium_image = Image::make($image->getRealPath())->resize(300,170)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'medium' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $newfilename);
				
				//resize and upload the image in cover folder 850x470
				$resized_cover_image = Image::make($image->getRealPath())->resize(436,654)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'cover' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $newfilename);
			}
						
			//delete exist image
			if(isset($collection->image) && $collection->image != '') {
				$old_cover_image = public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'cover'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$collection->image; 
				if(file_exists($old_cover_image)) {
					unlink($old_cover_image);
				}
				$old_medium_image = public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'medium'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$collection->image; 
				if(file_exists($old_medium_image)) {
					unlink($old_medium_image);
				}
				$old_original_image = public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'original'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$collection->image; 
				if(file_exists($old_original_image)) {
					unlink($old_original_image);
				}
			}
			$data['image'] = $newfilename;
		} else {
			$validator = Validator::make($data = Input::all(), Collection::edit($id));
			$data['image'] = $collection->image;
		}
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
        }
		$data['enabled'] = (Input::get('enabled')) ? '1' : '0';
	    Session::flash('collect_msg', 'Collection has been updated successfully.');
		if ($collection->update($data)) {
            if (Input::get('stay') == 1) {
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                return Redirect::route('backend.collection');
            }
        }
	}


	public function imageUpload($id) {

		$image = Input::file('file');
		$filename = $image->getClientOriginalName();
		$format = $image->getClientOriginalExtension();
		
		if(!(file_exists(public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'original'.DIRECTORY_SEPARATOR.$id))){
			 mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $id, 0777, true);
		}
		
		if(!(file_exists(public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$id))){
			 mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $id, 0777, true);
		}
		if(!(file_exists(public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'large'.DIRECTORY_SEPARATOR.$id))){
			 mkdir(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'large' . DIRECTORY_SEPARATOR . $id, 0777, true);
		}
		
		
		if($this->correct_size($image)){
			Session::flash('collection_tab', 'Image');
			Session::flash('image_size', 'Image size must be greater than 1300x560');
			return Response::json('error', 400);
			//return Redirect::back();
		}
		//exit;
		
		//upload the image in original folder
		
		$extn = '.'.$image->getClientOriginalExtension(); 
		$fn = str_replace($extn, '', $filename);
		$frn = $fn."_".time();
		$newfilename = $frn . $extn;
		
		try {
            $original_image = Image::make($image->getRealPath())->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $newfilename);
        } catch (Exception $ex) {
            $upload_original_error = $ex;
        }
		
		if ($original_image) {
            $callback = function ($constraint) {
                $constraint->upsize();
            };
			
			//resize and upload the image in medium folder 670x450
			$resized_large_image = Image::make($image->getRealPath())->resize(436,654)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'large' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $newfilename);
			
			//resize and upload the image in cover folder 150x100
			$resized_thumb_image = Image::make($image->getRealPath())->resize(240,145)->save(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $newfilename);
			
		}
		
		//update the image info in the table
		$data['image'] = $newfilename;
		$data['collections_id'] = $id;
		CollectionImages::create($data);
		Session::flash('collection_tab', 'Image');
		Session::flash('collect_msg', 'Collection images has been added successfully.');
		return Response::json('success', 200);
	}

	public function imageDelete($id) {
		$collection_image = CollectionImages::findOrFail($id);
		
                   if (Input::get('delete') == 1) {
                                $large_image = public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'large'.DIRECTORY_SEPARATOR.$collection_image->collections_id.DIRECTORY_SEPARATOR.$collection_image->image; 
                                if(file_exists($large_image)) {
                                        unlink($large_image);
                                }

                                $thumb_image = public_path() . DIRECTORY_SEPARATOR .'uploads'.DIRECTORY_SEPARATOR.'collections'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$collection_image->collections_id.DIRECTORY_SEPARATOR.$collection_image->image; 
                                if(file_exists($thumb_image)) {
                                        unlink($thumb_image);
                                }

                                $original_image = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR . $collection_image->collections_id . DIRECTORY_SEPARATOR . $collection_image->image;

                                if(file_exists($original_image)) {
                                        unlink($original_image);
                                }
                                CollectionImages::destroy($id);
                                Session::flash('collection_tab', 'Image');
                                Session::flash('collect_msg', 'Collection images has been deleted successfully.');
                                return Redirect::back()->with('collection_tab', 'Image');
                                
                            
                  }else{
                       $validator = Validator::make($data = Input::all(), CollectionImages::$rules);
                       if ($validator->fails()) {
                                return Redirect::back()->with('collectio_tab', 'Image')->withErrors($validator)->withInput();
                                 
                        }
                        $collection_image->meta_title = Input::get('meta_title');
                        $collection_image->link = Input::get('link');
                 
               
                
               
                        if ($collection_image->save()) {
                        Session::flash('collection_tab', 'Image');
                        Session::flash('collect_msg', 'Collection images has been updated successfully.');
                        return Redirect::back()->with('collection_tab', 'Image')->with('success', 'Awesome! you have changed the image title/alt.');


                        }
                
                }                
        }

	/**
	 * Remove the specified resource from storage.
	 * GET /homepage/{id}
	 *
	 * @param  int  $id 
	 * @return Response
	 */
	public function destroyCollections($id)
	{
		try {
			$slide = Collection::find($id);
			$image = $slide->image;
		} catch (\Exception $e) {
			return Redirect::route('backend.collection')
				->with('message', 'Something went wrong');
		}
		
		if($slide->delete()){
			File::delete(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'original'. DIRECTORY_SEPARATOR . $image);
			File::delete(public_path(). DIRECTORY_SEPARATOR .'uploads' . DIRECTORY_SEPARATOR . 'collections' . DIRECTORY_SEPARATOR . 'medium'. DIRECTORY_SEPARATOR . $image);
			return Redirect::route('backend.collection')
				->with('message', 'Collection Destroyed');
		}
		return Redirect::route('backend.collection')
				->with('message', 'Something went wrong');
	}

        
        
        
}