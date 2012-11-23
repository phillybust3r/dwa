<?php

class scratch_controller extends base_controller {

	
	public function __construct() {
		parent::__construct();
	}
	
	public function redirect_test() {
				
		echo "You're signed up";
        
        sleep(2);
        
        header('location: /users/login');	
	}



}