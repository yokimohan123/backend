<?php

namespace Backend;

use AdminAuthController;
use View;
use Input;
use Redirect;
use DB;
use URL;
use Mail;
use Validator;
use User;
use CouponCode;
use Session;
use Block;

class CouponCodeController extends AdminAuthController {
	protected $layout = 'layouts.backend';
	protected $first_tab = 'active';
	protected $second_tab = '';

	public function couponIndex(){
	        $coupon_code = CouponCode::all();
	        return View::make('backend.coupon_code.index',compact('coupon_code'));
	}

    public function couponCreate(){
        $coupon_code = new CouponCode;
		$first_tab = $this->first_tab;
        $second_tab = $this->second_tab;
        $users = User::all();

		$this->layout->content = View::make('backend.coupon_code.coupon_code_new',compact('first_tab','second_tab','coupon_code','users'));
    }

    public function couponPostCreate(){
    	$validator = Validator::make($data = Input::all(), CouponCode::$rules);

    	if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
        }else{
        	$coupon_code = new CouponCode;
        	$coupon_code->name = Input::get('name');
        	$coupon_code->description = Input::get('description');
			$coupon_code->code = Input::get('code');
			$coupon_code->save();
        }
        Session::flash('coupon_tab', 'coupon_code');
		Session::flash('collect_msg', 'Collection has been added successfully.');
		return Redirect::route('backend.coupon-code');

    }
    public function couponPostEdit($id) {
		$tab = Session::get('coupon_tab');

        $coupon_code = CouponCode::findOrFail($id);
        
        $users = User::all();
        $user = User::where('id','=',$coupon_code->user_id)->get()->toArray();
        
        	$datas = array(
                'first_name' => $user[0]['first_name'],
                'email' => $user[0]['email']
            );
            $input = array(
            'first_name' => $user[0]['first_name'],            
            );

            Mail::send('emails.admin.coupon_code.coupon_mail', $input, function($message) use ($datas){
                $block = Block::all();
                $block = Block::where('slug', 'LIKE', '%general_admin_email%')->get($block[0]['link']);
                //email 'To' field: change this to emails that you want to be notified.
                $message->from($block[0]['link'])
                        ->to($datas['email'], $datas['first_name'])
                        ->cc($block[0]['link'])
                        ->replyTo($block[0]['link'])
                        ->subject('Couponcode for your product');
            });
        

            
		
		if(isset($tab) && $tab != '' && $tab == 'coupon_code') {
			$first_tab = '';
			$second_tab = 'active';
  
		} else {
			$first_tab = $this->first_tab;
			$second_tab = $this->second_tab;                           
		}
        return View::make('backend.coupon_code.coupon_code_new', compact('coupon_code', 'first_tab', 'second_tab','tab','user','users'));
	}
	public function couponPostUpdate($id){
		$coupon_code = CouponCode::findOrFail($id);

		$validator = Validator::make($data = Input::all(), CouponCode::edit($id));
		if ($validator->fails()){ 
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
                $coupon_code->name = Input::get('name');
                $coupon_code->description = Input::get('description');
                $coupon_code->code = Input::get('code');
                $coupon_code->save();                                		
		}
		Session::flash('coupon_tab', 'coupon_code');
		Session::flash('collect_msg', 'Collection has been added successfully.');
		return Redirect::route('backend.coupon-code');
	}

	public function userListSave($id){
		// echo "sf";
		// exit;
		$tab = Session::get('coupon_tab');

        $coupon_code = CouponCode::findOrFail($id);
        
        $users = User::all();
        $user = User::where('id','=',$coupon_code->user_id)->get()->toArray();
        
        	$datas = array(
                'first_name' => $user[0]['first_name'],
                'email' => $user[0]['email']
            );
            $input = array(
            'first_name' => $user[0]['first_name'],            
            );

            Mail::send('emails.admin.coupon_code.coupon_mail', $input, function($message) use ($datas){
                $block = Block::all();
                $block = Block::where('slug', 'LIKE', '%general_admin_email%')->get($block[0]['link']);
                //email 'To' field: change this to emails that you want to be notified.
                $message->from($block[0]['link'])
                        ->to($datas['email'], $datas['first_name'])
                        ->cc($block[0]['link'])
                        ->replyTo($block[0]['link'])
                        ->subject('Couponcode for your product');
            });
        

            
		
		if(isset($tab) && $tab != '' && $tab == 'coupon_code') {
			$first_tab = '';
			$second_tab = 'active';
  
		} else {
			$first_tab = $this->first_tab;
			$second_tab = $this->second_tab;                           
		}
        return View::make('backend.coupon_code.coupon_code_new', compact('coupon_code', 'first_tab', 'second_tab','tab','user','users'));
	}

}