<!DOCTYPE html>
<html>
<head>

	<title>Blabbr sign up!</title>
	<meta name="description" content="This Problem Set 2 for CSCIE 75">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	
	<style type="text/css">
		
		body {
  			background-color: #e1ddd9;
  			font-size: 12px;
  			font-family: Verdana, Arial, Helvetica, SunSans-Regular, Sans-Serif;
  			background-color: #477fb8;
		  	margin: 20px 140px  20px 140px;
  			text-align: center;
		}

		#content { 
  			width: 100%;
  			padding: 0px;
  			text-align: left;
  			background-color: #fff;	
  			overflow: auto;
		}
		
		#form {
  			text-align: left;

		}

	</style>
	
</head>

<body>


	<form method='POST' action='/users/p_signup'>

		First Name:<br>
		<input type='text' name='first_name'>
		<br><br>
	
		Last Name:<br>
		<input type='text' name='last_name'>
		<br><br>
		
		Birthday:<br> <input type="date" name="bday">
		<br><br>
		
		Email:<br>
		<input type='text' name='email'>
		<br><br>
	
		Password:<br>
		<input type='password' name='password'>
		<br><br>
		
		
	
		<input type='submit'>

	</form> 
</body>
