<body>	

	<div id='menu'>
	
		<!-- Menu for users who are logged in -->
		<? if($user): ?>
			
			<a href='/users/logout'>Logout</a>
			<a href='/posts/users/'>Change who you're following</a>
			<a href='/posts/'>View posts</a>
			<a href='/posts/add'>Add a new post</a>
		
		<!-- Menu options for users who are not logged in -->	
		<? else: ?>
		
			<a href='/users/signup'>Sign up</a>
			<a href='/users/login'>Log in</a>
			<a href='/index'>Index</a>

		<? endif; ?>
	
	</div>
	
	<br>

	<?=$content;?> 

</body>