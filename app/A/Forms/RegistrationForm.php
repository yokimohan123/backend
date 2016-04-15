<?php namespace A\Forms;

use Laracasts\Validation\FormValidator;
class RegistrationForm extends FormValidator
{

	protected $rules = array(
		'select' => 'required',
		'firstname' => 'required',
		'surname'	=> 'required',
		'company' => 'required',
		'email' => 'required|unique:register',
		'password' => 'required',
		'confirmpassword' => 'required',
		'country' => 'required',
		'registerCheckbox' => 'required'
			); 
}