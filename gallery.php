<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');	
	$galleryImages = fnglobalquery($PDO, '*', 'gallery', 'type', 'slideimage', 1, 1, 1, 1, 'dateStamp', 'DESC');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'theOrder', 'ASC');
?>

<title>Gallery</title>
</head>

<body>
<?php include('nav.php'); ?>
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
	<div class="" style="margin: 0; padding: 0;">
		<h4>Either Select an Existing Image or Upload one using the buttons above. <b>All images must be less than 2mb</b></h4>
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
				<img src="images/slideimages/<?php echo htmlspecialchars($imageTiles['fileName'], ENT_QUOTES); ?>" class="img-responsive center-block" style="max-height: 200px;"/>
				<div class="gallery_image_controls" style="position: relative;">
					<div class="imageTitle">Image Name - <?php echo htmlspecialchars($imageTiles['fileName'], ENT_QUOTES); ?></div>
					<div class="dateStamp">Uploaded - <?php echo htmlspecialchars($imageTiles['dateStamp'], ENT_QUOTES); ?></div>
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
			alert("I'm afraid that image is a bit too big for Digital Signage, it will make it load very slowly. See the user guides on how to resize images (Click Support > User Guides");
			//Prevent default and display error
			evt.preventDefault();
		}
	}, false);
</script>	
</body>


</html>