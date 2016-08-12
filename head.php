
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="cranfont/style.css" />	
	<link rel="stylesheet" href="style.css" />
	
	
	<?php // $screens = fnscreens($PDO, $_SESSION['user']['username'], 'testteacher'); ?>
	<?php 
			$screens = fnnewscreens($PDO, $_SESSION['user']['username']); 
			
			$isadmin = fnisadmin($PDO,  $_SESSION['user']['username']);
	?>
	
	<?php
		if(isset($_SESSION['errors']['tjberror'])){ ?>
			<!-- THIS IS NOW SET TJB -->
			<script type="text/javascript">
				alert('<?php echo $_SESSION['errors']['tjberror']; ?>');
			</script>
<?php } else { echo ' <!-- Dont Worry be happy -->'; } ?>
