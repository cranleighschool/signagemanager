<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');

	if(empty($_REQUEST['screenName'])) {
		$alert = '<div class="tjb_alertbox"><strong><h2>YOU HAVE NOT SELECTED A SCREEN - <a href="screenmanager.php">CLICK HERE</a></h2></strong></div>';
		$_REQUEST['screenName'] = 1;
		$screenName = 1;
	} else {
	$screenName = $_REQUEST['screenName'];
	}
	if(empty($_REQUEST['template'])) {
		$alert = '<div class="tjb_alertbox"><strong><h2>YOU HAVE NOT SELECTED A TEMPLATE - <a href="slidewizard1.php?screenName=' . $screenName . '">CLICK HERE</a></h2></strong></div>';
		$_REQUEST['template'] = 'main_photo_landscape';
	} else {
		$Seltemplate = $_REQUEST['template'];  
	}
	if(empty($_POST['alert'])) {
		
	} else {
		$alert = $_POST['alert'];
	}
		
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$screenName = $_REQUEST['screenName'];
	$screen = fnglobalquery($PDO, '*', 'screens', 'id', $screenName, 1, 1, 1, 1, 'id', 'ASC');
	$screenid = $screen[0]['id'];
	$tableName = 'screen' . $screenid;
	$galleryImages = fnglobalquery($PDO, '*', 'gallery', 1, 1, 1, 1, 1, 1, 'dateStamp', 'DESC');
	$returnUrlName = $screenName;
	$returnUrlTemplate = $Seltemplate;

?>

<title>Slide Details</title>
	
	<style>

    #theframe { width: 1920px; height: 1080px; border: 2px solid black;	box-shadow: 3px 3px 5px black;}
    #theframe {
        -ms-zoom: 0.4;
        -moz-transform: scale(0.4);
        -moz-transform-origin: 0 0;
        -o-transform: scale(0.4);
        -o-transform-origin: 0 0;
        -webkit-transform: scale(0.4);
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
	<?php if(isset($alert)){ echo $alert; } ?>
	<div class="page_title">
		<h1>Select Image</h1>
	</div>
	
	<div class="gallery-uploads-wrap">
		<form action="upload.php" method="post" enctype="multipart/form-data">
				
			<ul class="list-inline list-unstyled" >
				<li style="margin-right: 10px; ">
					<input style="border-radius: 0 0 10px 10px;" type="file" name="fileToUpload" id="fileToUpload" required>
					<input type="text" name="returnUrlName" id="returnUrlName" value="<?php echo $returnUrlName; ?>" hidden>
					<input type="text" name="returnUrlTemplate" id="returnUrlTemplate" value="<?php echo $returnUrlTemplate; ?>" hidden>
					<input type="text" name="returnUrl" id="returnUrl" value="slidewizard2" hidden>
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
				<a data-toggle="tooltip" title="Select Image" href="slidewizard3.php?imgSel=<?php echo $imageTiles['id']; ?>&screenName=<?php echo $screenName; ?>&template=<?php echo $Seltemplate; ?>"><img src="images/slideimages/<?php echo $imageTiles['fileName']; ?>" class="img-responsive center-block" style="max-height: 200px;"/></a>
				<div class="gallery_image_controls" style="position: relative;">
					<div class="imageTitle">Image Name - <?php echo $imageTiles['fileName']; ?></div>
					<div class="dateStamp">Uploaded - <?php echo $imageTiles['dateStamp']; ?></div>
					<div class="view_image col-sm-6"><a target="_blank" data-toggle="tooltip" title="Preview Image" href="previewimage.php?id=<?php echo $imageTiles['id']; ?>"><i class="fa fa-play-circle-o fa-2x"></i></a></div>
					<div class="delete_image col-sm-6">
					
					<?php  fnslidewizarddeletecheck($PDO, $imageTiles['fileName'], $imageTiles['id'], $returnUrlName, $returnUrlTemplate); ?>
					
				
					
					
					<i class="fa fa fa-trash-o fa-2x"></i></a></div>
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
<script> 
	document.slidewizardform.lineHeight.oninput = function(){
    document.slidewizardform.lineHeightOutid.value = document.slidewizardform.lineHeight.value;
 }	 
	document.slidewizardform.fontSize.oninput = function(){
    document.slidewizardform.fontSizeOutid.value = document.slidewizardform.fontSize.value;
 }
 
 </script>	
 <script src="./jquery.js"></script>
<script src="build/jquery.datetimepicker.full.js"></script>
 <script>
 /*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('.date_class').datetimepicker();

</script>
</body>


</html>