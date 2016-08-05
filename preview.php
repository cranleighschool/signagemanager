<?php
	require_once('conn.php');
	require_once('display_functions.php');	
?><!DOCTYPE html>
<html>
<head>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/jquery.boxfit.js" type="text/javascript"></script> -->
	<link rel="stylesheet" href="templates.css" />
<?php 
if(!isset($_REQUEST['screenName'])) {
	// Redirect to error page
} else {
	$screenName = $_REQUEST['screenName'];
}
$screenTable = 'screen' . $screenName;
$screenInfo = fnglobalquery($PDO, '*', 'screens', 'id', $screenName, 1, 1, 1, 1, 'id', 'ASC');
$slides = fnslidesindate($PDO, $screenTable, 1, 1);
$slideCount = count($slides);
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
foreach($slides as $trans) {
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
<div id="now_loading" class="now_loading" style="opacity: 1;">
	<h1>LOADING SCREEN ...</h1>
</div>

<?php 

	if($slideCount == 1) {
		
		$i = 0;
	foreach($slides as $slides) {
		$i++;
		$daTemplate = $slides['template'];
		$thetemplate = fnglobalquery($PDO, '*', 'templates', 'className', $daTemplate, 1, 1, 1, 1, 'id', 'ASC');
		#CONFIRM FORM OPTIONS
		$is_title = $thetemplate[0]['title'];
		$is_message = $thetemplate[0]['message'];
		$is_where = $thetemplate[0]['theWhere'];
		$is_when = $thetemplate[0]['theWhen'];
		$is_who = $thetemplate[0]['theWho'];
		$is_why = $thetemplate[0]['theWhy'];
		$is_background = $thetemplate[0]['theBackground'];
		?>		
		
	<div class="frame <?php echo $slides['template']; ?>" style="opacity: 1; background-image: url('images/<?php echo $slides['background']; ?>');">
	
			<div class="<?php echo $slides['template']; ?>_title">
			<h1><?php echo strtoupper(fncheckfortitle($slides['title'], $screenInfo[0]['defaultTitle'])); ?></h1>
		</div>
		<div class="<?php echo $slides['template']; ?>_pic" style="background-image: url('images/slideimages/<?php echo $slides['picture']; ?>');">
			
		</div>
		<div class="<?php echo $slides['template']; ?>_message" <?php fninputornot($is_message); ?>>
			<h1 style="font-size: <?php echo $slides['fontSize']; ?>px; line-height: <?php echo $slides['lineHeight']; ?>px;" ><?php echo strtoupper($slides['message']); ?></h1>
		</div>
		
		<div class="<?php echo $slides['template']; ?>_where" <?php fninputornot($is_where); ?>>
			<h1 style="	color: #FFC627; text-align: right; ">WHERE</h1>
			<h1><?php echo strtoupper($slides['theWhere']); ?></h1>
		</div>
		
		<div class="<?php echo $slides['template']; ?>_when" <?php fninputornot($is_when); ?>>
			<h1 style="	color: #FFC627;text-align: right; position: absolute; top: 0px; right: 0px;">WHEN</h1>
			<h1><?php echo strtoupper($slides['theWhen']); ?></h1>
		</div>
		
		<div class="<?php echo $slides['template']; ?>_who" <?php fninputornot($is_who); ?>>
			<h1 style="	color: #FFC627;">WHO</h1>
			<h1><?php echo strtoupper($slides['theWho']); ?></h1>
		</div>
		
		<div class="<?php echo $slides['template']; ?>_why" <?php fninputornot($is_why); ?>>
			<h1 style="	color: #FFC627;">WHY</h1>
			<h1><?php echo strtoupper($slides['theWhy']); ?></h1>
		</div>
	</div>
		
		<?php
	}
	} else {
		
	$i = 0;
	foreach($slides as $slides) {
		$i++;
		
		$daTemplate = $slides['template'];
		$thetemplate = fnglobalquery($PDO, '*', 'templates', 'className', $daTemplate, 1, 1, 1, 1, 'id', 'ASC');
		#CONFIRM FORM OPTIONS
		$is_title = $thetemplate[0]['title'];
		$is_message = $thetemplate[0]['message'];
		$is_where = $thetemplate[0]['theWhere'];
		$is_when = $thetemplate[0]['theWhen'];
		$is_who = $thetemplate[0]['theWho'];
		$is_why = $thetemplate[0]['theWhy'];
		$is_background = $thetemplate[0]['theBackground'];
		
	?>

<div class="frame <?php echo $slides['template']; ?>" id="slide_<?php echo $i; ?>" style="opacity: 0; background-image: url('images/<?php echo $slides['background']; ?>');">
	
		<div class="<?php echo $slides['template']; ?>_title">
		<h1><?php echo strtoupper(fncheckfortitle($slides['title'], $screenInfo[0]['defaultTitle'])); ?></h1>
	</div>
	<div class="<?php echo $slides['template']; ?>_pic" style="background-image: url('images/slideimages/<?php echo $slides['picture']; ?>');">
		
	</div>
	<div class="<?php echo $slides['template']; ?>_message" <?php fninputornot($is_message); ?>>
		<h1 style="font-size: <?php echo $slides['fontSize']; ?>px; line-height: <?php echo $slides['lineHeight']; ?>px;" ><?php echo strtoupper($slides['message']); ?></h1>
	</div>
	
	<div class="<?php echo $slides['template']; ?>_where" <?php fninputornot($is_where); ?>>
		<h1 style="	color: #FFC627; text-align: right; ">WHERE</h1>
		<h1><?php echo strtoupper($slides['theWhere']); ?></h1>
	</div>
	
	<div class="<?php echo $slides['template']; ?>_when" <?php fninputornot($is_when); ?>>
		<h1 style="	color: #FFC627;text-align: right; position: absolute; top: 0px; right: 0px;">WHEN</h1>
		<h1><?php echo strtoupper($slides['theWhen']); ?></h1>
	</div>
	
	<div class="<?php echo $slides['template']; ?>_who" <?php fninputornot($is_who); ?>>
		<h1 style="	color: #FFC627;">WHO</h1>
		<h1><?php echo strtoupper($slides['theWho']); ?></h1>
	</div>
	
	<div class="<?php echo $slides['template']; ?>_why" <?php fninputornot($is_why); ?>>
		<h1 style="	color: #FFC627;">WHY</h1>
		<h1><?php echo strtoupper($slides['theWhy']); ?></h1>
	</div>
</div>
<?php
} 
}
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
?>
</body>
<script>
	var slideNum = 0;	
	var currentSlide;
	var currenSlideID;
	var reserveId;
	var spinCount = 0;
	var slideCount = <?php echo $slideCount; ?>;
	
		function tjb_startfunction() {
			setInterval(function(){
				spinCount = spinCount + 1;
					if(spinCount >= 1) {
						hide_loading();
					}
				tjb_hiding();
		},<?php echo ($screenInfo[0]['slideDuration'] * 1000) ?>);
	}
	function hide_loading() {
		document.getElementById('now_loading').style.opacity = "0";
		console.log('Button Pressed');
	}
	
	function tjb_hiding() {
		slideNum = slideNum + 1; 
		currentSlideID = "slide_" + slideNum;
		if (reserveId == undefined) {
		}	else {
			document.getElementById(reserveId).style.opacity = "0";
		}
		reserveId = currentSlideID;
		document.getElementById(currentSlideID).style.opacity = "1";
		if(slideNum == slideCount) {
			slideNum = 0;
		}
}
</script>

</html>