<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

	<head>
		<title></title>
		
		<?php
	
			// comment
			# comment
			/* comment
			*/
			
			// concatenate is var1 . var2
		
			# hardcoded
			$age = 100;
			
			$person_type = "";
			
			if ($age <= 12) {
				$person_type = "Kiddo";	
			}
			elseif ($age <= 19) {
				$person_type = "Teenager";	
			}
			elseif ($age <= 80) {
				$person_type = "Adult";	
			}
			else {
				$person_type = "Super wise person";	
			}
			
		?>
		
	</head>
	<body>
	
		<!-
			Add @ to suppress errors
			The person is a <?=@$person_type?>
		-->

		The person is a <?=$person_type?>


	</body>
</html>