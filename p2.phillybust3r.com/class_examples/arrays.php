<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

	<head>
		<title></title>
		<?php
			$contestants['Susan']  = "Winner";
			$contestants['Cruz']   = "Winner";
			$contestants['Vivian'] = "Loser"; 
			
			#rand has a an example where u send it the array and php counts it for you
			$winning_number = rand(1,3);
		
		?>
		
		
	</head>
	<body>
	
		
		<? foreach($contestants as $key => $winner_or_loser): ?>
			<?=$key?> is a <?=$winner_or_loser?> <p>
		<? endforeach; ?>
		

	</body>
</html>