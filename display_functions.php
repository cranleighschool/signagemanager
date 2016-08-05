<?php

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
						'background' => 'background.jpg',
					),
					);
					return $queryResult;
			}
		}


?>