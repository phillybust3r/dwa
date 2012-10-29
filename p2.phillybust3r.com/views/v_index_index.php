<style type='text/css'>
	
		h1 {
			text-align:center;
		}
		
		body { 
			background: url("images/background.png")
		}
</style>

<body>

<? if(!$user): ?>

	<br><br><br>

	<div id='wrapper'>
	<h1>
		<img src='images/blabbrlogo.png' alt='Blabbr'><br>
		<a href="users/login">
			<img src='images/login_button.png'>
		</a>
		<a href="users/signup">
			<img src='images/join_button.png'>
		</a>
	</h1>
	</div>
	
<? else: ?>
	
	
	<!--Welcome back --><!--?=$user>first_name?--><br>


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
	<li><a href="/index">Home</a>
	</li>
	<li><a href="#">@ Connect</a>
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

<? endif; ?>

</body>