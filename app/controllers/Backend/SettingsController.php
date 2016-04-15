<?php

namespace Backend;

use AdminAuthController ;
use Settings;
use Block;
use View;
use Input;
use Redirect;
use Validator;
use Image;


class SettingsController extends AdminAuthController  {

    protected $layout = 'layouts.backend';

    public function showGeneral() {
        $block = Block::where('slug', 'LIKE', '%general%')->get()->toArray();
        $this->layout->content = View::make('backend.settings.general', compact('block'));
    }

    //update general sections
    public function updateGeneral() {
        // validate against the inputs from our form

        $validator = Validator::make(Input::all(), Block::$generalrules);

        // check if the validator failed 
        if ($validator->fails()) {

            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::back()
                            ->withErrors($validator);
        } else {
            $mail = Input::get('general_admin_email');

            if ($mail != null) {
                $save_mail = Block::where('slug', 'general_admin_email')->first();
                $save_mail->link = $mail;
                $save_mail->save();
            }

            return Redirect::back();
        }
    }

    //show socialicons backend
    public function index() {
        $block = Block::where('slug', 'LIKE', '%footer%')->get()->toArray();
        $this->layout->content = View::make('backend.settings.socialicon', compact('block'));
    }

    public function updateSocialIcons() {
        // process the form here

        $rules = array(
            'footer_facebook' => 'required', // just a normal required validation
            'footer_facebook' => 'required',
            'footer_facebook' => 'required',
            'footer_facebook' => 'required',
        );

        // validate against the inputs from our form

        $validator = Validator::make(Input::all(), Block::$iconrules);

        // check if the validator failed 
        if ($validator->fails()) {

            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::back()
                            ->withErrors($validator);
        } else {

            // validation successful 

            $link_1 = Input::get('footer_facebook');
            // $link_2 = Input::get('footer_pinterest');
            // $link_3 = Input::get('footer_instagram');
            $link_4 = Input::get('footer_twitter');
            $link_5 = Input::get('footer_linkedin');


            if ($link_1 != null) {
                $save_link_1 = Block::where('slug', 'footer_facebook')->first();
                $save_link_1->link = $link_1;
                $save_link_1->save();
            }

            // if ($link_2 != null) {
            //     $save_link_2 = Block::where('slug', 'footer_pinterest')->first();
            //     $save_link_2->link = $link_2;
            //     $save_link_2->save();
            // }

            // if ($link_3 != null) {
            //     $save_link_3 = Block::where('slug', 'footer_instagram')->first();
            //     $save_link_3->link = $link_3;
            //     $save_link_3->save();
            // }

            if ($link_4 != null) {
                $save_link_4 = Block::where('slug', 'footer_twitter')->first();
                $save_link_4->link = $link_4;
                $save_link_4->save();
            }

            if ($link_5 != null) {
                $save_link_5 = Block::where('slug', 'footer_linkedin')->first();
                $save_link_5->link = $link_5;
                $save_link_5->save();
            }

            return Redirect::back();
        }
    }

    public function address() {
        $block = Block::where('slug', 'LIKE', '%footer_address%')->get()->toArray();
        $this->layout->content = View::make('backend.settings.addressbook', compact('block'));
    }

    public function updateAddressDetails() {
        // process the form here

        $rules = array(
            'footer_address_line_1' => 'required',
            'footer_address_line_2' => 'required',
            'footer_address_line_3' => 'required',
            'footer_address_country' => 'required'
        );

        // validate against the inputs from our form
        $validator = Validator::make(Input::all(), $rules);

        // check if the validator failed 
        if ($validator->fails()) {

            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::back()
                            ->withErrors($validator);
        } else {
            // validation successful 

            $address_1 = Input::get('footer_address_line_1');
            $address_2 = Input::get('footer_address_line_2');
            $address_3 = Input::get('footer_address_line_3');
            $address_4 = Input::get('footer_address_country');

            if ($address_1 != null) {
                $save_address_1 = Block::where('slug', 'footer_address_line_1')->first();
                $save_address_1->title = $address_1;
                $save_address_1->save();
            }

            if ($address_2 != null) {
                $save_address_2 = Block::where('slug', 'footer_address_line_2')->first();
                $save_address_2->title = $address_2;
                $save_address_2->save();
            }

            if ($address_3 != null) {
                $save_address_3 = Block::where('slug', 'footer_address_line_3')->first();
                $save_address_3->title = $address_3;
                $save_address_3->save();
            }

            if ($address_4 != null) {
                $save_address_4 = Block::where('slug', 'footer_address_country')->first();
                $save_address_4->title = $address_4;
                $save_address_4->save();
            }

            return Redirect::back();
        }
    }

    //SEO function starts ...............
    public function seo() {
        $block = Block::where('slug', 'LIKE', '%meta%')->get()->toArray();
        return View::make('backend.settings.meta', compact('block'));
    }

    public function createSeo() {
        $this->layout->content = View::make('backend.settings.create_meta');
    }

    //ADD seo tags    
    public function addSeo() {

        $block = new Block;
        $block->slug = Input::get('slug');
        $block->title = Input::get('title');
        $block->content = Input::get('content');
        $block->keyword = Input::get('keyword');


        $validator = Validator::make($data = Input::all(), Block::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $block->save();
            $block = Block::where('slug', 'LIKE', '%meta%')->get()->toArray();
            return View::make('backend.settings.meta', compact('block'));
        }
    }

    //Edit Meta tags 
    public function editSeo($id) {
        $block = Block::find($id);
        return View::make('backend.settings.edit_meta')->with('block', $block);
    }

    public function updateSeo($id) {

        $block = Block::findOrFail($id);

        // validate
        $validator = Validator::make($data = Input::all(), Block::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $block = $block->update($data);
            return Redirect::route('backend.meta', compact('block'));
        }
    }

    //Delete meta data
    public function destroy($id) {
        Block::destroy($id);
        return Redirect::back();
    }
    //SEO function ends ...............

    //Terms and Condition starts
    public function termsAndCondition(){
        $terms = Block::where('slug','=','terms-and-condition')->get()->first();
        $this->layout->content = View::make('backend.terms.terms-and-condition',compact('terms'));
    }
        
    public function editTermsAndCondition(){
        $terms = Block::where('slug','=','terms-and-condition')->get()->first();
        $this->layout->content = View::make('backend.terms.terms-edit',compact('terms'));
    }

    public function updateTermsAndCondition(){
        $data = Input::all();
        $terms = Block::where('slug','=','terms-and-condition')->get()->first();
        $terms->content = $data['content'];
        $terms->save();
        return Redirect::route('backend.terms-and-condition');
    }

    //Terms and Condition ends
    
}
