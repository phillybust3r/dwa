<?php

class users_controller extends base_controller {

	
	public function __construct() {
		parent::__construct();
	}
	
	public function generate_password($password) {
				
		echo sha1(PASSWORD_SALT.$password);
	
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
		
		
		# Search the db for this email
        $q = "SELECT email 
              FROM users 
              WHERE email = '".$_POST['email']."'";
	
        
        $email = DB::instance(DB_NAME)->select_field($q);      

		# if no email was found, then this is a new account
		if (!$email) {
						
			# Search the db for this username
        	$q = "SELECT username 
            	  FROM users 
              	WHERE username = '".$_POST['username']."'";
	
        
        	$username = DB::instance(DB_NAME)->select_field($q);      
			if (!$username) {
				
				# Encrypt password
				$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
				# Create and encrypt token
				$_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		
				# Store current timestamp 
				$_POST['created']  = Time::now(); # This returns the current timestamp
				$_POST['modified'] = Time::now();
		
				# Insert 
				DB::instance(DB_NAME)->insert('users', $_POST);
	
			}
							
		}
			
		Router::redirect("/users/login");
	
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function login() {
	
		# Load the template
		$this->template->content = View::instance("v_users_login");
		
		$this->template->message = $this->message;
		
		# Render the template
		echo $this->template;
		
		# clear out the message
		$this->message = '';
		
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function p_login() {
	
		# Prevent SQL injection attacks
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
	
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
			print_r("LOGIN FAIL");
			Router::redirect("/users/login");
		}
		# Login passwed
		else {
			setcookie("token", $token, strtotime('+2 weeks'), '/');
			Router::redirect("/");
		}
	
	}
	
	
	
	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function logout() {
	
		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
		
		# Create the data array we'll use with the update method
		# In this case, we're only updating one field, so our array only has one entry
		$data = Array("token" => $new_token);
		
		# Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
		
		# Delete their token cookie - effectively logging them out
		setcookie("token", "", strtotime('-1 year'), '/');
		
		#echo "You have been logged out.";
		# Setup the view
			$this->template->content = View::instance("v_logout");
			$this->template->title   = "Logout";
			
		# Render the view
			echo $this->template;


	}

	
	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public function profile($user_name = NULL) {
		
		# Not logged in
		if(!$this->user) {
			echo "Members only. <a href='/users/login/'>Please login.</a>";
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
						
			# retrieve all the posts you made
			$q = "SELECT *
					FROM posts where user_id = ".$this->user->user_id." ORDER by post_created DESC";
			
			$posts = DB::instance(DB_NAME)->select_rows($q);
			
			# Pass data to the view
			$this->template->content->posts = $posts;		
			
			# retrieve all the trends
			$q = "SELECT hashtag
					FROM hashtags ORDER by count DESC";
								
			$trends = DB::instance(DB_NAME)->select_rows($q);
			
			# pass data to the view
			$this->template->content->trends = $trends;		
		 							
			# Render the view
				echo $this->template;

		}	
	}

}