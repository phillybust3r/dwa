<? include 'v_header.php'; ?>

<script type="text/javascript" language="JavaScript">
<!--
function popWindow(wName){
	features = 'width=400,height=400,toolbar=no,location=no,directories=no,menubar=no,scrollbars=no,copyhistory=no,resizable=no';
	pop = window.open('',wName,features);
	if(pop.focus){ pop.focus(); }
	return true;
}
-->
</script>

<form action="../views/v_stalker_profile.php" method="post" target="Details" onSubmit="return popWindow(this.target)">
	<input type="hidden" name ="age" value="23 years old">
	<input type="hidden" name="experience" value="expert">
	<input type="submit" value="John">
</form>


<!--? print_r($stalkers)?-->

<br><br><br>
<?php foreach($stalkers as $key => $post): ?>

	
	<?=$post['first_name'] ?> is following you.
	<? $user_id = $post['user_id'] ?>
	
	<form method='POST' action='/users/p_stalkers'>
		<input type=hidden name='user_id' value=<?=$user_id?> >	
		<input type='Submit' value = 'Profile'>
	</form>
	<br>
<? endforeach; ?>


<?php foreach($stalkers as $key => $post): ?>

	
	<?=$post['first_name'] ?> is following you.
	<? $user_id = $post['user_id'] ?>
	
	<form method='POST' action='/users/p_stalkers'>
		<input type=hidden name='user_id' value=<?=$user_id?> >	
		<input type='Submit' value = 'Profile'>
	</form>
	<br>
<? endforeach; ?>

	