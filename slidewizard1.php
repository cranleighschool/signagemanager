<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<?php 
	include('head.php');
	
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'theOrder', 'ASC');
?>
<title>Slide Wizard - Select Template</title>

</head>
<body>	
	<div class="container tjb_container">
	<?php 
	if(empty($_REQUEST['screenName'])) {
		echo '<div class="tjb_alertbox row"><strong><h2>';
		echo strtoupper('You have not selected a Screen please - <a href="screenmanager.php">Click Here</a>');
		echo '</strong></h2></div>';
	} else {
		$screenName = $_REQUEST['screenName'];
	}
	?>
	<div class="page_title">
		<h1>Select Template</h1>
	</div>
	<?php 
	$i = 0;
	foreach($templates as $tiles) {
		$i++; 
		if($i == 1) {
			echo '<div class="row">';
		}
		?>
		<div class="col-sm-4 padbox">
		<a href="slidewizard2.php?template=<?php echo $tiles['className']; ?>&screenName=<?php echo $screenName; ?>"><div class="col-sm-12 template-select  text-center">
		<div class="thumbnail-wrap">
			<img class="img-responsive center-block" src="template-thumbnails\<?php echo $tiles['thumbnail']; ?>"/>
		</div>
		<div class="template-title-wrap">
			<?php echo strtoupper($tiles['name']); ?>
		</div>
		</div></a>
	</div>		
	<?php
	if($i == 3) {
		echo '</div>';
		$i = 0;
	}
	
	} ?>
	
	<!--
	<div class="col-sm-4 padbox">
		<div class="col-sm-12 template-select">
		<div class="thumbnail-wrap">
			<img class="img-responsive" src="template-thumbnails\thumbnail-event.jpg"/>
		</div>
		<div class="template-title-wrap">
			EVENT TEMPLATE
		</div>
		</div>
	</div>	
	
	-->


	<?php include('footer.php'); ?>	
</body>