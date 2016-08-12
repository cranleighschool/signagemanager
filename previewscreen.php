<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<?php 
	include('head.php');

if(!isset($_REQUEST['screenName'])) {
	$id = $screens[0]['id'];
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
 <?php include('nav.php'); ?>
<div class="container tjb_container" style="height: 825px;">
<div class="page_title">
	<h1>Preview Screen - <?php echo htmlspecialchars($screenInfo[0]['screenName'], ENT_QUOTES); ?></h1>
</div>
	<div style="position: absolute; right: 10px; top: 10px;"><a href="#" data-toggle="tooltip" title="Slides on the preview change every 5 seconds"><i class="fa fa-question-circle fa-3x" aria-hidden="true" ></i></a></div>
	
	<iframe id="theframe" scrolling="no" src="previewFast.php?screenName=<?php echo $screenid; ?>"></iframe>

	<div class="row">
	
		<div class="preview-controls">
		<ul class="list-unstyled list-inline text-center">
		<li><a href="slidewizard1.php?screenName=<?php echo htmlspecialchars($screenid, ENT_QUOTES); ?>">Add  New Slide</a></li>
		<li><a href="screenmanager.php?id=<?php echo htmlspecialchars($screenid, ENT_QUOTES); ?>">Manage Screen</a></li>
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