<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('conn.php');
	include('head.php');
	include('functions.php');
	
	$galleryImages = fnglobalquery($PDO, '*', 'gallery', 1, 1, 1, 1, 1, 1, 'dateStamp', 'DESC');
		$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'theOrder', 'ASC');

?>

<title>Gallery</title>
	
	
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
					
					<li class="active"><a href="gallery.php">Gallery</a></li>
					
					<li class="dropdown ">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Support<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="about.php">About</a></li>
								<li><a href="userguide.php">User Guide</a></li>
								<li><a href="https://help.cranleigh.org">Submit Ticket</a></li>
								<li><a href="requestfeature.php">Request Feature</a></li>
								<li><a href="log.php">View Log</a></li>
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
	<div class="page_title">
		<h1>Gallery Images</h1>
	</div>
	
		<div class="gallery-uploads-wrap">
		<form action="upload.php" method="post" enctype="multipart/form-data">
				
			<ul class="list-inline list-unstyled" >
				<li style="margin-right: 10px; ">
					<input style="border-radius: 0 0 10px 10px;" type="file" name="fileToUpload" id="fileToUpload" required>
					<input type="text" name="returnUrl" id="returnUrl" value="gallery" hidden>
				</li>
				<li>
					<input  style=" border-radius: 0 10px 0px 10px;"  type="submit" value="Upload Image" name="submit">
				</li>
				
		</form>
	</div>
	
	
	
	
	
	
	
	
	
	<?php 
		$i = 0;
		foreach($galleryImages as $imageTiles) {
		$i++;
		if($i == 1){
			echo '<div class="row">';
		}
		?>
		<div class="col-sm-3 gallery-tile-wrap" >
			<div class="gallery-tile">
				<img src="images/slideimages/<?php echo $imageTiles['fileName']; ?>" class="img-responsive center-block" style="max-height: 200px;"/>
				<div class="gallery_image_controls" style="position: relative;">
					<div class="imageTitle">Image Name - <?php echo $imageTiles['fileName']; ?></div>
					<div class="dateStamp">Uploaded - <?php echo $imageTiles['dateStamp']; ?></div>
					<div class="view_image col-sm-6"><a target="_blank" data-toggle="tooltip" title="Preview Image" href="previewimage.php?id=<?php echo $imageTiles['id']; ?>"><i class="fa fa-play-circle-o fa-2x" ></i></a></div>
					<div class="delete_image col-sm-6">
					<?php fngallerydeletecheck($PDO, $imageTiles['fileName'], $imageTiles['id']); ?><i class="fa fa fa-trash-o fa-2x"></i></a></div>
					</div>
			</div>
		</div>

		
		<?php
	if($i == 4) {
		echo '</div>';
		$i = 0;
	}
		}
		?>
	

	<?php include('footer.php'); ?>	

<script>
	document.forms[0].addEventListener('submit', function( evt ) {
		var file = document.getElementById('fileToUpload').files[0];

		if(file && file.size < 1000000) { // 1 MB (this size is in bytes)
			//Submit form        
		} else {
			alert("Haha - You think you can slow down our servers with massive images. Not this time. See the user guides on how to resize images");
			//Prevent default and display error
			evt.preventDefault();
		}
	}, false);
</script>	
</body>


</html>