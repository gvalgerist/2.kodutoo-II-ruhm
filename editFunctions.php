<?php
	require_once("../../config.php");
	
	function getSingleSneakerData($contactemail){
    
        $database = "if16_georg";
		//echo "id on ".$edit_id;
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("SELECT description, price FROM sneakers WHERE id=?");
		$stmt->bind_param("s", $contactemail);
		$stmt->bind_result($description, $price);
		$stmt->execute();
		
		//tekitan objekti
		$sneaker = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$sneaker->description = $description;
			$sneaker->price = $price;
			
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $sneaker;
		
	}
	function updatesneaker($contactemail, $description, $price){
    	
        $database = "if16_georg";
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("UPDATE sneakers SET description=?, price=? WHERE contactemail=?");
		$stmt->bind_param("sss",$description, $price, $contactemail);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	
?>