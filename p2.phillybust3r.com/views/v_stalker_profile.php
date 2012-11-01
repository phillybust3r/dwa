<?php 
echo '<pre>'; 
var_dump($_POST); 
	
	
	$q = "SELECT * from FROM users where user_id =".$_POST['user_id'];
	
	$user_post = DB::instance(DB_NAME)->select_rows($q);
				
	echo $user_post;
	
	echo "IM HERE";
	
	echo $posts;		
	
echo '</pre>'; 
?>