<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

	<head>
		<title></title>
		
		
		<?php
			$company1 = "AER";
		
			// set the default timezone to use. Available since PHP 5.1
			date_default_timezone_set('EST');
				
			# functions
			function print_copyright_statement($company) {
			
				$date = date('l jS \of F Y h:i:s A');			
				return "This is the copyright for " . $company . ".<p>".$date;
				
			}
			
			$hour = date('G');
			
			if ($hour >= 20) {
				$color = "black";
			}
			else {
				$color = "blue";
			
			}	
			
		?>
		
		<style type='text/css'>
			body {
				background-color:<?=$color?>;	
			}
		</style>
		
	</head>
	<body>

		<?=print_copyright_statement($company1)?>

	</body>
</html>