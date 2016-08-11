<?php
	require_once('conn.php');
	require_once('functions.php');
	
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');
	
	if(!isset($_REQUEST['id'])) {
		$id = 1;
	} else {
		$id = $_REQUEST['id'];
	}
	
	$screenName = $_REQUEST['screenName'];
	$screen = fnglobalquery($PDO, '*', 'screens', 'id', $screenName, 1, 1, 1, 1, 'id', 'ASC');
	$defaultTitle = $screen[0]['defaultTitle'];
	$tableName = 'screen' . $screenName;
	
	$slides = fnglobalquery($PDO, '*', $tableName, 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
	$bgimages = fnglobalquery($PDO, '*', 'gallery', 'type', 'bgimage', 1, 1, 1, 1, 'id', 'ASC');
	
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$galleryImages = fnglobalquery($PDO, '*', 'gallery', 'type', 'slideimage', 1, 1, 1, 1, 'dateStamp', 'DESC');
	$daTemplate = $slides[0]['template'];
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
<title>Edit Slide</title>
</head>

<body>
<?php include('nav.php'); ?>
	<div class="container tjb_container">	
	
	<div class="page_title">
		<h1>Edit Slide</h1>
	</div>
		<div class="col-sm-6">
		
		<form name="changeTemplate" action="updateslidetemplate.php" method="post">
			<label for="template">Template - (Select First)</label>
			<select type="text" class="form-control" id="template" name="template" onchange="this.form.submit()" required>
			<?php 
			$templateName = fnglobalquery($PDO, '*', 'templates', 'className', $slides[0]['template'], 1, 1, 1, 1, 'id', 'ASC');
			
			foreach($templates as $templaterows) {
			
			if($slides[0]['template'] == $templaterows['className']) {

				?>
					<option value="<?php echo htmlspecialchars($slides[0]['template'], ENT_QUOTES); ?>" selected="selected"><?php echo htmlspecialchars($templateName[0]['name'], ENT_QUOTES); ?></option>
				<?php
			} else {
				?>
				<option value="<?php echo htmlspecialchars($templaterows['className'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($templaterows['name'], ENT_QUOTES); ?></option>
			<?php
			}

			}
				?>
			</select>
			<div class="form-group">
				<input type="hidden" value="<?php echo htmlspecialchars($screenName, ENT_QUOTES); ?>" id="screenid" name="screenid">
				<input type="hidden" value="<?php echo htmlspecialchars($id, ENT_QUOTES); ?>" id="id" name="id">
			</div>
		</form>
		
		<form name="editscreenform" action="updateslidepreview.php?screenName=<?php echo htmlspecialchars($screenName, ENT_QUOTES); ?>" method="post">
			
			
			
					<div class="form-group">
						<input type="hidden" value="<?php echo htmlspecialchars($tableName, ENT_QUOTES); ?>" id="screenTable" name="screenTable">
						<input type="hidden" value="<?php echo htmlspecialchars($id, ENT_QUOTES); ?>" id="id" name="id">
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group" <?php fnforminputornot($is_title); ?>>
								<label for="title">Title</label>
								<input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars(fncheckfortitle($slides[0]['title'], $defaultTitle), ENT_QUOTES); ?>" required>
							</div>
						</div>
						<div class="col-sm-6">
					<div class="form-group">
						<label for="orderNumber">Order</label>
						<select type="text" class="form-control" id="orderNumber" name="orderNumber" value="<?php echo htmlspecialchars($slides[0]['orderNumber'], ENT_QUOTES); ?>" required>								
							
							<?php 
							
							
							$i = 0;
							$highest = fncountOrder($PDO, $tableName);
							$limit = $highest + 10;
							while($i < $limit) {
								$i++;
								?>
								<?php echo fncheckeditOption($PDO, $i, $tableName, $slides[0]['orderNumber']);
							}
							?>
						</select>
					</div>
				</div>
					</div>
					
						<div class="form-group"  <?php fnforminputornot($is_message); ?>>
							<label for="message">Caption</label>
							<textarea rows=6 class="form-control" id="message" name="message"><?php echo htmlspecialchars($slides[0]['message'], ENT_QUOTES); ?></textarea>
						</div>
						
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group" <?php fnforminputornot($is_message); ?>>
								<label for="fontSize">Font Size</label>
								<input type="range" min="40" max="140" class="form-control" id="fontSize" name="fontSize" value="<?php echo $slides[0]['fontSize']; ?>" required>
								<output name="fontSizeOutname" id="fontSizeOutid"><?php echo $slides[0]['fontSize']; ?></output>
							</div>
						</div>
						<div class="col-sm-6">	
							<div class="form-group" <?php fnforminputornot($is_message); ?>>
								<label for="lineHeight">Line Height</label>
								<input type="range" min="40" max="140" class="form-control" id="lineHeight" name="lineHeight" value="<?php echo $slides[0]['lineHeight']; ?>" required>
								<output name="lineHeightOutname" id="lineHeightOutid"><?php echo $slides[0]['lineHeight']; ?></output>
							</div>
						</div>
					</div>
					
					<div class="form-group" <?php fnforminputornot($is_where); ?>>
					<label for="where">Where</label>
					<input class="form-control" name="theWhere" id="theWhere" value="<?php echo htmlspecialchars($slides[0]['theWhere'], ENT_QUOTES); ?>">
					</div>
					
					<div class="form-group" <?php fnforminputornot($is_when); ?>>
					<label for="when">When</label>
					<input class="form-control" name="theWhen" id="theWhen" value="<?php echo htmlspecialchars($slides[0]['theWhen'], ENT_QUOTES); ?>">
					</div>
					
					<div class="form-group" <?php fnforminputornot($is_who); ?> >
					<label for="who">Who</label>
					<input class="form-control" name="theWho" id="theWho" value="<?php echo htmlspecialchars($slides[0]['theWho'], ENT_QUOTES); ?>">
					</div>
					
					<div class="form-group" <?php fnforminputornot($is_why); ?>>
					<label for="why">Why</label>
					<input class="form-control" name="theWhy" id="theWhy" value="<?php echo htmlspecialchars($slides[0]['theWhy'], ENT_QUOTES); ?>">
					</div>
				</div>
				
				<div class="col-sm-6">
				
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						
						<label for="department">Picture</label>
						<select style="color: black;"  type="text" class="form-control" id="picture" name="picture" onchange="pictureupdate(this.value)" required>						
						<?php foreach($galleryImages as $imageOptions) {
							if($imageOptions['fileName'] ==  $slides[0]['picture']) {
								?>
									<option value="<?php echo htmlspecialchars($imageOptions['fileName'], ENT_QUOTES); ?>" selected="selected"><?php echo htmlspecialchars($imageOptions['fileName'], ENT_QUOTES); ?></option>
								<?php
							} else {
									?>
							<option value="<?php echo htmlspecialchars($imageOptions['fileName'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($imageOptions['fileName'], ENT_QUOTES); ?></option>
							<?php
							}
						}
							?>
						</select>
						</div>
					</div>
					
					<div class="col-sm-6 text-center">
						<img class="img-responsive" style="border-radius: 15px; margin: 20px 0; max-height: 250px;" id="pic2upd"  src="images/slideimages/<?php echo htmlspecialchars($slides[0]['picture'], ENT_QUOTES); ?>" />
					</div>
					
				</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="startDate">Start Date &amp; Time</label>
								<input rows=3 class="form-control date_class" id="startDate" name="startDate" value="<?php echo $slides[0]['startDate']; ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="endDate">End Date &amp; Time</label>
								<input rows=3 class="form-control date_class" id="endDate" name="endDate" value="<?php echo $slides[0]['endDate']; ?>">
							</div>
						</div>
					</div>	
							
					<div class="form-group">
						<label for="defaultBackground">Default Background</label>
						
						<select type="text" class="form-control" id="defaultBackground" name="defaultBackground" value="<?php echo htmlspecialchars($slides[0]['background'], ENT_QUOTES); ?>">
						<?php 
							$bgselected = $slides[0]['background'];
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
				
				
				
					
			
		
		</form>
		
	</div>
	<?php include('footer.php'); ?>
	
<script>
function pictureupdate(picfile) {
	
	console.log('changed');
	document.getElementById("pic2upd").src="images/slideimages/" + picfile;	
}



</script>	
	
<script> 
	document.editscreenform.lineHeight.oninput = function(){
    document.editscreenform.lineHeightOutid.value = document.editscreenform.lineHeight.value;
 }	 
	document.editscreenform.fontSize.oninput = function(){
    document.editscreenform.fontSizeOutid.value = document.editscreenform.fontSize.value;
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
<?php #var_dump($templateName); ?>
	</body>
	
	</html>