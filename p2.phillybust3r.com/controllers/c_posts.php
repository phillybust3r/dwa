<?php

class posts_controller extends base_controller {

	public function __construct() {
		
		parent::__construct();
		
		if(!$this->user) {
			die("Members only. <a href='/'>Please login</a>");
		}
	
	}
	
	public function index() {
	
		# Set up the view
		$this->template->content = View::instance("v_posts_index");
		$this->template->title   = "All the posts";
	
		#$q = "SELECT *
		#	FROM posts
		#	JOIN users USING(user_id)";
	
		$user_id = $this->user->user_id;
	
		# this only retrieves the user posts
		$q = "SELECT *
			FROM posts
			JOIN users USING(user_id) where user_id = ".$user_id." ORDER by post_created DESC";
			
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
	
		$where_condition = "WHERE user_id_followed =".$user_id_followed." AND user_id=".$this->user->user_id;	
	
		DB::instance(DB_NAME)->delete("users_users", $where_condition);
		
		Router::redirect("/posts/users");

	}
	
	
	public function add() {
	
		# Set up the view
		$this->template->content = View::instance("v_posts_add");
		$this->template->title = "Add a new post";
		
		# Render the view
		echo $this->template;
	
	}
	
	public function p_add() {			
		
		$post['post_created']  = Time::now();
		$post['modified'] = Time::now();
		$post['user_id']  = $this->user->user_id;
		$post['content'] = $_POST['content'];
		
		DB::instance(DB_NAME)->insert('posts', $post);
		
		Router::redirect("/users/profile");
	
	}
	
	public function connections() {
	
		$q = "SELECT *
			from users_users 
			JOIN users USING(user_id) where user_id_followed = ".$this->user->user_id;
	
		
		# retrieve the users that are following you 
		$stalkers = DB::instance(DB_NAME)->select_rows($q);
		
		print_r("IM HERE");
		
		print_r($stalkers);
		
		#$q = "SELECT * from posts 
	#		JOIN users USING(user_id) where user_id = ".$_POST['user_id'];
	
	
	#	$posts = DB::instance(DB_NAME)->select_field($q);
					
		# Set up the view
		$this->template->content = View::instance("v_connections");
		$this->template->title = "Connections";
		
		# Pass data to the view
		$this->template->content->stalkers = $stalkers;
	
	#	$this->template->content->posts = $posts;
		
		# Render the view
		echo $this->template;
	
	
	}
	
	
	



}