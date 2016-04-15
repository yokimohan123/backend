<?php
namespace Frontend;

use FrontOfficeController;
use view;
use Register;
use Hash;
use URL;
use Auth;
use Mail;
use Session;
use Sentry;
use Validator;
use Input;
use Redirect;
use Block;
use DB;
use ContactTitle;
use Cookie;

class AuthController extends FrontOfficeController {
	protected $layout = 'layouts.auth';
	protected $registerForm;

	public function index()
	{
		return View::make('frontend.auth.login');

	}
	public function getRegister()
	{
		return View::make('frontend.auth.register');

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /auth/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /auth
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();		

		$validator = Validator::make($data = Input::all(), Register::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

		$code = str_random(60);
		$user = new Register;
		$user->firstname = $input['firstname'];
		$user->lastname	= $input['lastname'];
		$user->billing_address	= $input['billing_address'];
		$user->billing_city	= $input['billing_city'];
		$user->zip_code	= $input['zip_code'];
        $user->phone_number = $input['phone_number'];
		$user->email = $input['email'];
		$user->password = Hash::make($input['password']); 
		$user->country = $input['country'];
		$user->bday = $input['bday'];
		$user->gender = $input['gender'];
		// $user->registerCheckbox = $input['registerCheckbox'];				
		$user->activated = 0;
		$user->activation_code = $code;
		$user->reset_password_code = ' ';		
		$user->save();

		$data = array( 
			'firstname' => $input['firstname'],
			'link' => URL::route('activate',$code)
			);

		Mail::send('emails.auth.register', $data, function($message) use ($input){
			$block = Block::all();
            $block = Block::where('slug', 'LIKE', '%general_admin_email%')->get($block[0]['link']);
            //email 'To' field: change this to emails that you want to be notified.                    
            $message->from($block[0]['link'])
                    ->to($input['email'], $input['firstname'])
                    ->cc($block[0]['link'])
                    ->replyTo($block[0]['link'])
                    ->subject('User Activation');
		});
		if (Session::has('checkout_register')) {
			Session::put('user_session', $user);
			return Redirect::route('user.address');
		}else{
			return Redirect::back()->withFlashMessage("Check your mail to activate your account");
		}
	}
}

	public function profileActivate($code)
	{
		$user = Register::where('activation_code','=',$code)->first();
		if(count($user) > 0) {
			$user->activated = 1;
			$user->activation_code = ' ';
			$user->save();
			return Redirect::to('login')->withFlashMessage("You registration got activated, now enter your credentials to login");
		} else {
			return Redirect::to('login')->withFlashMessage("Your account has already been activated, please log in.");
		}
	}

	public function login()
	{

		$input = Input::all();
		$validator = Validator::make($data = Input::all(), Register::$loginrules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
        	$user = array(
		           'email' => Input::get('email'),
		           'password' => Input::get('password'),
		           'activated' => 1
	      		);
   //      	var_dump($user);
			// $attempt = Auth::attempt($user);
			// var_dump($attempt);
			$results = DB::select( DB::raw("SELECT * FROM register WHERE email = '".$user['email']."' AND activated ='1' ") );
			foreach ($results as $value) {
				# code...
				$password = $value->password;
			}
			if(!empty($results)){
				if (Hash::check($user['password'], $password)){
					$user = Register::where('email', '=', $input['email'])->first()->toArray();
					Session::put('user_session', $user);
					if (Session::has('current_url')){
						$current_url=Session::get('current_url');                                                
						return Redirect::to($current_url);
					}elseif(Session::has('wishlist_url')){
                        $wishlistUrl = Session::get('wishlist_url');
                        return Redirect::to($wishlistUrl);
                    }elseif (Session::has('checkout_login')) {
                    	return Redirect::route('user.address');
                    }
                    else{
                        return Redirect::to('myalter');
					}
				}
				else
				{
					return Redirect::back()->withFlashMessage1("Please register first!!");
				}
			}
			else{
				return Redirect::back()->withFlashMessage("Please register first!!");
			}
		}

	}

	public function logout(){
		$cookie = Cookie::forget('qty');
		Sentry::logout();
		Session::flush();
        return Redirect::route('frontend.index')->withCookie($cookie);; 
	}


	public function forget()
	{
		return View::make('frontend.auth.forget');
	}

	public function reset()
	{
		$email = Input::only('email');
		$mailExist = Register::where('email','=',$email)->first();
		if (is_null($mailExist)) {
			return Redirect::back()->withFlashMessage("The mail doesn't exist!!!");
		}
		else
		{
			$code = str_random(60);
			$mailExist->reset_password_code = $code;
			$mailExist->activated = 0;
			$mailExist->save();
			
			$data = array(
				'firstname' => $mailExist->firstname,
				'link' => URL::route('reset',$code)
				);

			Mail::send('emails.auth.reset', $data, function($message) use ($mailExist){
			// $message->from("info@alterlondon.com","info@alterlondon.com");
			$block = Block::all();
            $block = Block::where('slug', 'LIKE', '%general_admin_email%')->get($block[0]['link']);

            //email 'To' field: change this to emails that you want to be notified.                    
            $message->from($block[0]['link'])
                    ->to($mailExist->email, $mailExist->firstname)
                    ->cc($block[0]['link'])
                    ->replyTo($block[0]['link'])
                    ->subject('Reset your password');
			});	

			return Redirect::back()->withFlashMessage("Check the mail to reset your password");
		}
	}

	/**
	 * Display the specified resource.
	 * GET /auth/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($code)
	{
		$user = Register::where('reset_password_code','=',$code)->first();
		$user->activated = 1;
		//$user->reset_password_code = ' ';
		$user->save();
		return View::make('frontend.auth.changePassword',compact('code'));
	}


	public function changePassword()
	{
		$input = Input::all();
		$validator = Validator::make($data = Input::all(), Register::$change_password_rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
        	$user = Register::where('reset_password_code','=',$input['code'])->first();
			//$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->reset_password_code = ' ';
			$user->save();
			return Redirect::to('/frontend/login')->withFlashMessage("Login with your new credentials");
		}
		
	} 

	/**
	 * Show the form for editing the specified resource.
	 * GET /auth/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /auth/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /auth/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
      

}