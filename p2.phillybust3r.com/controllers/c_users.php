<?php

class users_controller extends base_controller {

	
	public function __construct() {
		parent::__construct();
	}


	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function signup() {
		
		# Set up template
		$this->template->content = View::instance("v_users_signup");
		
		# Render the template
		echo $this->template;
		
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function p_signup() {
	
		# What data was submitted
		#print_r($_POST);
		
		# Encrypt password
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		# Create and encrypt token
		$_POST['token']    = sha1(TOKEN_SALT.$_POST['email']);
		
		# Store current timestamp 
		$_POST['created']  = Time::now(); # This returns the current timestamp
		$_POST['modified'] = Time::now();
		
		# Search the db for this email
        $q = "SELECT email 
              FROM users 
              WHERE email = '".$_POST['email']."'";
        
        $email = DB::instance(DB_NAME)->select_field($q);       
                
        # only insert people that do not have existing accounts
        if ($email == "") {
        	                                        
        	# Insert this user into the database 
            DB::instance(DB_NAME)->insert('users', $_POST);
        
        }
		
		
		
		echo "You're registered! Now go <a href='/'>login</a>";
		
		Router::redirect("/");
	
		# Load the template
		#$this->template->content = View::instance("v_users_login");
		
		# Render the template
		#echo $this->template;

	
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function login() {
	
		# Load the template
		$this->template->content = View::instance("v_users_login");
		
		# Render the template
		echo $this->template;
		
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function p_login() {
	
		# Prevent SQL injection attacks
		#$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
	
		# Encrypt the password		
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
			
		# Look for a matching email and password in the DB - retrieve token if we find it		
		$q = "SELECT token
			FROM users
			WHERE email = '".$_POST['email']."'
			AND password = '".$_POST['password']."'
			";
				
		$token = DB::instance(DB_NAME)->select_field($q);
		
		# Login failed
		if($token == "") {
			print_r("FAIL");
			Router::redirect("/");
		}
		# Login passed
		else {
			
			setcookie("token", $token, strtotime('+2 weeks'), '/');
						
			Router::redirect("/");
		

		}
	
	}
	
	
	
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function logout() {
	
		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email);
		
		# Create the data array we'll use with the update method
		# In this case, we're only updating one field, so our array only has one entry
		$data = Array("token" => $new_token);
		
		# Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
		
		# Delete their token cookie - effectively logging them out
		setcookie("token", "", strtotime('-1 year'), '/');
		
		Router::redirect("/index");
		
	}

	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function profile($user_name = NULL) {
	
		
		
		# Not logged in
		if(!$this->user) {
			echo "Members only. <a href='/'>Please login.</a>";
			return;
		}
		
		# retrieve the user name
		$user_name = $this->user->first_name;
						
		# Logged in	
		if($user_name == NULL) {
			echo "You did not specify a user";
		} else {
		
		
		
		
			# Setup the view
			$this->template->content = View::instance("v_users_profile");
			$this->template->title   = "Profile for ".$user_name;
						
			# Don't need to pass any variables to the view because all we need is $user and that's already set globally in c_base.php
			
			# this only retrieves the user posts
			$q = "SELECT *
				FROM users_users";
			
			$posts = DB::instance(DB_NAME)->select_rows($q);
		
			print_r($posts);
		 
			# Pass data to the view
			#$this->template->content->posts = $posts;
		
							
			# Render the view
			echo $this->template;

		}	
	}

}