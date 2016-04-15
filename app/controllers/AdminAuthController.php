
<?php

class AdminAuthController extends \BaseController {

    /**
     * Display the login page
     * @return View
     */
    public function __construct(){
	$this->beforeFilter('acl');
    }
	
    
}