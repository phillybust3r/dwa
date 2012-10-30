

<style type='text/css'>
	

	
	
		h1 {
			text-align:center;
			text-decoration:none;
		}
	
		body { 
			background: url("images/background.png")
			
		}
		
		.left {
			width:420px;
		}
		
		.right {
			width:420px;
		}
		
		
		#left {
			float:left;
		}
		
		#right {
			float:right;
		}
		
		#footer {
			clear:both;
		}
		
</style>

<body>

<? if(!$user): ?>
	<br><br><br>

	<font size="1" face="arial, helvetica, sans-serif"> 
		
		<div class='column' id='left'>
		<img src='images/blabbrlogo.png' alt='Blabbr'><br>
		</div>
	
		<div class='column' id='left'>
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

			<input type='text' name='first_name' placeholder = "FIRST NAME">
			<br>
			<input type='text' name='last_name' placeholder="LAST NAME">
			<br>
			<input type='text' name='email' placeholder="EMAIL">
			<br>
			<input type='password' name='password' placeholder="PASSWORD">
			<br>
			<input type='submit' value='Submit'>
	
		</form>

		</div>
		
		</font>
	
<? else: ?>
	
	
	<!--Welcome back --><!--?=$user>first_name?--><br>

	<? Router::redirect("/users/profile"); ?>

<? endif; ?>

</body>