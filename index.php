<!DOCTYPE html>
<html>
<head>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/jquery.boxfit.js" type="text/javascript"></script> -->
	<link rel="stylesheet" href="templates.css" />
<?php 
	include('conn.php');
	include('functions.php');



if(!isset($_REQUEST['screenName'])) {
	$screenid = 1;
} else {
	$screenid = $_REQUEST['screenName'];
}
$screenTable = 'screen' . $screenid;
$screenInfo = fnglobalquery($PDO, '*', 'screens', 'id', $screenid, 1, 1, 1, 1, 'id', 'ASC');
$slides = fnglobalquery($PDO, '*', $screenTable, 1, 1, 1, 1, 1, 1, 'id', 'ASC');
?>
<style>
h1, h2, h3, h4, p {
	margin: 0;
	padding: 0;
	font-family: "Aspect", sans-serif;
	color: white;
	text-shadow: 2px 5px black;
}
body {
	width: 1920px;
	height: 1080px;
	background-color: grey;
	margin: 0;
	padding: 0;
}
.frame {
	position: absolute;
	width: 1920px;
	height: 1080px;
}

#slide_1 {
	transition: opacity 2s;
}
#slide_2 {
	transition: opacity 2s;
}



</style>
</head>
<body onload="tjb_startfunction();">

<?php 
	$i = 0;
	foreach($slides as $slides) {
		$i++;
	?>

<div class="frame <?php echo $slides['template']; ?>" id="slide_<?php echo $i; ?>" style="opacity: 0; background-image: url('images/<?php echo $slides['background']; ?>');">
	<div class="<?php echo $slides['template']; ?>_title">
		<h1 style="font-size: 120px;"><?php echo strtoupper(fncheckfortitle($slides['title'], $screenInfo[0]['defaultTitle'])); ?></h1>
	</div>
	<div class="<?php echo $slides['template']; ?>_pic" style="background-image: url('images/slideimages/<?php echo $slides['picture']; ?>');">
		
	</div>
	<div class="<?php echo $slides['template']; ?>_message">
		<h1 style="font-size: <?php echo $slides['fontSize']; ?>px; line-height: <?php echo $slides['lineHeight']; ?>px;" ><?php echo strtoupper($slides['message']); ?></h1>
	</div>
</div>



<?php
} ?>

<!--
<div class="frame main_photo_landscape" id="slide_2" style="opacity: 0;">
	<div class="mpl_title">
		<h1 style="font-size: 120px;">DEPUTY HEAD MESSAGES</h1>
	</div>
	<div class="mpl_pic" style="background-image: url('images/slideimages/2.jpg');">
		
	</div>
	<div class="mpl_message">
		<h1 style="font-size: 80px; line-height: 80px;" >GOOD LUCK WITH THE SOMETHING SOMETHING SOMETHING THE DARK SIDE</h1>
	</div>
</div>
-->


<?php #var_dump($screenInfo); ?>

</body>

<script>
	var slideNum = 0;	
	var currentSlide;
	var currenSlideID;
	var reserveId;
	
		function tjb_startfunction() {
			setInterval(function(){
				tjb_hiding();
		},3000);
	}
	
	function tjb_hiding() {
	slideNum = slideNum + 1; 
	currentSlideID = "slide_" + slideNum;
	if (reserveId == undefined) {
		console.log("reserve is undefined");
	}	else {
		document.getElementById(reserveId).style.opacity = "0";
	}
	reserveId = currentSlideID;
	document.getElementById(currentSlideID).style.opacity = "1";
	console.log("Slide num is  " + slideNum);
	if(slideNum == 2) {
		slideNum = 0;
	}
}
</script>


</html>