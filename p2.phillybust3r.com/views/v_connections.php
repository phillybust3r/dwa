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

<br><br><br>




<!--? print_r($stalkers)?-->

<br><br><br>
<?php foreach($stalkers as $key => $post): ?>

	<?=$post['first_name'] ?> is following you.
	<? $user_id = $post['user_id'] ?>

	<form action="../views/v_stalker_profile.php" method="post" target="Details" onSubmit="return 	popWindow(this.target)">
		<input type="hidden" name ="user_id" value=<?=$user_id?> >
		<input type="submit" value="Profile">
	</form>
		
	<br>
<? endforeach; ?>


	