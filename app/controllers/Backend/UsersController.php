<?php

namespace Backend;

use AdminAuthController;
use Request;
use View;
use Redirect;
use Input;
use Session;
use Validator;
use User;

class UsersController extends AdminAuthController {

	protected $layout = 'layouts.backend';


	public function showuser() { 
        $users = User::all();
        return View::make('backend.usermanagement.userlist', compact('users'));
    }
    public function userStatus($id) {
        $users = User::find($id);
        $status = Input::get('enabled');
        if ($status == 'Enable') {
            $users['activated'] = 1;
        } elseif ($status == 'Disable') {
            $users['activated'] = 0;
        }
        $users->save();
        return Redirect::back();
    }
    public function destroyuser($id) {
        User::destroy($id);
        return Redirect::back();
    }

}