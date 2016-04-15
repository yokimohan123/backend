<?php

namespace Backend;

use AdminAuthController;
use User;
use Input;
use Validator;
use Redirect;
use View;
use Sentry;
use Session;
use Hash;

class ProfileController extends AdminAuthController {

    protected $layout = 'layouts.backend';

    public function index() {
        $user = Sentry::getUser();
        return View::make('backend.users.index', compact('user'));
    }

    public function users($id) {
        $users = User::find($id);
        return View::make('backend.users.index', compact('users'));
    }

    public function create($id = null) {
        if ($id != null) {
            $user = User::find($id);
        }        
                      
        $user = new User;
        return View::make('backend.users.create', compact('user'));
    }

    public function postCreate() {
        try
        {
            $users = Sentry::createUser(array(
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'email' => Input::get('email'),
                'username' => Input::get('username'),
                'password' => Input::get('password'),
                'activated' => true,
            ));
            // Find the group using the group id
                $adminGroup = Sentry::findGroupById(3);

                // Assign the group to the user
                $users->addGroup($adminGroup);
                $gr = Sentry::findGroupByName('User');

                $permissions = $gr->permissions;                
                $per = json_encode($permissions);               
        }
                catch (\Cartalyst\Sentry\Users\UserExistsException $e)
                {
                    Session::flash('message', "A user already exists with login Credentials, logins must be unique for users.");
                   return Redirect::back()->withInput()->with('error',$e->getMessage());
                }
                catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
                {
                    Session::flash('message', "A Email field is required for a user, none given.");
                   return Redirect::back()->withInput()->with('error',$e->getMessage());
                }
                catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
                {
                    Session::flash('message', "A password is required for user Credentials, none given.");
                   return Redirect::back()->withInput()->with('error',$e->getMessage());
                }
                // $users = Sentry::authenticate(array($users, true));


                return Redirect::route('backend.users.index', 'users');
         

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            return Redirect::route('backend.users.index', compact('users'));
        
    }

    public function edit($id) {
        $user = User::find($id);
        return View::make('backend.users.create', compact('user'));
    }

    public function update($id) {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required'
        );
        $validator = Validator::make($data = Input::all(), User::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $users = User::find($id);
            $users->first_name = Input::get('first_name');
            $users->last_name = Input::get('last_name');
            $users->email = Input::get('email');
            $users->username = Input::get('username');
            $users->password = Hash::make(Input::get('password'));
           
            $users->save();
        }

        $users->update($data);
        $stay = Input::get('stay');
        if ($stay == "true") {
            return Redirect::back() ->with('message', 'Password updated sucessfully!');;
        } else {
            return Redirect::route('backend.users.index', compact('users')) ->with('message', 'Password updated sucessfully!');;
        }
    }

    public function destroy($id) {
        User:destroy($id);
        return Redirect::route('backend.users.index');
    }

    public function change() {
        $user = Sentry::getUser();
        return View::make('backend.users.change', compact('user'));
    }

    public function passwordUpdate($id) {
        $email = Input::get('email');
        $oldpassword = Hash::make(Input::get('password'));
        $newpassword = Input::get('new_password');
        $repassword = Input::get('confirm-password');
        $hash = Sentry::getuser()->password;

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
            return Redirect::route('backend.users.index')
                            ->with('message', 'Password updated sucessfully!');
        }
    }

    public function editUserPassword($id) {
        $user = User::find($id);
        return View::make('backend.users.change', compact('user'));
    }

}
