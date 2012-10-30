<style type="text/css">
	.boxed {
  		border: 1px solid white ;
	}
	
	body { 
			background: url("images/background.png")
	}	
</style>


<body>
<br>

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
	<li><a href="/index">INDEX Home</a>
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

<br>
<br>
<br>
<br>
<br>
<br>
	
	<!-- Begin HEAD content. Taco HTML Edit could not find the HEAD section of your document. Please, add a head tag and move this content within the tag. -->
	<script type="text/javascript" src="../TacoComponents/TSWUtils.js"></script>
	<script type="text/javascript" src="../TacoComponents/TSWDomUtils.js"></script>
	<script type="text/javascript" src="../TacoComponents/TSWBrowserDetect.js"></script>
	<script type="text/javascript" src="../TacoComponents/TSWTableUtils.js"></script>
	
	<!-- End HEAD content --><!-- Begin HEAD content. Taco HTML Edit could not find the HEAD section of your document. Please, add a head tag and move this content within the tag. -->
	
	<!-- BEGIN COMPONENT Simple Table - Taco HTML Edit -->
	<style type="text/css">
	table#myTable
	{
		width: 100%;
		border: 1px solid #6c7aa9;
		border-collapse: collapse;
		border-spacing: 0px;
		*border-collapse: expression('collapse', cellSpacing = '0px'); /*For IE*/
	}
	table#myTable tbody tr
	{
		background-color: #ffffff;
		color: #000000;
	}
	table#myTable tbody tr.tswOddRow
	{
		background-color: #edf3ff;
	}
	table#myTable td
	{
		border: 1px solid #cccccc;
		padding: 2px;
	}
	</style>
	
	
	

<div class="boxed">
	
<?php foreach($posts as $key => $post): ?>

	<table id="myTable" class="tswTable">
		<tbody>
			<tr>
				<td><?=$post['first_name']?></td>
				<td><?=$post['created']?></td>
			</tr>

		</tbody>
		
	</table>
	
	<table id="myTable" class="tswTable">
		<tbody>
			<tr>
				<td><?=$post['content']?></td>
			</tr>

		</tbody>
	</table>
	
		
	<br><br>

<? endforeach; ?>
</div>	
	
</body>

