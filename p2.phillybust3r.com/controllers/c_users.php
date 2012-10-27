<?php

class users_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		echo "users_controller construct called<br><br>";
	} 
	
	public function index() {
		echo "Welcome to the users's department";
	}
	
	public function signup() {
		echo "This is the signup page";
		# Setup view
			$this->template->content = View::instance('v_users_signup');
			$this->template->title   = "Signup";
			
		# Render template
			echo $this->template;
	}
	
	public function p_signup() {
		
		# Dump out the results of POST to see what the form submitted
		print_r($_POST);
	
		# Encrypt the password	
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);	
	
		# More data we want stored with the user	
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email']);	
		
	
		# Search the db for this email and password
		# Retrieve the token if it's available
		$q = "SELECT email 
			FROM users 
			WHERE email = '".$_POST['email']."'";
	
		$email = DB::instance(DB_NAME)->select_field($q);	
		
		# only insert people that do not have existing accounts
		if ($email != "") {
		
			print_r("EMAIL FOUND, PLEASE LOGIN INSTEAD");
		}
		else {
		
			print_r($email); 
						
			# Insert this user into the database 
			DB::instance(DB_NAME)->insert('users', $_POST);
		
	
		}
		
		# Send them to the posts page
		Router::redirect("/users/login");
			
		
		


	}
	
	
	public function p_login() {

		echo "IM HERE";
		

	
		# Hash submitted password so we can compare it against one in the db
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	
		# Search the db for this email and password
		# Retrieve the token if it's available
		$q = "SELECT token 
			FROM users 
			WHERE email = '".$_POST['email']."' 
			AND password = '".$_POST['password']."'";
	
		$token = DB::instance(DB_NAME)->select_field($q);	
				
		# If we didn't get a token back, login failed
		if(!$token) {
			
			# Send them back to the login page
			Router::redirect("/users/login/");
		
		# But if we did, login succeeded! 
		} else {

			# Store this token in a cookie
			@setcookie("token", $new_token, strtotime('+1 year'), '/');

		
			# Send them to the main page - or whever you want them to go
			Router::redirect("/");
					
		}

	}	
	
	public function login() {
		echo "This is the login page";
		
		# Setup view
		$this->template->content = View::instance('v_users_login');
		$this->template->title   = "Login";
		
	# Render template
		echo $this->template;	}
	
	public function logout() {
		echo "This is the logout page";
	}
	
	public function profile($user_name = NULL) {
		
		# If user is blank, they're not logged in, show message and don't do anything else
		if(!$this->user) {
			echo "Members only. <a href='/users/login'>Login</a>";
		
			# Return will force this method to exit here so the rest of 
			# the code won't be executed and the profile view won't be displayed.
			return false;
		}
	
		# Setup view
		$this->template->content = View::instance('v_users_profile');
		$this->template->title   = "Profile of".$this->user->first_name;
		
		# Render template
		echo $this->template;	}

} # end of the class
