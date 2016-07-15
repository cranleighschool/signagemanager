<!DOCTYPE html>
<html>
<head>

<?php 
	include('conn.php');
	include('head.php');
	include('functions.php');
	
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'theOrder', 'ASC');
?>

<title>Slide Wizard - Select Template</title>
	
	<style>
	</style>
	
</head>

<body>
  <!-- Navigation -->
   <nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: 1px solid #0C223F;">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="signagemanager.php"><i class="cranfont cranfont-logo"></i> Digital Signage Manager</a>
			</div>
			
				<div id="navbar" class="navbar-collapse collapse">
						
				<ul class="nav navbar-nav">
					<li><a href="#menu-toggle" id="menu-toggle" onClick="setPadding()"><i class="fa fa-bars"></i></a></li>
					<li><a  href="signagemanager.php">Home</a></li>				
					<li class="dropdown active">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">	
								<?php foreach($screens as $navscreens) {
									?>
									<li><a href="screenmanager.php?id=<?php echo $navscreens['id']; ?>"><?php echo $navscreens['screenName']; ?></a></li>
									
									<?php
								} ?>
								<li class="divider"></li>
								<li><a href="addscreen.php">Add Screen</a></li>
							</ul>
					</li>
					<li class="dropdown ">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Preview Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<?php foreach($screens as $navscreens) {
									?>
									<li><a href="previewscreen.php?screenName=<?php echo $navscreens['id']; ?>"><?php echo $navscreens['screenName']; ?></a></li>
									
									<?php
								} ?>
							</ul>
					</li>
					
					<li class=""><a href="gallery.php">Gallery</a></li>
					
					<li class="dropdown ">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Support<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="about.php">About</a></li>
								<li><a href="userguide.php">User Guide</a></li>
								<li><a href="https://help.cranleigh.org">Submit Ticket</a></li>
								<li><a href="requestfeature.php">Request Feature</a></li>
								<li><a href="log.php">Log</a></li>
							</ul>
					</li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="?logout">Sign Out (TJB) <i class="fa fa-fw fa-sign-out"></i></a></li>
					<li style="padding-top: 8px;">
					

					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	
	
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