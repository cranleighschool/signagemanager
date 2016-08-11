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
	if(empty($_REQUEST['imgSel'])) {
		$alert = '<div class="tjb_alertbox"><strong><h2>YOU HAVE NOT SELECTED AN IMAGE - <a href="slidewizard2.php?screenName=' . $screenName . '&template=' . $Seltemplate . '">CLICK HERE</a></h2></strong></div>';
	} else {
		$imgSel = $_REQUEST['imgSel'];
	}
	$imgSelpro = fnglobalquery($PDO, '*', 'gallery', 'id', $imgSel, 1, 1, 1, 1, 'id', 'ASC');
	$imageSelected = $imgSelpro[0]['fileName'];
	$galleryImages = fnglobalquery($PDO, '*', 'gallery', 1, 1, 1, 1, 1, 1, 'dateStamp', 'DESC');
	$bgimages = fnglobalquery($PDO, '*', 'gallery', 'type', 'bgimage', 1, 1, 1, 1, 'id', 'ASC');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$screenName = $_REQUEST['screenName'];
	$screen = fnglobalquery($PDO, '*', 'screens', 'id', $screenName, 1, 1, 1, 1, 'id', 'ASC');
	$screenid = $screen[0]['id'];
	$tableName = 'screen' . $screenid;
	$defaultTitle = $screen[0]['defaultTitle'];
	$daTemplate = $_REQUEST['template'];
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

<title>Slide Details</title>
	

</head>

<body>
 <?php include('nav.php'); ?>
	<div class="container tjb_container">
	<?php if(isset($alert)){ echo $alert; } ?>
	<div class="page_title">
		<h1>Slide Details</h1>
	</div>
	
	<form name="slidewizardform" id="slidewizardform" action="insertslide.php" method="post">
	
		<div class="col-sm-6">
			<input type="hidden" value="<?php echo htmlspecialchars($screenid, ENT_QUOTES); ?>" id="screenid" name="screenid">
			<input type="hidden" value="<?php echo htmlspecialchars($daTemplate, ENT_QUOTES); ?>" id="template" name="template">
			<input type="hidden" value="<?php echo strtoupper($_SESSION['user']['username']); ?>" id="username" name="username">
			
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group" style="<?php fnhideornot($is_title); ?>">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title" id="title" value="<?php echo htmlspecialchars($defaultTitle, ENT_QUOTES); ?>" <?php fnforminputornot($is_title); ?>/>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="form-group">
						<label for="orderNumber">Order</label>
						<select type="text" class="form-control" id="orderNumber" name="orderNumber" value="<?php echo fnnextorder($PDO, $tableName, 'orderNumber', 'ASC'); ?>" required>
							
							<?php 
							$i = 0;
							$highest = fncountOrder($PDO, $tableName);
							$limit = $highest + 10;
							while($i < $limit) {
								$i++;
								?>
								<option value="<?php echo $i; ?>" <?php echo fncheckOption($PDO, $i, $tableName); ?>><?php echo $i; ?></option>
								
								<?php
								
							}
							
							?>
						
						
						</select>
					</div>
				</div>
			</div>
			<div class="form-group" style="<?php fnhideornot($is_message); ?>">
			<label for="message">Message</label>
			<textarea rows="5" class="form-control" name="message" id="message" value="" <?php fnforminputornot($is_message); ?>></textarea>
			</div>
			
			<div class="row">
						<div class="col-sm-6">
							<div class="form-group" style="<?php fnhideornot($is_message); ?>">
								<label for="fontSize">Font Size</label>
								<input type="range" min="40" max="140" step="5" class="form-control" id="fontSize" name="fontSize" value="80" required>
								<output name="fontSizeOutname" id="fontSizeOutid">80</output>
							</div>
						</div>
						<div class="col-sm-6">	
							<div class="form-group" style="<?php fnhideornot($is_message); ?>">
								<label for="lineHeight">Line Height</label>
								<input type="range" min="40" max="140" step="5" class="form-control" id="lineHeight" name="lineHeight" value="80" required>
								<output name="lineHeightOutname" id="lineHeightOutid">80</output>
							</div>
						</div>
					</div>
			
			<div class="form-group" style="<?php fnhideornot($is_where); ?>">
			<label for="where">Where</label>
			<input class="form-control" name="theWhere" id="theWhere" value="" <?php fnforminputornot($is_where); ?>>
			</div>
			
			<div class="form-group" style="<?php fnhideornot($is_when); ?>">
			<label for="when">When</label>
			<input class="form-control" name="theWhen" id="theWhen" value="" <?php fnforminputornot($is_when); ?>>
			</div>
			
			<div class="form-group" style="<?php fnhideornot($is_who); ?>">
			<label for="who">Who</label>
			<input class="form-control" name="theWho" id="theWho" value="" <?php fnforminputornot($is_who); ?>>
			</div>
			
			<div class="form-group" style="<?php fnhideornot($is_why); ?>">
			<label for="why">Why</label>
			<input class="form-control" name="theWhy" id="theWhy" value="" <?php fnforminputornot($is_why); ?>>
			</div>
		</div>
		
		<div class="col-sm-6">
		
			<div class="form-group" style="color: black;" >
				<label for="department">Picture</label>
				<select style="color: black;"  type="text" class="form-control" id="picture" name="picture" required>
					<option value="<?php echo htmlspecialchars($imageSelected, ENT_QUOTES); ?>"><?php echo htmlspecialchars($imageSelected, ENT_QUOTES); ?></option>
					<?php foreach($galleryImages as $imageOptions) {
						?>
						
						<option value="<?php echo htmlspecialchars($imageOptions['fileName'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($imageOptions['fileName'], ENT_QUOTES); ?></option>
						
						<?php
					}
						?>
						</select>
			</div>
				
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="startDate">Start Date &amp; Time</label>
						<input class="form-control date_class" id="startDate" name="startDate" value="" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="endDate">End Date &amp; Time</label>
						<input class="form-control date_class" id="endDate" name="endDate" required>
					</div>
				</div>
			</div>
			
			<div class="form-group">
						<label for="defaultBackground">Default Background</label>
						
						<select type="text" class="form-control" id="defaultBackground" name="defaultBackground" value="<?php echo htmlspecialchars($row['defaultBackground'], ENT_QUOTES); ?>">
						<?php 
							$bgselected = $row['defaultBackground'];
							foreach($bgimages as $option) {
								if($bgselected == $option['fileName']){
									?>
									<option value="<?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?>" selected="selected"><?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?></option>
								<?php
								} else { ?>
									<option value="<?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?></option>
									<?php
								}
							}
						?>
						</select>
					</div>
			
						
		<br />
					<button type="submit" class="btn">Update</button>
			
		</div>
			

		</div>
	
	
	
	</form>

	<?php 
	#var_dump($galleryImages);
	
	include('footer.php'); ?>	
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