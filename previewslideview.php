<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DOCTYPE html>
<html>
<head>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/jquery.boxfit.js" type="text/javascript"></script> -->
	<link rel="stylesheet" href="templates.css" />
<?php 

if(!isset($_REQUEST['screenName'])) {
	// Return an Error Screen
} else {
	$screenid = $_REQUEST['screenName'];
}
if(!isset($_REQUEST['id'])) {
	// Return an Error Screen
} else {
	$id = $_REQUEST['id'];
}
$screenTable = 'screen' . $screenid;
$screenInfo = fnglobalquery($PDO, '*', 'screens', 'id', $screenid, 1, 1, 1, 1, 'id', 'ASC');
$slides =  fnglobalquery($PDO, '*', $screenTable, 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
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
<body>

<?php 
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

<div class="frame <?php echo htmlspecialchars($slides['template'], ENT_QUOTES); ?>" id="slide_<?php echo $i; ?>" style="opacity: 1; background-image: url('images/<?php echo htmlspecialchars($slides['background'], ENT_QUOTES); ?>');">
	
	<div class="<?php echo htmlspecialchars($slides['template'], ENT_QUOTES); ?>_title">
		<h1><?php echo htmlspecialchars(strtoupper(fncheckfortitle($slides['title'], $screenInfo[0]['defaultTitle'])), ENT_QUOTES); ?></h1>
	</div>
	<div class="<?php echo htmlspecialchars($slides['template'], ENT_QUOTES); ?>_pic" style="background-image: url('images/slideimages/<?php echo htmlspecialchars($slides['picture'], ENT_QUOTES); ?>');">
		
	</div>
	<div class="<?php echo htmlspecialchars($slides['template'], ENT_QUOTES); ?>_message" <?php fntemplatehide($is_message); ?>>
		<h1 style="font-size: <?php echo htmlspecialchars($slides['fontSize'], ENT_QUOTES); ?>px; line-height: <?php echo htmlspecialchars($slides['lineHeight'], ENT_QUOTES); ?>px;" ><?php echo htmlspecialchars(strtoupper($slides['message']), ENT_QUOTES); ?></h1>
	</div>
	
	<div class="<?php echo htmlspecialchars($slides['template'], ENT_QUOTES); ?>_where" <?php fntemplatehide($is_where); ?>>
		<h1 style="	color: #FFC627; text-align: right; ">WHERE</h1>
		<h1><?php echo htmlspecialchars(strtoupper($slides['theWhere']), ENT_QUOTES); ?></h1>
	</div>
	
	<div class="<?php echo htmlspecialchars($slides['template'], ENT_QUOTES); ?>_when" <?php fntemplatehide($is_when); ?>>
		<h1 style="	color: #FFC627;text-align: right; position: absolute; top: 0px; right: 0px;">WHEN</h1>
		<h1><?php echo htmlspecialchars(strtoupper($slides['theWhen']), ENT_QUOTES); ?></h1>
	</div>
	
	<div class="<?php echo htmlspecialchars($slides['template'], ENT_QUOTES); ?>_who" <?php fntemplatehide($is_who); ?>>
		<h1 style="	color: #FFC627;">WHO</h1>
		<h1><?php echo htmlspecialchars(strtoupper($slides['theWho']), ENT_QUOTES); ?></h1>
	</div>
	
	<div class="<?php echo htmlspecialchars($slides['template'], ENT_QUOTES); ?>_why" <?php fntemplatehide($is_why); ?>>
		<h1 style="	color: #FFC627;">WHY</h1>
		<h1><?php echo htmlspecialchars(strtoupper($slides['theWhy']), ENT_QUOTES); ?></h1>
	</div>
	
	
	
	
</div>



<?php
} 
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
?>

</body>



</html>