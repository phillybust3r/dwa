<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

	<head>
		<title></title>
		
		<?php
			$boxes = "";
		
			for ($i = 1; $i <= 10; $i++) {
				// echo $i;
				$boxes .= "<div style='width:50px; height:50px; background-color:red; padding:4px; float:left;'</div>";

			}
		?>
		
	</head>
	<body>
		<?=$boxes?>
	</body>
</html>