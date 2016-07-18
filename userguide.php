<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');

	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
?>
<title>About</title>
</head>

<body>

	<div class="container tjb_container text-center">	
	
	<img src="images/CS_logo_landscape2.jpg" class="img-responsive" style="width: 100%;" />
	<br />

	<h2>PAGE UNDER CONSTRUCTION</h2>
	
	<div class="page_title">
		<h1>Digital Signage Manager - User Guide</h1>
	</div>
	
	
	
	
	
	</div>
	
	
		<?php include('footer.php'); ?>
	</body>
		</html>