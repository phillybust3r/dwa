<?php include 'v_header.php'; ?>

<link rel="stylesheet" href="../css/postusers.css" type="text/css"/> 


<? foreach($users as $key => $user): ?>

	<div id='postwrapper'>

	<?=$user['first_name']?> <?=$user['last_name']?>
	
	<? $user_id = $user['user_id'] ?>
	
	<form action="demo_form.asp" method="get">

	
	<? if(isset($connections[$user_id])): ?>	
		<button type="submit" formaction='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</button>
	<? else: ?>
		<button type="submit" formaction='/posts/follow/<?=$user['user_id']?>'>Follow</button>

	<? endif; ?>

	<br>
	</form>
	</div>
	
<? endforeach; ?>