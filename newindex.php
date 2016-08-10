<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<?php 
	include('head.php');

		if(empty($_REQUEST['alert'])) {
			//
	} else {
		$alert = $_REQUEST['alert'];
	}
?>

<title>Digital Signage Manager</title>
	
	<style>
	</style>
	
</head>

<body>
	
	<div class="container tjb_container">
		<?php if(isset($alert)){ echo $alert; } ?>
		
		
		
		
		
	</div>

	<?php include('footer.php'); ?>	
	
</body>

</html>