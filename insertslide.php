<?php
include "conn.php";
include "functions.php";

$username = $_POST['username'];
$screenid = $_POST['screenid'];
$screenTable = 'screen' . $screenid;
$template = $_POST['template'];
$orderNumber = $_POST['orderNumber'];
$title = $_POST['title'];
$picture = $_POST['picture'];
$message = $_POST['message'];
$theWhere = $_POST['theWhere'];
$theWhen = $_POST['theWhen'];
$theWho = $_POST['theWho'];
$theWhy = $_POST['theWhy'];
$fontSize = $_POST['fontSize'];
$lineHeight = $_POST['lineHeight'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];

$stmt = $PDO->prepare("INSERT INTO $screenTable (template, orderNumber, title, picture, message, theWhere, theWhen, theWho, theWhy, fontSize, lineHeight, startDate, endDate) VALUES (:template, :orderNumber, :title, :picture, :message, :theWhere, :theWhen, :theWho, :theWhy, :fontSize, :lineHeight, :startDate, :endDate)");

$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt->bindParam(':template', $template);
$stmt->bindParam(':orderNumber', $orderNumber);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':picture', $picture);
$stmt->bindParam(':message', $message);
$stmt->bindParam(':theWhere', $theWhere);
$stmt->bindParam(':theWhen', $theWhen);
$stmt->bindParam(':theWho', $theWho);
$stmt->bindParam(':theWhy', $theWhy);
$stmt->bindParam(':fontSize', $fontSize);
$stmt->bindParam(':lineHeight', $lineHeight);
$stmt->bindParam(':startDate', $startDate);
$stmt->bindParam(':endDate', $endDate);

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
$action = $username . ' Created a New Slide on the ' . $screenTable . ' table - Slide Info - Title = ' . $title . ' / Message = ' . $message . ' / theWhere = ' . $theWhere . ' / theWhen = ' . $theWhen . ' / theWho = ' . $theWho . ' / theWhy = ' . $theWhy . ' / FontSize = ' . $fontSize . ' / lineHeight = ' . $lineHeight . ' / startDate= ' . $startDate . ' / endDate= ' . $endDate;

$userName = $username;
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */

header("Location:screenmanager.php?id=$screenid")
?>