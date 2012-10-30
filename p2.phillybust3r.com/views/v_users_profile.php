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


<!-- Begin HEAD content. Taco HTML Edit could not find the HEAD section of your document. Please, add a head tag and move this content within the tag. -->
<script type="text/javascript" src="../TacoComponents/MooTools/mootools.js"></script>
<script type="text/javascript" src="../TacoComponents/MenuMatic/MenuMatic.js"></script>
<link rel="stylesheet" type="text/css" href="../TacoComponents/MenuMatic/MenuMatic_myNavigationMenu_2.css" />

<!-- End HEAD content -->
<!-- BEGIN COMPONENT Navigation Menu - Taco HTML Edit -->
<!--  
For Navigation Menu to appear correctly in Internet Explorer, make sure that you have a valid
doctype declaration at the beginning of your document such as:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 TRANSITIONAL//EN" "http://www.w3.org/TR/html4/loose.dtd">
-->
<ul id="myNavigationMenu">
	<li><a href="/">Home</a>
	</li>
	<li><a href="/posts/connections">@ Connection</a>
	</li>
	<li><a href="/posts/users"># Followers</a>
	</li>
	<li><a href="/posts">Me</a>
	</li>
	<li><a href="/users/logout">Logout</a>
	</li>
</ul>

<!-- Create a MenuMatic Instance -->
<script type="text/javascript" >
	window.addEvent('load', function() {			
		var myMenu = new MenuMatic({
			id: 'myNavigationMenu',
			subMenusContainerId: 'myNavigationMenu_menuContainer',
			orientation: 'horizontal',
			effect: 'slide & fade', 
			duration: 800, 
			hideDelay: 1000,
			opacity: 100});
	});		
</script>

<!-- END COMPONENT Navigation Menu - Taco HTML Edit -->

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




</body>