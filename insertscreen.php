<?php
include "conn.php";
include "functions.php";

$screenName = $_POST['screenName'];
$slideDuration = $_POST['slideDuration'];
$defaultTitle = $_POST['defaultTitle'];
$defaultBackground = $_POST['defaultBackground'];
$defaultTemplate = $_POST['defaultTemplate'];

$stmt = $PDO->prepare("INSERT INTO screens (screenName, slideDuration, defaultTitle, defaultBackground, defaultTemplate) VALUES (:screenName, :slideDuration, :defaultTitle, :defaultBackground, :defaultTemplate)");

$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
$action = 'Created New Screen / ' . $screenName;
$userName = 'tbc';
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */

header("Location:screenprocess.php")
?>