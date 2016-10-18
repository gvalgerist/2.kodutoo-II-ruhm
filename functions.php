<?php
	
	require("../../config.php");
	
	//functions.php
	//var_dump($GLOBALS);
	
	
	//see fail peab olema koikidel lehtedel kus tahan kasutada SESSION muutujat
	session_start();
	
	//***************
	//****SIGNUP*****
	//***************
	
	function signUp ($email, $password, $gender, $signupAge, $signupCountry, $signupCity, $signupShoesize) {
		
		$database = "if16_georg";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("INSERT INTO proov1(email, password, gender, age, country, city, shoesize) VALUES(?, ?, ?, ?, ?, ?, ?)");
	
		echo $mysqli->error;
		
		$stmt->bind_param("sssssss", $email, $password, $gender, $signupAge, $signupCountry, $signupCity, $signupShoesize);
		
		if($stmt->execute()) {
			
			echo "salvestamine onnestus";
			
		} else {
			
			echo "ERROR".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}

	function login($email, $password) {
		
		$error="";
		
		$database = "if16_georg";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("SELECT id, email, password, created FROM proov1 WHERE email=?");
	
		echo $mysqli->error;
		
		
		//asendan kysimargi
		$stmt->bind_param("s", $email);
		
		//maaran vaartused muutujatesse
		$stmt->bind_result($id, $emailFromDb,$passwordFromDb, $created);
		
		$stmt->execute();
		
		//kas andmed tulid v mitte
		if($stmt->fetch()){
			
			//oli selline meil
			$hash=hash("sha512", $password);
			if($hash==$passwordFromDb){
				
				echo"Kasutaja logis sisse ".$id;
				
				$_SESSION["userId"]=$id;
				$_SESSION["userEmail"]=$emailFromDb;
				
				header("Location: data.php");
				exit();
				
			}else {
				$error="Vale parool";
			}
			
			
		}else{
			
			//ei olnud seda meili
			$error="Ei ole sellist emaili";
			
		}
		
		return $error;
	
	}

	function savecar ($plate, $color) {
		
		$database = "if16_georg";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("INSERT INTO cars_and_colors(plate, color) VALUES(?, ?)");
	
		echo $mysqli->error;
		
		$stmt->bind_param("ss", $plate, $color);
		
		if($stmt->execute()) {
			
			echo "salvestamine onnestus";
			
		} else {
			
			echo "ERROR".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	function getallcars() {
		
		$database = "if16_georg";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt=$mysqli->prepare("
			SELECT id, plate, color
			FROM cars_and_colors
		");
		
		$stmt->bind_result($id, $plate, $color);
		$stmt->execute();
		
		$result=array();
		
		while($stmt->fetch()) {
			
			$car= new stdclass();
			
			$car->id=$id;
			$car->plate=$plate;
			$car->color=$color;
			
			//echo $plate."<br>";
			array_push($result, $car);
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $result;
	}
	
	function cleanInput($input){
		
		$input=trim($input);
		$input=stripslashes($input);
		$input=htmlspecialchars($input);
		
		return $input;
	}
	
	function saveInterest ($interest) {
  		
 		$database = "if16_georg";
 		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
 
 		$stmt = $mysqli->prepare("INSERT INTO interests (interest) VALUES (?)");
  	
 		echo $mysqli->error;
 		
 		$stmt->bind_param("s", $interest);
 		
 		if($stmt->execute()) {
 			echo "salvestamine õnnestus";
 		} else {
 		 	echo "ERROR ".$stmt->error;
 		}
 		
 		$stmt->close();
 		$mysqli->close();
 		
 	}
 	
 	function getAllInterests() {
 		
 		$database = "if16_georg";
 		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
 		
 		$stmt = $mysqli->prepare("
 			SELECT id, interest
			FROM interests
 		");
 		echo $mysqli->error;
		
		
 		$stmt->bind_result($id, $interest);
 		$stmt->execute();
 		
 		
 		//tekitan massiivi
 		$result = array();
 		
 		// tee seda seni, kuni on rida andmeid
 		// mis vastab select lausele
 		while ($stmt->fetch()) {
 			
 			//tekitan objekti
 			$i = new StdClass();
 			
 			$i->id = $id;
 			$i->interest = $interest;
 		
 			array_push($result, $i);
 		}
 		
 		$stmt->close();
 		$mysqli->close();
 		
 		return $result;
 	}
	
	function getAllUserInterests() {
 		
 		$database = "if16_georg";
 		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
 		
 		$stmt = $mysqli->prepare("
 			SELECT interest FROM interests
			JOIN user_interests
			ON interests.id=user_interests.interest_id
			WHERE user_interests.user_id = ?
 		");
 		echo $mysqli->error;
 		$stmt->bind_param("i", $_SESSION["userId"]);
		
		
 		$stmt->bind_result($interest);
 		$stmt->execute();
 		
 		
 		//tekitan massiivi
 		$result = array();
 		
 		// tee seda seni, kuni on rida andmeid
 		// mis vastab select lausele
 		while ($stmt->fetch()) {
 			
 			//tekitan objekti
 			$i = new StdClass();
 			
 			$i->interest = $interest;
 		
 			array_push($result, $i);
 		}
 		
 		$stmt->close();
 		$mysqli->close();
 		
 		return $result;
 	}
	
	function saveUserInterest ($interest) {
  		
 		$database = "if16_georg";
 		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
 
		$stmt = $mysqli->prepare("SELECT id FROM user_interests WHERE user_id=? AND interest_id=?");
		
		$stmt->bind_param("ii", $_SESSION["userId"],$interest);
		$stmt->bind_result($id);
		
		$stmt->execute();
		
		if ($stmt->fetch()) {
			
			echo "juba olemas";
			return;
		
		}
		
		$stmt->close();
		
		$stmt = $mysqli->prepare("INSERT INTO user_interests (user_id, interest_id) VALUES (?, ?)");
		$stmt->bind_param("ii", $_SESSION["userId"],$interest);
		
		if($stmt->execute()) {
			
			echo"salvestamine onnestus";
			
		} else {
		
			echo "ERROR: ".$stmt->error;
		
		}
		
 	}
	
	
	
	
?>