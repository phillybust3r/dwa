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
			FROM users WHERE email <> '".$this->user->email."'";
		
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		# Figure out the connections
		$q = "SELECT * 
			FROM users_users 
			WHERE user_id = ".$this->user->user_id;
		
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
		
		#echo Debug::dump($connections,"connections");
		
	
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
	
		# the posts are part of the user profile
		Router::redirect('/users/profile');	
	}
	
	public function p_add() {
		
		$post['post_created']  = Time::now();
		$post['modified'] = Time::now();
		$post['user_id']  = $this->user->user_id;
		$post['content'] = $_POST['content'];
		
		DB::instance(DB_NAME)->insert('posts', $post);
		
		
		
		# now split the content by spaces
		$post_array = split(' ', $_POST['content']);

		foreach( $post_array as $key => $value){
			
			# now check if there is a #hashtag
			if ($value[0] == '#') {
			
				# remove the leading # (this is assuming hashtags only have 1 #
				$hashtag_val = substr($value, 1);
			
				$hashtag['count'] = 1;
				$hashtag['hashtag'] = $hashtag_val;
			
				# look for the hashtag in the database
				$q = "SELECT hashtag_id, count 
					FROM hashtags 
					WHERE hashtag = '".$hashtag_val."'";
										
				$hashtag_found = DB::instance(DB_NAME)->select_row($q);
				
				
				if (!$hashtag_found) {
					
					#insert the hashtag into the database
					DB::instance(DB_NAME)->insert('hashtags', $hashtag);
				}
				else {
				
					# update the count	
					$count['count'] = $hashtag_found['count'] + 1;
					
					$where_condition = "WHERE hashtag_id =".$hashtag_found['hashtag_id'];
					
					DB::instance(DB_NAME)->update('hashtags', $count, $where_condition);

					
				}
				
				#retrieve the post we just saved - we need the post_id to associate
				# it with the trends
				$q = "SELECT post_id 
					FROM posts 
					WHERE post_created = ".$post['post_created']." AND user_id = ".$post['user_id'];
				$post_id = DB::instance(DB_NAME)->select_row($q);
				
				$trend_post['post_id'] = $post_id['post_id'];
				$trend_post['hashtag'] = $hashtag_val;
				
				
				#insert the trend post into the database
				DB::instance(DB_NAME)->insert('trends_post', $trend_post);

			}
			
		}
		
		
		# the posts are part of the profile, so redirect there
		Router::redirect("/users/profile");
		
	}
	
	public function p_trends($hashtag = NULL) {
				
		# retrieve the posts with the hashtag
		$q = "SELECT * FROM trends_post WHERE hashtag = '".$hashtag."'";
						
		$hashtags = DB::instance(DB_NAME)->select_rows($q);
	
	}
	
	public function trends($hashtag = NULL) {
	
		if (!$hashtag) {
	
	  		# the trends are part of the profile, so redirect there
			Router::redirect("/users/profile");
		}
		else {
			# retrieve the posts with the hashtag
			$q = "SELECT * FROM trends_post WHERE hashtag = '".$hashtag."'";
						
			$hashtags = DB::instance(DB_NAME)->select_rows($q);
			print_r($hashtags);
			
			# Set up the view
			$this->template->content = View::instance("v_trends");
			$this->template->content->hashtags = $hashtags;
		
			# Render the view
			echo $this->template;
	
		
		}

	
	}





}