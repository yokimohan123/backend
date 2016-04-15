<?php namespace A\Forms;

use Laracasts\Validation\FormValidator;
class LoginForm extends FormValidator
{

	protected $rules = array(
		'email' => 'required',
		'password' => 'required',
		); 
}