<!DOCTYPE html>
<html>
<head>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/jquery.boxfit.js" type="text/javascript"></script> -->

<?php 
	include('conn.php');
	include('functions.php');


if(!isset($_REQUEST['screenName'])) {
	$screenid = 1;
} else {
	$screenid = $_REQUEST['screenName'];
}
$screenTable = 'screen' . $screenid;

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


/* SLIDE TEMPLATE - Photo Landscape Left */
.main_photo_left {
	background: url('images/background.jpg');
}
.main_photo_left h1 {
}
.mpl_title {
	margin: 25px;
}
.mpl_title h1 {
	
}
.mpl_pic {
	position: absolute;
	left: 25px;
	top: 180px;
	border: 5px solid white;
	width: 1200px;
	height: 675px;
	box-shadow: 3px 3px 5px black;
	background-size: cover;
}
.mpl_message {
	position: absolute;
	bottom: 25px;
	left: 25px;
	height: 150px;
	width: 1870px;
}
/* END OF SLIDE TEMPLATE - Photo Landscape Left */
</style>
</head>
<body onload="tjb_startfunction();">


<div class="frame main_photo_left" id="slide_1" style="opacity: 0;">
	<div class="mpl_title">
		<h1 style="font-size: 120px;">DEPUTY HEAD MESSAGES</h1>
	</div>
	<div class="mpl_pic" style="background-image: url('images/slideimages/1.jpg');">
		
	</div>
	<div class="mpl_message">
		<h1 style="font-size: 80px; line-height: 80px;" >GOOD LUCK WITH THE SOMETHING SOMETHING SOMETHING THE DARK SIDE</h1>
	</div>
</div>


<div class="frame main_photo_left" id="slide_2" style="opacity: 0;">
	<div class="mpl_title">
		<h1 style="font-size: 120px;">DEPUTY HEAD MESSAGES</h1>
	</div>
	<div class="mpl_pic" style="background-image: url('images/slideimages/2.jpg');">
		
	</div>
	<div class="mpl_message">
		<h1 style="font-size: 80px; line-height: 80px;" >GOOD LUCK WITH THE SOMETHING SOMETHING SOMETHING THE DARK SIDE</h1>
	</div>
</div>



<?php var_dump($slides); ?>

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