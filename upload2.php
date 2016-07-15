<?php
include('conn.php');
include('functions.php');
/* LOG INFO */
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
$userName = 'tbc';
/* END OF LOG INFO */

if(!isset($_FILES["fileToUpload"])){
	$errorCatch= 'error-filenotset';
	$action = 'Fatal Error - File Error';
	fnaddtolog($PDO, $action, $userName, $date);
	header("Location: error.php?error=" . $errorCatch);
}
if(!isset($_POST['returnUrl'])) {
	$errorCatch= 'error-returnUrl';
	$action = 'Fatal Error - returnUrl not Set';
	fnaddtolog($PDO, $action, $userName, $date);
	header("Location: error.php?error=" . $errorCatch);
} else {
$returnUrl = $_POST['returnUrl'];
}
if(!isset($_POST['returnUrlTemplate'])) {
	$errorCatch= 'error-returnUrlTemplate';
	$action = 'Fatal Error - returnUrlTemplate not Set';
	fnaddtolog($PDO, $action, $userName, $date);
	header("Location: error.php?error=" . $errorCatch);
} else {
$returnUrlTemplate = $_POST['returnUrlTemplate'];
}
if(!isset($_POST['returnUrlName'])) {
	$errorCatch= 'error-returnUrlName';
	$action = 'Fatal Error - returnUrlName not Set';
	fnaddtolog($PDO, $action, $userName, $date);
	header("Location: error.php?error=" . $errorCatch);
} else {
$returnUrlName = $_POST['returnUrlName'];
}
	
$subAction = 'pending';
$target_dir = "images/slideimages/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if(empty($imageFileType)){
	$errorCatch= 'error-filenotset';
	$action = 'Fatal Error - File Error';
	fnaddtolog($PDO, $action, $userName, $date);
	header("Location: error.php?error=" . $errorCatch);
}
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
		$subinfo2 = $_FILES["fileToUpload"]["name"];
			$errorCatch= 'error-notvalid';
			$action = 'User Error - File is Not Valid';
			fnaddtolog($PDO, $action, $userName, $date);
			header("Location: error.php?error=" . $errorCatch);
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $errorCatch= 'error-fileexists';
		$action = 'File Conflict - Image Name already in use';
		fnaddtolog($PDO, $action, $userName, $date);
		header("Location: error.php?error=" . $errorCatch);
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large";
	$subinfo = $_FILES["fileToUpload"]["size"];
		$errorCatch= 'error-filetoolarge';
		$action = 'User Error - Image Size is Too Big - ' . $subinfo;
		fnaddtolog($PDO, $action, $userName, $date);
		header("Location: error.php?error=" . $errorCatch);
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$subinfo2 = $_FILES["fileToUpload"]["name"];
 $errorCatch= 'error-notanimage';
			$action = 'User Error - File is Not an Image - (' . $subinfo2 . ')';
			fnaddtolog($PDO, $action, $userName, $date);
			header("Location: error.php?error=" . $errorCatch);
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		$fileName = $_FILES["fileToUpload"]["name"];
		date_default_timezone_set('Europe/London');
		$date = date('Y-m-d H:i:s');
		fnsavefilenametoDB($PDO, $fileName, $date);
		$subAction = 'Success';
		header("Location: " . $returnUrl . ".php?template=" . $returnUrlTemplate . "&screenName=" . $returnUrlName);
    } else {
        echo "Sorry, there was an error uploading your file.";
		$subAction = $subAction . 'Failed';
		 $errorCatch= 'error-failed';
			$action = 'Fatal Error - Unable to move the file or unknown error - (' . $subinfo2 . ')';
			fnaddtolog($PDO, $action, $userName, $date);
			header("Location: error.php?error=" . $errorCatch);
    }
}

function fnsavefilenametoDB($PDO, $fileName, $datestamp) {
		$stmt = $PDO->prepare("INSERT INTO gallery (fileName, dateStamp) VALUES (:fileName, '$datestamp')");
		$stmt->bindParam(':fileName', $fileName);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
		$stmt->execute();
		}catch(PDOException $e){
			print 'Error!: Failed'. $e;
			die();
		}
}



/* LOG ACTION */
$action = 'Uploading Image to Gallery / Log - ' . $subAction;
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG ACTION */


?>