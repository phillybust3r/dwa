<?php

class posts_controller extends base_controller {

	public function __construct() {
		
		parent::__construct();
		
		if(!$this->user) {
			die("Members only. <a href='/users/login'>Please login</a>");
		}
	
	}
	
	public function index() {
	
		# Set up the view
		$this->template->content = View::instance("v_posts_index");
		$this->template->title   = "All the posts";
	
		$q = "SELECT *
			FROM posts
			JOIN users USING(user_id)";
			
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		#print_r($posts);
		 
		# Pass data to the view
		$this->template->content->posts = $posts;
			
		# Render the view
		echo $this->template;
	
	}
	
	public function users() {
	
		# Set up the view
		$this->template->content = View::instance("v_posts_users");
		
		# Grab all the users
		$q = "SELECT * 
			FROM users";
		
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		# Pass data to the view
		$this->template->content->users = $users;
		
		# Render the view
		echo $this->template;
	
	}
	
	
	public function follow($user_id_followed = NULL) {
	
		$data['created'] = Time::now();
		$data['user_id'] = $this->user->user_id;
		$data['user_id_followed'] = $user_id_followed;
		
		DB::instance(DB_NAME)->insert("users_users", $data);
	
		Router::redirect("/posts/users");
	
	}
	
	public function unfollow($user_id_followed = NULL) {
	
		
	
	}
	
	
	public function add() {
	
		# Set up the view
		#$this->template->content = View::instance("v_posts_add");
		#$this->template->title = "Add a new post";
		
		
		$this->template->content = View::instance("v_posts_index");
		$this->template->title = "Welcome to Blabbr";
		
		# Render the view
		echo $this->template;
	
	}
	
	public function p_add() {
	
		#print_r($_POST);
		
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		$_POST['user_id']  = $this->user->user_id;
		
		DB::instance(DB_NAME)->insert('posts', $_POST);
		
		echo "Your post has been added. <a href='/posts/add'>Add another</a>";
	
	}




}