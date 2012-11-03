<link rel="stylesheet" href="../css/global.css" type="text/css"/> 


<body>

<? if(!$user): ?>

	<font size="1" face="arial, helvetica, sans-serif"> 
		
		<div class='column' id='left'>
		<img src='/images/blabbrlogo.png' alt='Blabbr'><br>
		</div>
	
		<div class='column' id='right'>
			<a href="/users/login"><img border="0" src="/images/login_button.png" alt="JOIN" ></a>	
		</div>
		
		<br><br><br>
		
		
		<div class='column' id='right'>
			<a href="/users/signup"><img border="0" src="/images/join_button.png" alt="JOIN" ></a>
		</div>
		
		</font>
	
<? else: ?>
	
	<? Router::redirect("/users/profile"); ?>

<? endif; ?>

</body>