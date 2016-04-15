<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $fillable = ['email', 'password', 'username','activated'];
    protected $hidden = array('password', 'remember_token');
    public static $change_password_rules = array(
        'email' => 'required|email',
        'password' => 'required|min:6',
        'confirm-password' => 'required_with:password|same:password'
    );
    public static $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'username' => 'required'
    );
    public static $password_rules = array(
        'email' => 'required|email',
        'password' => 'required|min:6',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required_with:new_password|same:new_password'
    );
    protected $hashableAttributes = array(
        'persist_code',
    );

    public function coupon_code() {
        return $this->hasMany('CouponCode');
    }

}
