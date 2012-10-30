<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

	<head>
		<title></title>
		<?php
			$square = 4 * 4;
			
			// this is a comment
			# this is also a comment
			$name = "Phil";
			
			# int
			$age = 35;
			
			# float
			$weight = 155;
			
			# boolean
			$logged_in = FALSE;
			
			$quarter = .25;
			$dime    = .10;
			$nickle  = 0.5;
			
			$total = (4 * $quarter) + (5 * dime) + (3 * $nickle);
		?>
		
	</head>
	
	<body>
	
		Total change: <?=$total?>
		
		The square of 4 is <?=$square?>


	</body>
</html>