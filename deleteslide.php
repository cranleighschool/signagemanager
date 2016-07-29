<!DocType HTML>
<?php
include('conn.php');
include('functions.php');


$id = $_REQUEST['id'];
$screenid = $_REQUEST['screenName'];
$screenTable = 'screen' . $screenid;
$slideInfo = fnglobalquery($PDO, '*', $screenTable, 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
$title = $slideInfo[0]['title'];
$message = $slideInfo[0]['message'];
$theWhere = $slideInfo[0]['theWhere'];
$theWhen = $slideInfo[0]['theWhen'];
$theWho = $slideInfo[0]['theWho'];
$theWhy = $slideInfo[0]['theWhy'];
$FontSize = $slideInfo[0]['fontSize'];
$lineHeight = $slideInfo[0]['lineHeight'];
$startDate = $slideInfo[0]['startDate'];
$endDate = $slideInfo[0]['endDate'];

$stmt = $PDO->prepare("DELETE FROM $screenTable WHERE id=:id");
	
$stmt->bindParam(':id', $id);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
$stmt->execute();
}catch(PDOException $e){
	print 'Error!: Failed' . $e->getMessage();
    die();
}

/* LOG INFO */
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
$action = 'Created New Slide on the ' . $screenTable . ' table - Slide Info - Title = ' . $title . ' / Message = ' . $message . ' / theWhere = ' . $theWhere . ' / theWhen = ' . $theWhen . ' / theWho = ' .$theWho . ' / theWhy = ' . $theWhy . ' / FontSize = ' . $FontSize . ' / lineHeight = ' . $lineHeight . ' / startDate= ' . $startDate . ' / endDate= ' . $endDate;
$userName = strtoupper($_SESSION['user']['username']);
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */


header("Location: screenmanager.php?id=" . $screenid);
?>