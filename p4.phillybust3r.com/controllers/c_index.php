<?php

class index_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	/*-------------------------------------------------------------------------------------------------
	Access via http://yourapp.com/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
	
		# retrieve the android articles
		$q = "SELECT *
			FROM articles";
			
		$articles = DB::instance(DB_NAME)->select_rows($q);
	
			
		print_r($articles);
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
			$this->template->title = "Welcome to Blendr!";
	
		# If this view needs any JS or CSS files, add their paths to this array so they will get loaded in the head
			$client_files = Array(
						""
	                    );
	    
	    $this->template->client_files = Utils::load_client_files($client_files);   
	    
		# open the file
		$file=fopen("articles/android/12.14.12/1/1.txt","r") or exit("Unable to open filesss!");
		
		print_r(fgets($file));
				print_r(fgets($file));
		print_r(fgets($file));
		print_r(fgets($file));
		print_r(fgets($file));
		print_r(fgets($file));
		print_r(fgets($file));
		print_r(fgets($file));
		print_r(fgets($file));
		print_r(fgets($file));

		  	
		# Pass data to the view
		$this->template->content->posts = $articles;
		
		
		# Render the view
		echo $this->template;

	}
	
	
	
		
} // end class
