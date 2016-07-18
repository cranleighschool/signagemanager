<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');
	$id = $_REQUEST['id'];
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$SelectedImage = fnglobalquery($PDO, '*', 'gallery', 'id', $id, 1, 1, 1, 1, 'id', 'ASC');	
?>
<title>Preview Image</title>

</head>
<body>
	
	<div class="container tjb_container">	
	
	<div class="page_title">
		<h1>Preview Image</h1>
	</div>
	
		<img src="images/slideimages/<?php echo $SelectedImage[0]['fileName']; ?>" class="img-responsive center-block previewImage" style="" />

</div>
	
	
	</div>
	
	
		<?php include('footer.php'); ?>
	</body>
		</html>