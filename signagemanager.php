<?php
	require_once('conn.php');
	require_once('functions.php');
	
?><!DOCTYPE html>
<html>
<head>

<?php 
	include('head.php');
	
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
		if(empty($_REQUEST['alert'])) {
		
	} else {
		$alert = $_REQUEST['alert'];
	}
?>

<title>Digital Signage Manager</title>
	
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
					<li class="active"><a  href="signagemanager.php">Home</a></li>				
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
		<?php if(isset($alert)){ echo $alert; } ?>
	<div class="addnew">
		<a href="addscreen.php">Add New Screen</a>
	</div>
	
	<div class="page_title">
		<h1>Current Screens</h1>
	</div>
	
	<div class="screen_table">
			<div class="table-responsive screen_table">
				<table class="table text-center table-striped table-hover">
					<tr>
						<th class="text-center">Screen Name</th>
						<th class="text-center">Default Title</th>
						<th class="text-center">Slide Duration</th>
						<th class="text-center">Active Slides</th>
						<th class="text-center">Edit Screen Settings</th>
						<th class="text-center">Manage Slides</th>
						<th class="text-center">Preview</th>
						<th class="text-center">Delete</th>
					</tr>
					<tr>
						<?php foreach($screens as $row) {
							$screenName = 'screen' . $row['id'];
							?>
							<td><?php echo $row['screenName']; ?></td>
							<td><?php echo $row['defaultTitle']; ?></td>
							<td><?php echo $row['slideDuration']; ?>s</td>
							<td><?php echo fncountactiveslides($PDO, $screenName); ?></td>
							<td><a href="managescreen.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
							<td><a href="screenmanager.php?id=<?php echo $row['id']; ?>"><i class="fa fa-th-list"></i></a></td>
							<td><a href="previewscreen.php?screenName=<?php echo $row['id']; ?>"><i class="fa fa-play-circle-o"></i></a></td>
							<td><a href="deletescreen.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this Screen?')"><i class="fa fa-trash-o"></i></a></td>
					</tr>
						<?php } ?>
				</table>
			</div>
		</div>
	
	<div class="screen_titles_wrapper">
		<?php 
			foreach($screens as $tiles) {
			$tableName = 'screen' . $tiles['id'];
			?>
			
			<div class="col-sm-4 padbox">
				
				<div class="col-sm-12 screen-select  text-center">
				<a data-toggle="tooltip" title="Manage Slides" href="screenmanager.php?id=<?php echo $tiles['id']; ?>">
						<div class="screen_tile_name">
							<h1><?php echo strtoupper($tiles['screenName']); ?></h1>
						</div>
						
						<div class="screen-info-wrap">
							<h4>
							Active Slides: <?php echo fncountactiveslides($PDO, $tableName); ?><br /><br />
							Slide Duration: <?php echo $tiles['slideDuration']; ?>s
							</h4>
						</div>
						
						
					<div class="screen-thumbnail-wrap">
						<img class="img-responsive center-block" style="border: 0px solid black" src="images\flatscreen_image.jpg" />
						
					</div>
					</a>
				<div class="screen_icons_wrap">
					<div class="col-xs-3 screen_icons"><a data-toggle="tooltip" title="Edit Screen Settings" href="managescreen.php?id=<?php echo $tiles['id']; ?>"><i class="fa fa-pencil-square-o fa-2x"></i></a></div>
					<div class="col-xs-3 screen_icons"><a data-toggle="tooltip" title="Manage Slides" href="screenmanager.php?id=<?php echo $tiles['id']; ?>"><i class="fa fa-th-list fa-2x"></i></a></div>
					<div class="col-xs-3 screen_icons"><a data-toggle="tooltip" title="Preview Screen" href="previewscreen.php?screenName=<?php echo $tiles['id']; ?>"><i class="fa fa-play-circle-o fa-2x"></i></a></div>
					<div class="col-xs-3 screen_icons"><a data-toggle="tooltip" title="Delete Screen" href="deletescreen.php?id=<?php echo $tiles['id']; ?>" onclick="return confirm('Are you sure you want to delete this Screen?')"><i class="fa fa-trash-o fa-2x"></i></a></div>
				</div>
				</div>
			</div>
			
			<?php
		}
			?>
	</div>		
			
			
		
	</div>

	<?php include('footer.php'); ?>	
	
</body>