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
// use Maincategory;
use Category;
use Session;
class CategoriesController extends AdminAuthController {

    protected $layout = 'layouts.backend';
 
    public function index()
    {
        $categories = Category::getRoots();
        return View::make('backend.categories.index', compact('categories'));
        // $slides = $slides->toArray();
        // $this->layout->content = View::make('backend.maincategory.index',compact('slides'));
    }
    /**
     * Show the form for creating a new resource.
     * GET /homepage/create
     *
     * @return Response
     */    

    public function createCategory()
    {

        $this->layout->content = View::make('backend.categories.add_maincategory');
    }

    /**
     * Store a newly created resource in storage.
     * POST /homepage
     *
     * @return Response
     */
    public function addCategory()
    {
        $validator = Validator::make($data = Input::all(), Category::$rules);
        
        if ($validator->fails()){ 
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $enabled = Input::get('enabled');
            $enabled = ($enabled) ? 1 : 0;
            $category = new Category;
            $category->name = Input::get('name');
            $category->description = Input::get('description');
            $url = $category->slug = Input::get('slug');
            $category->enabled = $enabled;
            $category->meta_title = Input::get('meta_title');       
            $category->meta_description = Input::get('meta_description');
            $category->meta_keyword = Input::get('meta_keyword');
            $category->save();

            return Redirect::route('backend.categories.index')
                ->with('message', 'Category Created');
        }                            

    }
    /**
     * Remove the specified resource from storage.
     * GET /homepage/{id}
     *
     * @param  int  $id 
     * @return Response
     */    

    public function categories($id) {
        $parent = Category::find($id);
        $categories = $parent->getChildren();

        return View::make('backend.categories.index', compact('parent', 'categories'));
    }

    public function create($id = null) {
        if ($id != null) {
            $parent = Category::find($id);
        }

        $category = new Category;
        return View::make('backend.categories.create', compact('category', 'parent'));
    }

    public function postCreate() {
        $parent_id = Input::get('parent_id');
        if ($parent_id) {
            $enabled = Input::get('enabled');
            $enabled = ($enabled) ? 1 : 0;
            $category = Category::find(Input::get('parent_id'));
            $newChild = new Category(array(
                'name' => Input::get('name'),
                'slug' => Input::get('slug'),
                'description' => Input::get('description'),
                'enabled' => $enabled,
                'meta_title' => Input::get('meta_title'),
                'meta_description' => Input::get('meta_description'),
                'meta_keyword' => Input::get('meta_keyword')                
            ));
             $url = $newChild['slug'];
             $validator = Validator::make($data = Input::all(), Category::$rules, array(Category::replaceSlug($url)));
             if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }else{
                $category->addChild($newChild);
                return Redirect::route('backend.categories.sub', $parent_id);
            }            
        } else {
            $validator = Validator::make($data = Input::all(), Category::$rules, array(Category::replaceSlug($url)));

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            Category::create($data);
            return Redirect::route('backend.categories.index');
        }
    }

    public function edit($id) {
        $category = Category::findOrFail($id);
        return View::make('backend.categories.create', compact('category'));
    }

    public function update($id) {
        $category = Category::findOrFail($id);
        $category->name = Input::get('name');
        $url = $category->slug = Input::get('slug');
        $category->description = Input::get('description');        
        $enabled = Input::get('enabled');
        $enabled = ($enabled) ? 1 : 0;
        $category->enabled = $enabled;
        $category->meta_title = Input::get('meta_title');       
        $category->meta_description = Input::get('meta_description');
        $category->meta_keyword = Input::get('meta_keyword');              
        
        $validator = Validator::make($data = Input::all(), Category::updaterules($id), array($category->slug = Category::replaceSlug($url)));

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $category->save();

        if ($category->parent_id > 0) {
            return Redirect::route('backend.categories.sub', array('parent_id' => $category->parent_id));
        } else {
            return Redirect::route('backend.categories.index');
        }
    }

    /**
     * Remove the specified backendproduct from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $category = Category::findOrFail($id);
        if(count($category->parent_id) > 0){
            Session::flash('cat_msg', 'You must delete the child category!');
        }else{
            Category::destroy($id);    
        }
        
        return Redirect::back();
    }
}
