<pre>
Hello Blog!
<!-- Begin HEAD content. Taco HTML Edit could not find the HEAD section of your document. Please, add a head tag and move this content within the tag. -->
<script type="text/javascript" src="../TacoComponents/MooTools/mootools.js"></script>
<script type="text/javascript" src="../TacoComponents/MenuMatic/MenuMatic.js"></script>
<link rel="stylesheet" type="text/css" href="../TacoComponents/MenuMatic/MenuMatic_myNavigationMenu.css" />

<!-- End HEAD content -->
<!-- BEGIN COMPONENT Navigation Menu - Taco HTML Edit -->
<!--  
For Navigation Menu to appear correctly in Internet Explorer, make sure that you have a valid
doctype declaration at the beginning of your document such as:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 TRANSITIONAL//EN" "http://www.w3.org/TR/html4/loose.dtd">
-->
<ul id="myNavigationMenu">
	<li><a href="#">Title 1</a>
		<ul>
			<li><a href="#">Title 1-1</a></li>
			<li><a href="#">Title 1-2</a></li>
			<li><a href="#">Title 1-3</a></li>
			<li><a href="#">Title 1-4</a></li>
			<li><a href="#">Title 1-5</a></li>
		</ul>
	</li>
	<li><a href="#">Title 2</a>
		<ul>
			<li><a href="#">Title 2-1</a></li>
			<li><a href="#">Title 2-2</a></li>
			<li><a href="#">Title 2-3</a></li>
			<li><a href="#">Title 2-4</a></li>
			<li><a href="#">Title 2-5</a></li>
		</ul>
	</li>
	<li><a href="#">Title 3</a>
		<ul>
			<li><a href="#">Title 3-1</a></li>
			<li><a href="#">Title 3-2</a></li>
			<li><a href="#">Title 3-3</a></li>
			<li><a href="#">Title 3-4</a></li>
			<li><a href="#">Title 3-5</a></li>
		</ul>
	</li>
</ul>
<!-- Create a MenuMatic Instance -->
<script type="text/javascript" >
	window.addEvent('load', function() {			
		var myMenu = new MenuMatic({
			id: 'myNavigationMenu',
			subMenusContainerId: 'myNavigationMenu_menuContainer',
			orientation: 'vertical',
			effect: null, 
			duration: 800, 
			hideDelay: 1000,
			opacity: 100});
	});		
</script>

<!-- END COMPONENT Navigation Menu - Taco HTML Edit -->



</pre>