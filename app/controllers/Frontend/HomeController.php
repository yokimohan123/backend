<?php

namespace Frontend;

use FrontOfficeController;
use View;
use HomepageSlider;
use Block;
use Validator;
use Input;
use Contactus;
use Mail;
use Redirect;
use Press;


class HomeController extends FrontOfficeController {

    protected $layout = 'layouts.homepage';

    public function index() {
        $sliders = HomepageSlider::where('enabled', '=', 1)->get()->toArray();
        $sliderTitle = HomepageSlider::where('enabled', '=', 1)->get()->lists('title');
        $this->layout->with(array('sliders' => $sliders,'sliderTitle'=>$sliderTitle));
        $this->layout->content = View::make('frontend.index',compact('sliders','sliderTitle'));
    }
    
    public function contactus() {
    	$metas = Block::where('slug','LIKE','meta_contact_us')->first();
        
        return View::make('frontend.contactus',compact('metas'));
    }
    public function postcontactus() {

        $validator = Validator::make($data = Input::all(), Contactus::$contact);
                                                  
        if($validator->fails()){
            return Redirect::back()->withErrors($validator);
        }else{

            //Send email using Laravel send function
            Mail::send('emails.hello', $data, function($message) use ($data) {
                
                //email 'From' field: Get users email add and name
                $message->from($data['email'], $data['first_name']);
                

                $block = Block::all();
                $block = Block::where('slug', 'LIKE', '%general_admin_email%')->get($block[0]['link']);

                //email 'To' field: change this to emails that you want to be notified.                    
                $message->from($block[0]['link'])
                        ->to($data['email'], $data['first_name'])
                        ->cc($block[0]['link'])
                        ->replyTo($block[0]['link'])
                        ->subject('contact request');   
    
            });
        } 

            Contactus::saveFormData(Input::except(array('_token')));
            return Redirect::route('frontend.contactus')->withMessage('Thank you. Our representative will get back to you shortly.');
        
    }

    public function Privatepolicy(){
        $policy = Block::where('slug','=','private-policy')->get()->first();
        return View::make('frontend.policy',compact('policy'));
    }
    public function termsAndCondition(){
            $terms = Block::where('slug','=','terms-and-condition')->get()->first();
            return View::make('frontend.terms.terms-and-condition',compact('terms'));
    }
    
    public function press() {
        
        $sliders = Press::all();
        return View::make('frontend.press',compact('sliders'));
    }
}