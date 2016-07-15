<!DOCTYPE html>
<html>
<head>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/jquery.boxfit.js" type="text/javascript"></script> -->
	<link rel="stylesheet" href="templates.css" />
<?php 
	include('conn.php');
	include('functions.php');



if(!isset($_REQUEST['id'])) {
	$screenid = 1;
} else {
	$screenid = $_REQUEST['id'];
}
$screenTable = 'screen' . $screenid;
$screenInfo = fnglobalquery($PDO, '*', 'screens', 'id', $screenid, 1, 1, 1, 1, 'id', 'ASC');
$theslides = fnslidesindate($PDO, $screenTable, 1, 1);
$slideCount = count($theslides);
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

<?php 
$t = 0;
foreach($theslides as $trans) {
$t++;
?>
#slide_<?php echo $t; ?> {
	transition: opacity 3s;
}

<?php
}
?>



</style>
</head>
<body onload="tjb_startfunction();">

<?php 
	$i = 0;
	foreach($theslides as $slides) {
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



<?php #var_dump($screenInfo);
echo 'slide count is...';
echo $slideCount; 
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
echo $date;
?>

</body>

<script>
	var slideNum = 0;	
	var currentSlide;
	var currenSlideID;
	var reserveId;
	var slideCount = <?php echo $slideCount; ?>;
/*	
		function tjb_startfunction() {
			setInterval(function(){
				
				tjb_hiding();
		},5000);
	}
*/	
	function tjb_hiding() {
		slideNum = slideNum + 1; 
		currentSlideID = "slide_" + slideNum;
		console.log(currentSlideID);
		if (reserveId == undefined) {
		}	else {
			document.getElementById(reserveId).style.opacity = "0";
		}
		reserveId = currentSlideID;
		document.getElementById(currentSlideID).style.opacity = "1";
		if(slideNum == slideCount) {
			slideNum = 0;
		}
		console.log(slideNum);
}

	function tjb_startfunction() {
		<?php 
		foreach($theslides as $jsSlides) {
			$slideDurTot[] = $jsSlides['slideDuration']; 
			$slidedurationSum = array_sum($slideDurTot);
			$currentslidepause = 3000;
			?>
			setTimeout(tjb_hiding, <?php echo $slidedurationSum; ?>);
		<?php } ?>
		setTimeout(tjb_startfunction, <?php echo $slidedurationSum + $currentslidepause; ?>);
		<?php 
		unset($slideDurTot);
		?>
		
		
	}
</script>


</html>