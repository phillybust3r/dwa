
<link rel="stylesheet" href="../css/global.css" type="text/css"/> 
<style type='text/css'>
	

	

		
</style>

<body>

<? if(!$user): ?>
	<br><br><br>

	<font size="1" face="arial, helvetica, sans-serif"> 
		
		<div class='column' id='left'>
		<img src='/images/blabbrlogo.png' alt='Blabbr'><br>
		</div>
	
		<div class='column' id='right'>
		LOGIN:
		<form method='POST' action='/users/p_login'>
			<input type='text' name='email' placeholder ='EMAIL'>	
			<br>
			<input type='password' name='password' placeholder = 'PASSWORD'>
			<br>	
			<input type='Submit'>

		</form>
		
		<br><br><br>
		NEW USER:

		<form method='POST' action='/users/p_signup'>
		First
			<input type='text' name='first_name'>
			<br>
		Last
			<input type='text' name='last_name'>
			<br>
		Email
			<input type='text' name='email'>
			<br>
		Password
			<input type='password' name='password'>
			<br>
			<input type='Submit'>
	
		</form>

		</div>
		
		</font>
	
<? else: ?>
	
	
	<!--Welcome back --><!--?=$user>first_name?--><br>

	<? Router::redirect("/users/profile"); ?>

<? endif; ?>

</body>