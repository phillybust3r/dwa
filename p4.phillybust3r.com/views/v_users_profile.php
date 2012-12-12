<?php include 'v_header.php'; ?>

<link rel="stylesheet" href="../css/profile.css" type="text/css"/> 


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
<br>
<h1><?=$user->first_name?> <?=$user->last_name?></h1>
<h2>@<?=$user->username?></h2>



<div id='postwrapper'>

<form method='POST' action='/posts/p_add'>
	
	<font size="1" face="arial, helvetica, sans-serif"> 
		<h2>Add a post</h2>
		<input name="content" type="text" size="140"
		onKeyDown="CountLeft(this.form.content,this.form.left,140);" 
		onKeyUp="CountLeft(this.form.content,this.form.left,140);">
		<input readonly type="text" name="left" size=3 maxlength=3 value="140"> Blab
	</font>
	<input type='submit'>
	
</form>

</div>

<div id='trends'>

<img src='/images/trends.png' alt='TRENDS'><br>
		
<br>

<?php for ($i = 0; $i <= 10 && $trends[$i]; $i++): ?>
	<a href='/posts/p_trends/<?=$trends[$i]['hashtag']?>'>#<?=$trends[$i]['hashtag']?></a>		
	<br>
<? endfor; ?>

</div>



<?php foreach($posts as $key => $post): ?>
<div id='postwrapper2'>
	<?=$post['content']?>
</div>
	
<? endforeach; ?>

</body>