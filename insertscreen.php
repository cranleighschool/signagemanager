<?php
include "conn.php";
include "functions.php";

$screenName = htmlspecialchars_decode($_POST['screenName'], ENT_QUOTES);;
$owner = htmlspecialchars_decode($_POST['owner'], ENT_QUOTES);;
$slideDuration = htmlspecialchars_decode($_POST['slideDuration'], ENT_QUOTES);;
$defaultTitle = htmlspecialchars_decode($_POST['defaultTitle'], ENT_QUOTES);;
$defaultBackground = htmlspecialchars_decode($_POST['defaultBackground'], ENT_QUOTES);;
$defaultTemplate = htmlspecialchars_decode($_POST['defaultTemplate'], ENT_QUOTES);;

$stmt = $PDO->prepare("INSERT INTO screens (screenName, owner, slideDuration, defaultTitle, defaultBackground, defaultTemplate) VALUES (:screenName, :owner, :slideDuration, :defaultTitle, :defaultBackground, :defaultTemplate)");

$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt->bindParam(':screenName', $screenName);
$stmt->bindParam(':owner', $owner);
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
$action = $owner . ' Created New Screen / ' . $screenName;
$userName = $owner;
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */

header("Location:screenprocess.php")
?>