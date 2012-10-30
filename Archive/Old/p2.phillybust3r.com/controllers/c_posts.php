<?php

class posts_controller extends base_controller {
	
	public function __construct() {
	
		parent::__construct();
		
		
		if (!$this->user) {
			
			die("Members only.  <a href='/users/login'> Please login </a>");
		
		}
	
	}
	
	public function index() {
	
		echo "POSTS PAGE";
	
		$this->template->content = View::instance("v_posts_index");
		$his->template->title = "All the posts";
		$q = "SELECT * from posts JOIN users USING(user_id)";
		
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		print_r($posts);
		
		# pass data to the post
		$this->template->content->posts = $posts;
		
		echo $this->template;
	
	}

	public function __add() {
	
		# set up the view
		$this->template->content = View::instance("v_posts_add");
		$this->template->title = "Add a new post";
		
		# render the view
		echo $this->template;
	}
	
	
	public function p_add() {
	
		print_r($POST);
		
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();
		$_POST['user_id'] = $this->user->user_id;
	
	}
	

	public function users() {

		# Set up the view
		$this->template->content = View::instance("v_posts_users");
		$this->template->title   = "Users";

		# Build our query to get all the users
		$q = "SELECT *
			FROM users";
		
		# Execute the query to get all the users. Store the result array in the variable $users
		$users = DB::instance(DB_NAME)->select_rows($q);
	
		# Build our query to figure out what connections does this user already have? I.e. who are they following
		$q = "SELECT * 
			FROM users_users
			WHERE user_id = ".$this->user->user_id;
		
		# Execute this query with the select_array method
		# select_array will return our results in an array and use the "users_id_followed" field as the index.
		# This will come in handy when we get to the view
		# Store our results (an array) in the variable $connections
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
			
		# Pass data (users and connections) to the view
		$this->template->content->users       = $users;
		$this->template->content->connections = $connections;

		# Render the view
		echo $this->template;
}

}