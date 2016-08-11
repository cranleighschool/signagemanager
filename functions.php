<?php
session_start();
if(isset($_SESSION['user']['logged_in']) && $_SESSION['user']['logged_in'] === true) {
	$eMSG = null;
} else {
	if ( basename($_SERVER['SCRIPT_NAME']) == 'index.php') {
		
	} else {
		header('Location: index.php');		
	}
}

if (isset($_GET['logout'])) {
	fnlogout();
}
require_once 'vendor/autoload.php';
require_once 'class.Login.php';


function fnlogout() {
	session_destroy();
	header("Location:index.php");

}
function fnlogin() {
	$login = new Login($_POST['username'], $_POST['p']);
}

//ADMIN FUNCTIONS//
function fnisadmin($PDO, $username) {
	$accessArray = fnglobalquery($PDO, 'groupID', 'permissions', 'username', $username, 1,1,1,1, 'groupID', 'ASC');
	$editedArray = [];
	foreach ($accessArray as $access) {
		$editedArray[] = $access['groupID'];
	}
	$admingroup = 1;
	if(in_array($admingroup, $editedArray)) {
		return "true";
	} else {
		return "false";
	}
}

function fnadminreq($PDO, $username, $isadmin) {
	if ($isadmin == "true") {

	} else {
		$_SESSION['errors']['error5301'] = "Cheeky, you need to be an Admin to Access that page. We are going to have to keep an eye on you" ;
		session_write_close();
		header('Location: index.php');	
		exit;
	}
}


//END OF ADMIN FUCNTIONS
function fnnewscreens($PDO, $username) {
	$accessArray = fnglobalquery($PDO, 'groupID', 'permissions', 'username', $username, 1,1,1,1, 'groupID', 'ASC');
	$editedArray = [];
	foreach ($accessArray as $access) {
		$editedArray[] = $access['groupID'];
	}
	$admingroup = 1;
	if(in_array($admingroup, $editedArray)) {
		$stmt = $PDO->prepare("SELECT * FROM screens");
	} else {
	$newEdited = implode(',', $editedArray);		
	$stmt = $PDO->prepare("SELECT * FROM screens WHERE owner IN ($newEdited)");
	$stmt->bindParam(':username', $username);
	}
	
	try {
		$stmt->execute();
	}catch(PDOException $e){
		print 'Error!: Failed' . $e->getMessage();
		die();
	}	
	$queryResult1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $PDO->prepare("SELECT * FROM screens WHERE owner='TESTTEACHER'");
	$stmt->bindParam(':username', $username);

	try {
		$stmt->execute();
	}catch(PDOException $e){
		print 'Error!: Failed' . $e->getMessage();
		die();
	}	
	$queryResult2= $stmt->fetchAll(PDO::FETCH_ASSOC);
	$queryResult = [];
	
	foreach($queryResult1 as $arr1) {
		$queryResult[] = $arr1;
	}
	foreach($queryResult2 as $arr2) {
		$queryResult[] = $arr2;
	}
	
	return $queryResult;
	
}



function fnscreens($PDO, $username, $adminName) {
		$username = strtoupper($username);
		$adminName = strtoupper($adminName);
		if ($username == $adminName) {
			$result = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
		} else {
			$result = fnglobalquery($PDO, '*', 'screens', 'owner', $username, 1, 1, 1, 1, 'id', 'ASC');
		}
		return $result;
}

function fnglobalquery($PDO, $fncol, $fntable, $fnwhere, $fnequals, $fnandone, $fna1equals, $fnandtwo, $fna2equals, $fnorderby, $fnsort) {
	$stmt = $PDO->prepare("SELECT $fncol FROM $fntable WHERE $fnwhere=:fnequals AND $fnandone=:fna1equals AND $fnandtwo=:fna2equals ORDER BY $fnorderby $fnsort");
	$stmt->bindParam(':fnequals', $fnequals);
	$stmt->bindParam(':fna1equals', $fna1equals);
	$stmt->bindParam(':fna2equals', $fna2equals);			
			
	try {
		$stmt->execute();
	}catch(PDOException $e){
		print 'Error!: Failed' . $e->getMessage();
		die();
	}	
	$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $queryResult;

}

