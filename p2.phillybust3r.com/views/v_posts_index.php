<?php include 'v_header.php'; ?>


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

