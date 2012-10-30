<?php include 'v_header.php'; ?>

<style type='text/css'>
	
	
		h1 {
			text-align:left;
			text-decoration:none;
		}
	
		body { 
			background: url("images/background.png")
			
		}
		
		.left {
			width:420px;
		}
		
		.right {
			width:420px;
		}
		
		
		#left {
			float:left;
		}
		
		#right {
			float:right;
		}
		
		#footer {
			clear:both;
		}
		
</style>

<!-- Begin HEAD content. Taco HTML Edit could not find the HEAD section of your document. Please, add a head tag and move this content within the tag. -->
<script type="text/javascript" src="../TacoComponents/MooTools/mootools.js"></script>
<script type="text/javascript" src="../TacoComponents/MenuMatic/MenuMatic.js"></script>

<body>

<br><br><br>
<? foreach($users as $key => $user): ?>


	<?=$user['first_name']?> <?=$user['last_name']?>
	<a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
	<a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
	
	
	<br>
	
<? endforeach; ?>

</body>