function fncheckfortitle($check, $default) {
	if(!isset($check)) {
		return $default;
	} else {
		return $check;
	}
}
function fnconverttemplatename($PDO, $templateName) {

	$stmt = $PDO->prepare("SELECT 'title' FROM templates WHERE className='$templateName'");
	$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	try {
			$stmt->execute();
			}catch(PDOException $e){
				print 'Error!: Failed' . $e->getMessage();
				die();
		$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $queryResult;
	
		}
}
// FUNCTION TO DETERMINE NAV MENU HIGHLIGHTING BASED ON AN ACTIVE PAGE
function fnactivepage($currentpage, $sessionpage) {
	if ($currentpage === $sessionpage) {
		echo "active";
	} else {
		//NOTHING TO DISPLAY HERE
	}
}
// FUNCTION TO DETERMINE NAV MENU HIGHLIGHTING BASED ON AN ACTIVE PAGE
function fnactivepage2($linkpage) {
	$sessionpage = basename($_SERVER['SCRIPT_NAME']);
	if ($linkpage === $sessionpage) {
		echo "active";
	} else {
		//NOTHING TO DISPLAY HERE
	}
}


function fnslidesindate($PDO, $fntable, $fnqcol, $fnitem) {
			date_default_timezone_set('Europe/London');
			$date = date('Y-m-d H:i:s');
			$sql = "SELECT * FROM $fntable WHERE $fnqcol='$fnitem' AND endDate > '$date' AND startDate < '$date' ORDER BY orderNumber ASC;";
			$stmt = $PDO->query($sql);
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(!empty($stmt)){
			$stmt->setFetchMode(PDO::FETCH_BOTH);
			$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $queryResult;
			} else {
				$queryResult = array(
					0 => array(
						'title' => 'None Set',
						'message' => 'None Set',
						'template' => 'main_photo_landscape',
						'orderNumber' => 1,
						'picture' => 'imagenotset.jpg',
						'where' => 'None Set',
						'when' => 'None Set',
						'who' => 'None Set',
						'why' => 'None Set',
						'fontSize' => 80,
						'lineHeight' => 80,
						'background' => 'bg1.jpg',
					),
					);
					return $queryResult;
			}
		}
		
	function fnnextorder($PDO, $fntable) {
		$queryOrder = fnglobalquery($PDO, 'orderNumber', $fntable, 1, 1, 1, 1, 1, 1, 'orderNumber', 'DESC');
		$thequeryOrder = $queryOrder[0]['orderNumber'];
		$currentOrder = $thequeryOrder + 1;
		echo $currentOrder;
	
		}
		
		function fnnextslideid($PDO, $tableName, $orderNumber) {
			$sql = "SELECT * FROM $tableName WHERE orderNumber > $orderNumber ORDER BY orderNumber ASC";
			$stmt = $PDO->query($sql);
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt->setFetchMode(PDO::FETCH_BOTH);
			$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			if(empty($queryResult)){
				$sql = "SELECT * FROM $tableName WHERE orderNumber < $orderNumber ORDER BY orderNumber ASC";
				$stmt = $PDO->query($sql);
				$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt->setFetchMode(PDO::FETCH_BOTH);
				$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $queryResult;
			} else {
			return $queryResult;
			}
		}
		function fnprevslideid($PDO, $tableName, $orderNumber) {
			$sql = "SELECT * FROM $tableName WHERE orderNumber < $orderNumber ORDER BY orderNumber DESC";
			$stmt = $PDO->query($sql);
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt->setFetchMode(PDO::FETCH_BOTH);
			$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			if(empty($queryResult)){
				$sql = "SELECT * FROM $tableName WHERE orderNumber > $orderNumber ORDER BY orderNumber DESC";
				$stmt = $PDO->query($sql);
				$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt->setFetchMode(PDO::FETCH_BOTH);
				$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $queryResult;
			} else {
			return $queryResult;
			}
		}
		function fnnextscreenid($PDO, $tableName, $screenid) {
			$sql = "SELECT * FROM $tableName WHERE id > $screenid ORDER BY id ASC";
			$stmt = $PDO->query($sql);
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt->setFetchMode(PDO::FETCH_BOTH);
			$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(empty($queryResult)){
				$sql = "SELECT * FROM $tableName WHERE id < $screenid ORDER BY id ASC";
				$stmt = $PDO->query($sql);
				$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt->setFetchMode(PDO::FETCH_BOTH);
				$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $queryResult;
			} else {
			return $queryResult;
			}
		}
		function fnprevscreenid($PDO, $tableName, $screenid) {
			$sql = "SELECT * FROM $tableName WHERE id < $screenid ORDER BY id DESC";
			$stmt = $PDO->query($sql);
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt->setFetchMode(PDO::FETCH_BOTH);
			$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(empty($queryResult)){
				$sql = "SELECT * FROM $tableName WHERE id > $screenid ORDER BY id DESC";
				$stmt = $PDO->query($sql);
				$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt->setFetchMode(PDO::FETCH_BOTH);
				$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $queryResult;
			} else {
			return $queryResult;
			}
		}
		
		function fnhideornot($is_title) {
			if($is_title == 'yes') {
				
			} else {
				echo 'display: none;';
			}
		}
		function fnforminputornot($is_title) {
			if($is_title == 'yes') {
				echo '';
			} else {
				echo 'hidden';
			}
		}
				function fntemplatehide($is_title) {
			if($is_title == 'yes') {
				echo 'style="opacity: 1;"';
			} else {
				echo 'style="opacity: 0;"';
			}
		}
		
		function fncountOrder($PDO, $tableName) {
								$sql = "SELECT orderNumber FROM $tableName ORDER BY orderNumber DESC";
								$stmt = $PDO->query($sql);
								$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$stmt->setFetchMode(PDO::FETCH_BOTH);
								$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
								$highest = $queryResult[0]['orderNumber'];
								return $highest;
							}
		function fncheckOption($PDO, $i, $tableName) {
								$sql = "SELECT orderNumber FROM $tableName WHERE orderNumber=$i ORDER BY orderNumber DESC";
								$stmt = $PDO->query($sql);
								$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$stmt->setFetchMode(PDO::FETCH_BOTH);
								$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
								if(empty($queryResult)){
									?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php
								} else {
								?>
									<option value="<?php echo $i; ?>" style="background-color: rgba(0,0,0,0.2); color: white;" disabled><?php echo $i; ?> - (In Use)</option>
								<?php
								}
		}
		function fncheckeditOption($PDO, $i, $tableName, $slideid) {
								$sql = "SELECT orderNumber FROM $tableName WHERE orderNumber=$i ORDER BY orderNumber DESC";
								$stmt = $PDO->query($sql);
								$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$stmt->setFetchMode(PDO::FETCH_BOTH);
								$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

								if($i == $slideid) { ?>
									<option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
								<?php
								} else {
								if(empty($queryResult)){
									?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php
								} else {
								?>
									<option value="<?php echo $i; ?>" style="background-color: rgba(0,0,0,0.2); color: white;" disabled><?php echo $i; ?> - (In Use)</option>
								<?php
								} }
		}
		
		function fncheckslideActive($PDO, $startDate, $endDate, $screenTable) {
			date_default_timezone_set('Europe/London');
			$date = date('Y-m-d H:i:s');
			if($startDate < $date) {
				if($endDate > $date) {
					echo 'style="color: lightGreen; -webkit-text-stroke-width: 2px; -webkit-text-stroke-color: black;"';
				} else { echo 'style="color: red; -webkit-text-stroke-width: 2px; -webkit-text-stroke-color: black;"'; }
			} else {
				echo 'style="color: red; -webkit-text-stroke-width: 2px; -webkit-text-stroke-color: black;"';
			}
			
		}
		
		function fncountactiveslides($PDO, $tableName) {
			date_default_timezone_set('Europe/London');
			$date = date('Y-m-d H:i:s');
			$sql = "SELECT * FROM $tableName WHERE endDate > '$date' AND startDate < '$date' ORDER BY orderNumber ASC;";
			$stmt = $PDO->query($sql);
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(!empty($stmt)){
			$stmt->setFetchMode(PDO::FETCH_BOTH);
			$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$number = count($queryResult);
			return $number;
		} else {
			return 0;
		}
		}
		
		function fngetlatestscreenid($PDO) {
			$stmt = $PDO->prepare("SELECT * FROM screens ORDER BY id DESC");	
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
				try {
			$stmt->execute();
			}catch(PDOException $e){
				print 'Error!: Failed' . $e->getMessage();
				die();
			}	
			$queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $queryResult[0]['id'];
			
			}
			
			
			function fnaddtolog($PDO, $action, $userName, $date) {
$stmt = $PDO->prepare("INSERT INTO userlog (action, userName, dateStamp) VALUES (:action, :userName, :date)");	
$stmt->bindParam(':action', $action);
$stmt->bindParam(':userName', $userName);
$stmt->bindParam(':date', $date);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
$stmt->execute();
}catch(PDOException $e){
	print 'Error!: Failed' . $e->getMessage();
    die();
}	
}

	function fngallerydeletecheck($PDO, $imageFileName, $imageID) {
		$screenCount = fnglobalquery($PDO, 'id', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
		$isOK = 0;
		
		foreach($screenCount as $screenLoop) {
			$screenTable = 'screen' . $screenLoop['id'];
			$findFile = fnglobalquery($PDO, 'id', $screenTable, 'picture', $imageFileName, 1, 1, 1, 1, 'id', 'ASC');
			if(!empty($findFile)) {
				$isOK = 1;
				?>
				<a onclick="return confirm('Sorry! This image is in use on a slide')" data-toggle="tooltip" title="Delete Image" href="#">
				<?php
				break;
			}
			if($isOK == 1) {
				break;
			}
		}
		
		if($isOK == 1) {
		} else {
			?>
			<a onclick="return confirm('Are you sure you want to delete this Image?')" data-toggle="tooltip" title="Delete Image" href="deleteimage.php?id=<?php echo $imageID; ?>&returnUrl=gallery">
			<?php
		}
	}
	
		function fnslidewizarddeletecheck($PDO, $imageFileName, $imageID, $returnUrlName, $returnUrlTemplate) {
		$screenCount = fnglobalquery($PDO, 'id', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
		$isOK = 0;
		
		foreach($screenCount as $screenLoop) {
			$screenTable = 'screen' . $screenLoop['id'];
			$findFile = fnglobalquery($PDO, 'id', $screenTable, 'picture', $imageFileName, 1, 1, 1, 1, 'id', 'ASC');
			if(!empty($findFile)) {
				$isOK = 1;
				?>
				<a onclick="return confirm('Sorry! This image is in use on a slide')" data-toggle="tooltip" title="Delete Image" href="#">
				<?php
				break;
			}
			if($isOK == 1) {
				break;
			}
		}
		
		if($isOK == 1) {
		} else {
			?>
			<a onclick="return confirm('Are you sure you want to delete this Image?')" data-toggle="tooltip" title="Delete Image" href="deleteimage.php?id=<?php echo $imageID; ?>&returnUrl=slidewizard2&returnUrlName=<?php echo $returnUrlName; ?>&returnUrlTemplate=<?php echo $returnUrlTemplate; ?>">
			<?php
		}
}