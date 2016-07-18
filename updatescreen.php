<?php
	require_once('conn.php');
	require_once('functions.php');
?><!DocType HTML>
<?php

$id = $_POST['id'];
$screenName = $_POST['screenName'];
$slideDuration = $_POST['slideDuration'];
$defaultTitle = $_POST['defaultTitle'];
$defaultBackground = $_POST['defaultBackground'];
$defaultTemplate = $_POST['defaultTemplate'];

$stmt = $PDO->prepare("UPDATE screens SET id=:id, screenName=:screenName, slideDuration=:slideDuration, defaultTitle=:defaultTitle, defaultBackground=:defaultBackground, defaultTemplate=:defaultTemplate WHERE id=$id");

$stmt->bindParam(':id', $id);
$stmt->bindParam(':screenName', $screenName);
$stmt->bindParam(':slideDuration', $slideDuration);
$stmt->bindParam(':defaultTitle', $defaultTitle);
$stmt->bindParam(':defaultBackground', $defaultBackground);
$stmt->bindParam(':defaultTemplate', $defaultTemplate);

$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
$stmt->execute();
}catch(PDOException $e){
	print 'Error!: Failed' . $e;
    die();
}

/* LOG INFO */
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
$action = 'Edited Screen / ' . $screenName;
$userName = 'tbc';
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */

header("Location:signagemanager.php")
?>