<!DOCTYPE html>
<html>
<head>
<?php 
	include('conn.php');
	include('functions.php');
	include('head.php');

	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	
	
if(!isset($_REQUEST['screenName'])) {
	$screenid = 1;
} else {
	$screenid = $_REQUEST['screenName'];
}
$tableName = 'screen' . $screenid;
$screenInfo = fnglobalquery($PDO, '*', 'screens', 'id', $screenid, 1, 1, 1, 1, 'id', 'ASC');
$slideInfo = fnglobalquery($PDO, '*', $tableName, 1, 1, 1, 1, 1, 1, 'orderNumber', 'ASC');


$screenArray = fnnextscreenid($PDO, 'screens', $screenid);
if(!empty($screenArray)) {
	$nextScreen = $screenArray[0]['id'];
} else {
	$nextScreen = $screenid;
}

$prevscreenArray = fnprevscreenid($PDO, 'screens', $screenid);
if(!empty($prevscreenArray)) {
	$prevScreen = $prevscreenArray[0]['id'];
} else {
	$prevScreen = $screenid;
}


?>
<style>

    #theframe { width: 1920px; height: 1080px; border: 2px solid black;	box-shadow: 3px 3px 5px black;}
    #theframe {
        -ms-zoom: 0.58;
        -moz-transform: scale(0.58);
        -moz-transform-origin: 0 0;
        -o-transform: scale(0.58);
        -o-transform-origin: 0 0;
        -webkit-transform: scale(0.58);
        -webkit-transform-origin: 0 0;
    }
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
					<li class="dropdown">
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
					<li class="dropdown active ">
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
	
<div class="container tjb_container" style="height: 825px;">
<div class="page_title">
	<h1>Preview Screen - <?php echo $screenInfo[0]['screenName']; ?></h1>
</div>
	<iframe id="theframe" scrolling="no" src="preview.php?id=<?php echo $screenid; ?>"></iframe>

	<div class="row">
		<div class="preview-controls">
		<ul class="list-unstyled list-inline text-center">
		<li><a href="slidewizard1.php?screenName=<?php echo $screenid; ?>">Add  New Slide</a></li>
		<li><a href="screenmanager.php?id=<?php echo $screenid; ?>">Manage Screen</a></li>
		</ul>
		
	</div>
</div>
	
	
	<div class="nextSlide">
		<a href="previewscreen.php?screenName=<?php echo $nextScreen; ?>">Next Screen</a>
	</div>
	<div class="prevSlide">
		<a href="previewscreen.php?screenName=<?php echo $prevScreen; ?>">Prev Screen</a>
	</div>
	</div>
<?php include('footer.php'); ?>	
</body>



</html>