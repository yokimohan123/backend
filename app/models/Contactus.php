<?php


class Contactus extends Eloquent {
   
    protected $fillable = ['id','first_name','last_name','email','phone_number','subject','message'];
    
    protected $table = 'contactus';
    
    // model function to store form data to database
    public static function saveFormData($data)
    {
        DB::table('contactus')->insert($data);
    }

    public static $contact = array(        
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'phone_number'=>'required|numeric',   
        'subject' =>'required',
        'message' => 'required'
    );
    
}