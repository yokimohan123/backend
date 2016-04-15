<?php
namespace Backend;

use AdminAuthController;
use View;
use HomepageSlider;
use Redirect;
use Image;
use Input;
use Validator;
use File;
use Response;
use Sentry;
use Session;
use Register;
use Order;
use User;
use OrdersStatus;
use Block;


class HomepageController extends AdminAuthController {

    protected $layout = 'layouts.backend';

    public function dashboard() {
        $user = Sentry::getUser();
        Session::put('username', $user['username']);
        Session::save();

        $registeredUser = User::get()->toArray();
        $orders = Order::get()->toArray();
        $ordersCompleted = Order::where('order_status', '=','Delivered')->get()->toArray();
        $last5Order = Order::join('users','orders.user_id','=','users.id')->take(5)->orderBy('orders.id', 'DESC')->get(array('order_price_total','orders.id','users.first_name','users.last_name','users.id as user_id','orders.reference_no'))->toArray();
        $orderstatus = OrdersStatus::lists('status','id');
        $input = Input::all();
        if(isset($input['status'])){
            $status = OrdersStatus::where('id','=',$input['status'])->first();
            $ordersbystatus = Order::join('users','orders.user_id','=','users.id')->where('orders.order_status','=',$status->status)->orderBy('orders.id', 'DESC')->get(array('reference_no','shipping_price_total','discount_price','tax_price_total','order_price_total','payment_type','order_date','order_status','invoice_no','invoice_date','orders.id','users.first_name','users.last_name','users.email','users.id as user_id'))->toArray();           
        }
        $this->layout->content = View::make('backend.index', compact('registeredUser','orders','ordersCompleted','last5Order','orderstatus','ordersbystatus'));
    }   
        
    public function sliders()
    {
        $homepagesliders = HomepageSlider::where('enabled','=',1)->get()->toArray();
        $this->layout->content = View::make('backend.homepage.sliders',compact('homepagesliders'));
    }
    /**
     * Show the form for creating a new resource.
     * GET /homepage/create
     *
     * @return Response
     */
    public function createSlider()
    {
        $homepageslider = new HomepageSlider;
        $this->layout->content = View::make('backend.homepage.create_slider', compact('homepageslider'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /homepage
     *
     * @return Response
     */
    //Exaact size for Homepage image slider.
    public function correct_size($image) {
        $maxHeight = 745;
        $maxWidth = 1365;            
        list($width, $height) = getimagesize($image);
        return ( ($width <= $maxWidth) && ($height <= $maxHeight) );
    }


     public function storeSlider() {
        $validator = Validator::make($data = Input::all(), HomepageSlider::$rules);
            
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();

        } else {
            $slider = new HomepageSlider;
            $slider->title = Input::get('title');
            $slider->alt = Input::get('alt');
            $slider->month = Input::get('month');
            $slider->link = Input::get('link');
            $slider->color = Input::get('color');
            $slider->enabled = true;

            $image = Input::file('image');
            if($this->correct_size($image)){
                Session::flash('image_size', 'Image size must be greater than 1365x745');
                return Redirect::back();
            }
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image->getRealPath())->resize(1366, 746)->save(public_path() . '/uploads/home/slider/' . $filename);
            Image::make($image->getRealPath())->save(public_path() . '/uploads/home/slider/originals/' . $filename);
            $slider->image = $filename;
            $slider->save();

            return Redirect::route('homesliders')
                            ->with('message', 'Slider Created');
        }
    }

    /**
     * Remove the specified resource from storage.
     * GET /homepage/{id}
     *
     * @param  int  $id 
     * @return Response
     */
    public function editSlider($id) {
        $homepageslider = HomepageSlider::findOrfail($id);
        $this->layout->content = View::make('backend.homepage.create_slider', compact('homepageslider'));
    }
    public function updateSlider($id) {
        $homepageslider = HomepageSlider::findOrFail($id);

        if (Input::file('image')) {
        $validator = Validator::make($data = Input::all(), HomepageSlider::edit_image($id));
        $slider_image = Input::file('image');
        if($this->correct_size($slider_image)){
                Session::flash('image_size', 'Image size must be greater than 1365x745');
                return Redirect::back();
            }
        }
        
        $validator = Validator::make($data = Input::all(), HomepageSlider::$editrules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $old_image = $homepageslider->image;
            $data['image'] = $old_image;
            if (isset($slider_image) && $slider_image != '') {
                $filename = time() . '.' . $slider_image->getClientOriginalExtension();
                Image::make($slider_image->getRealPath())->resize(1366, 746)->save(public_path() . '/uploads/home/slider/' . $filename);
                Image::make($slider_image->getRealPath())->save(public_path() . '/uploads/home/slider/originals/' . $filename);
                $data['image'] = $filename;
            }
            if($old_image !=''){
                $old_image = $homepageslider->image;
                File::delete(public_path() . '/uploads/home/slider/originals/' . $old_image);
                File::delete(public_path() . '/uploads/home/slider/' . $old_image);
            }
            $homepageslider->update($data);

            return Redirect::route('homesliders')
                            ->with('message', 'Slider Updated');
        }
        
    }
    /**
     * Remove the specified resource from storage.
     * GET /homepage/{id}
     *
     * @param  int  $id 
     * @return Response
     */
    public function destroySlider($id) {
        try {
            $slid = HomepageSlider::find($id);
            $image = $slid->image;
        } catch (\Exception $e) {
            return Redirect::route('homesliders')
                            ->with('message', 'Something went wrong');
        }

        if ($slid->delete()) {
            File::delete(public_path() . '/uploads/home/slider/originals/' . $image);
            File::delete(public_path() . '/uploads/home/slider/' . $image);
            return Redirect::route('homesliders')
                            ->with('message', 'Slider Destroyed');
        }
        return Redirect::route('homesliders')
                        ->with('message', 'Something went wrong');
    }

    public function Privatepolicy(){
        $policy = Block::where('slug','=','private-policy')->get()->first();
        $this->layout->content = View::make('backend.policy',compact('policy'));
    }
        
    public function PrivatepolicyEdit(){
        $policy = Block::where('slug','=','private-policy')->get()->first();
        $this->layout->content = View::make('backend.policy-edit',compact('policy'));
    }

    public function PrivatepolicyUpdate(){
        $data = Input::all();
        $policy = Block::where('slug','=','private-policy')->get()->first();
        $policy->content = $data['content'];
        $policy->save();
        return Redirect::route('backend.policy');
    }

    
}