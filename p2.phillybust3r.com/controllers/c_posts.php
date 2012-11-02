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
	
		# Figure out the connections
		$q = "SELECT *
			FROM users_users
			WHERE user_id = ".$this->user->user_id;
				
		$connections = DB::instance(DB_NAME)->select_rows($q);
		
		$connections_string = "";
		
		foreach($connections as $k => $v) {
			$connections_string .= $v['user_id_followed'].",";
		}
		
		# Trim off the last comma
			$connections_string = substr($connections_string, 0, -1);
		
		# Grab all the posts
		$q = "SELECT *
			FROM posts
			JOIN users USING(user_id)
			WHERE posts.user_id IN (".$connections_string.")";
					
		$posts = DB::instance(DB_NAME)->select_rows($q);
		 
		# Pass data to the view
		$this->template->content->posts = $posts;
			
		# Render the view
		echo $this->template;
	
	}
	

	/*-------------------------------------------------------------------------------------------------
	This method exists just for testing. It's the same as above (index), but is testing out a different
	query method.
	See: http://forum.susanbuck.net/discussion/160/sql-query-with-multiple-tables
	-------------------------------------------------------------------------------------------------*/
	public function index2() {
		
		# Set up the view
		$this->template->content = View::instance("v_posts_index");
		$this->template->title   = "All the posts";
	
		$q = "SELECT posts.*, users.first_name, users.last_name
				FROM posts
				LEFT JOIN users 
					ON posts.user_id = users.user_id
				LEFT JOIN users_users
					ON users.user_id = users_users.user_id_followed
				WHERE users_users.user_id = ".$this->user->user_id;
								
		$posts = DB::instance(DB_NAME)->select_rows($q);
		 
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
		
		# Figure out the connections
		$q = "SELECT * 
			FROM users_users 
			WHERE user_id = ".$this->user->user_id;
		
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
		
		echo Debug::dump($connections,"connections");
		
	
		# Pass data to the view
		$this->template->content->connections = $connections;
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
	
		$where_condition = "WHERE user_id_followed =".$user_id_followed." 
							AND user_id= ".$this->user->user_id;
	
		DB::instance(DB_NAME)->delete("users_users", $where_condition);
		
		Router::redirect('/posts/users');
		
	
	}
	
	
	public function add() {
	
		# Set up the view
		$this->template->content = View::instance("v_posts_add");
		$this->template->title = "Add a new post";
		
		# Render the view
		echo $this->template;
	
	}
	
	public function p_add() {
	
		//print_r($_POST);
		
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		$_POST['user_id']  = $this->user->user_id;
		
		DB::instance(DB_NAME)->insert('posts', $_POST);
		
		echo "Your post has been added. <a href='/posts/add'>Add another</a>";
	
	}




}