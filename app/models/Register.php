<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Register extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'register';
	protected $fillable = ['firstname','lastname','email','password','password_confirmation','country','registerCheckbox','group','discount','billing_address','billing_city','zip_code','bday','gender'];

	public static $rules = array(
		'firstname' => 'required',
		'lastname'	=> 'required', 
        'phone_number' => 'required',
		'password'  =>'Required|AlphaNum|Between:4,15|Confirmed',
        'password_confirmation'=>'Required|AlphaNum|Between:4,15',
		'country' => 'required',
		// 'registerCheckbox' => 'required',
		'billing_address' => 'required',
		'billing_city'=> 'required',
		'zip_code'=>'required',
		'bday' => 'required',
		'gender'=>'required',
		'email' 	=> 'required | email | unique:register'
		);

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	
	public static $loginrules = array(
		'email' => 'required',
		'password' => 'required'
	);

	public static $change_password_rules = array(
		'email' => 'required|email'
	); 

	public static $discountrules = array(
		'discount' => 'required|integer|min:0'
	);

}