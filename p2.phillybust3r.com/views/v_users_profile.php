<?php include 'v_header.php'; ?>


<style type="text/css">
	.boxed {
  		border: 1px solid white ;
	}
	
	body { 
		background: url("images/background.png")
	}	
</style>

<SCRIPT LANGUAGE="JavaScript">
	// function parameters are: field - the string field, count - the field for remaining characters number and max - the maximum number of characters 
function CountLeft(field, count, max) {
// if the length of the string in the input field is greater than the max value, trim it 
if (field.value.length > max)
field.value = field.value.substring(0, max);
else
// calculate the remaining characters 
count.value = max - field.value.length;
}
</script>


<body>
<br><br><br>
<form method='POST' action='/posts/p_add'>
	
	<font size="1" face="arial, helvetica, sans-serif"> 
		<h2>Add a post</h2>
		<input name="content" type="text" size="40"
		onKeyDown="CountLeft(this.form.content,this.form.left,140);" 
		onKeyUp="CountLeft(this.form.content,this.form.left,140);">
		<input readonly type="text" name="left" size=3 maxlength=3 value="140"> Blab
	</font>
	<input type='submit'>
	
</form>

<h2>Blabs</h2>

<?php foreach($posts as $key => $post): ?>

	<? $user_post = $post[0] ?>

	<!-- this is the user post -->

	<?=$user_post['first_name'] ?>
	<?=$user_post['last_name'] ?>
	<?=$user_post['email'] ?>
	<?=$user_post['content'] ?>	
	
	<br>
	
<? endforeach; ?>





</body>