<!DocType HTML>
<?php
include "conn.php";
include "functions.php";

$id = fngetlatestscreenid($PDO); 
$tableName = 'screen' . $id;
$columns = "id INT(4) AUTO_INCREMENT PRIMARY KEY, 
orderNumber INT (4) NOT NULL,
template varChar(50) NULL DEFAULT 'main_photo_landscape', 
title varChar(50) NULL, 
picture varChar(50) NULL DEFAULT 'default.jpg', 
message varChar(100) NULL,
theWhere varChar(50) NULL,
theWhen varChar(50) NULL,
theWho varChar(50) NULL,
theWhy varChar(50) NULL,
fontSize INT(3) NOT NULL DEFAULT 80,
lineHeight INT(3) NOT NULL DEFAULT 80,
startDate datetime NULL,
endDate datetime NULL,
background varChar(50) DEFAULT 'bg1.jpg'";

try {
	$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$createTable = $PDO->exec("CREATE TABLE IF NOT EXISTS dsignage.$tableName ($columns)");
} catch(PDOException $e) {
    echo $e->getMessage();
}


header("Location:screenmanager.php?id=" . $id)
?>