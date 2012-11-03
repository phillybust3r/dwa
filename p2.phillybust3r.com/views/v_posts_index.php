<?php include 'v_header.php'; ?>

<link rel="stylesheet" href="../css/allposts.css" type="text/css"/> 

<? foreach($posts as $key => $post): ?>
<div id='postwrapper'>

	<?=$post['first_name']?> said:
	<?=$post['content']?>
	
	<br><br>
</div>
<? endforeach; ?>