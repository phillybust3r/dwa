<?php include 'v_header.php'; ?>

<link rel="stylesheet" href="../css/allposts.css" type="text/css"/> 

<h1>People you @Stalk</h1>
<body>

<? foreach($posts as $key => $post): ?>
<div id='postwrapper2'>

	<?=$post['first_name']?> said:
	<?=$post['content']?>
	
	<br><br>
</div>
<? endforeach; ?>

</body>