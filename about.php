<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');	
?>
<title>About</title>	
</head>

<body>

	<div class="container tjb_container">	
	
	<img src="images/CS_logo_landscape2.jpg" class="img-responsive" style="width: 100%;" />
	<br />
	<p>Current Version - v1.1</p>
	<p>This software has been developed by Tom Butler in the Cranleigh School IT Department.</p>
	<p>To contact to Tom please click the link <a href="mailto:support@cranleigh.org">here</a> or email support@cranleigh.org</p>
	
	<div class="page_title">
		<h1>About Digital Signage Manager v1</h1>
	</div>
	
	
	
	
	
	</div>
	
	
		<?php include('footer.php'); ?>
	</body>
		</html>