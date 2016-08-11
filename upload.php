<?php
include('conn.php');
include('functions.php');
/* LOG INFO */
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
$userName = 'tbc';
/* END OF LOG INFO */

$returnUrl = $_POST['returnUrl'];
$returnUrlTemplate = $_POST['returnUrlTemplate'];
$returnUrlName = $_POST['returnUrlName'];

$target_dir = "images/slideimages/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $subAction = "Sorry, file already exists - " . $_FILES["fileToUpload"]["name"];
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "Sorry, your file is too large";
    $subAction = "Sorry, your file is too large - " . $_FILES["fileToUpload"]["size"];
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $subAction = "Sorry, only JPG, JPEG, PNG & GIF files are allowed. - " . $_FILES["fileToUpload"]["name"];
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
		$subAction = 'Success - ' . $fileName;
		header("Location: " . $returnUrl . ".php?template=" . $returnUrlTemplate . "&screenName=" . $returnUrlName);
    } else {
        echo "Sorry, there was an error uploading your file.";
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
$action = 'Uploaded Image to Gallery / Log - ' . $subAction;
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG ACTION */


?>