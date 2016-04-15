<?php

namespace Backend;

use Sentry;
use View;
use Input;
use Redirect;
use User;
use URL;
Use Mail;
use Validator;
use Hash;
use Session;
// use BaseController;


class AuthController extends \BaseController {
    
    protected $layout = 'layouts.backend';
    
    
    public function backend() {

        if (Sentry::check() && Sentry::getUser()) {
         
            return Redirect::route('backend.dashboard');
        } 
            return View::make('layouts.login');                
    }
        
    public function postLogin() {        
        $credentials = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );        
        $this->layout->content = View::make('backend.index');                
        try {
            $user = Sentry::authenticateAndRemember($credentials, false);  
            if ($user) {   
                return Redirect::route('backend');
            }
        } catch (\Exception $e) {    
            return Redirect::route('backend')->withErrors(array('login' => $e->getMessage()));
        }
    }

    public function logout() {
        Sentry::logout();
        return Redirect::route('backend');
    }

    public function remind() {
        return View::make('backend.password.remind');
    }

    public function request() {
        $email = Input::only('email');
        $mailExist = User::where('email', '=', $email)->first();
        if (is_null($mailExist)) {
            return Redirect::back()->withFlashMessage("The mail doesn't exist!!!");
        } else {
            $code = str_random(60);
            $mailExist->reset_password_code = $code;
            $mailExist->activated = 0;
            $mailExist->save();

            $data = array(
                'firstname' => $mailExist->email,
                'link' => URL::route('password.reset', $code)
            );
            
            Mail::send('emails.admin.reset', $data, function($message) use ($mailExist) {
                $message->from("admin@wiredelta.com", "Dimaayad")
                        ->to($mailExist->email, $mailExist->firstname)
                        ->subject('Reset your password');
            });

            return Redirect::back()->withFlashMessage("Check the mail to reset your password");
        }
    }

    public function change() {
        return View::make('backend.password.change');
    }

    public function PasswordChange() {
        $email = Input::get('email');
        $oldpassword = Hash::make(Input::get('password'));
        $newpassword = Input::get('new_password');
        $repassword = Input::get('confirm-password');
        $hash = Sentry::getuser('password');

        $validator = Validator::make($data = Input::all(), User::$password_rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            Hash::check($oldpassword, $hash); // true
            Hash::check($newpassword, $hash); // true

            $passw = Hash::make($newpassword);
            $username = Sentry::getuser('username');
            $userid = Sentry::getuser('id');
            $user = Sentry::update(array('password' => $newpassword));
            //Save updates
            $user = Sentry::save();
            return Redirect::route('backend.index')
                            ->with('success');
        }
        
    }

    public function reset($code) {
        $user = User::where('reset_password_code', '=', $code)->first();
        $user->activated = 1;
        //$user->reset_password_code = ' ';
        $user->save();
        return View::make('backend.password.reset', compact('code'));
    }

    public function update() {
        $input = Input::all();
        $validator = Validator::make($data = Input::all(), User::$change_password_rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $user = User::where('reset_password_code', '=', $input['code'])->first();
            //$user->email = $input['email'];
            $user->password = Hash::make($input['password']);
            $user->reset_password_code = ' ';
            $user->save();
            return Redirect::route('backend.index')->withFlashMessage("Login with your new credentials");
        }
    }   
}