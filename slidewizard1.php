<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<?php 
	include('head.php');
	
	if(empty($_REQUEST['screenName'])) {
		$id = $screens[0]['id'];
	} else {
		$id = $_REQUEST['screenName'];
	}	
	iaAllowedhere($PDO, $_SESSION['user']['username'], $id);
	
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'theOrder', 'ASC');
	
?>
<title>Slide Wizard - Select Template</title>

</head>
<body>
<?php include('nav.php');	
	 ?>
	<div class="container tjb_container">

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
		<a href="slidewizard2.php?template=<?php echo $tiles['className']; ?>&screenName=<?php echo $id; ?>"><div class="col-sm-12 template-select  text-center">
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