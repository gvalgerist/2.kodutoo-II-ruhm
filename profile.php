<?php 
	
	
	require("functions.php");
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	//echo $_SESSION["userId"];
	//profileInfo();
	
	//andmete muutmine
	//parooli vahetus
	//kui unustad parooli
	
	$sneakerdata=getallusersneakers();
	
	
?>

<h1>Your Profile</h1><h2><a href="data.php">Back</a></h2>
<h2>	
	Email: <?php profileEmail(); ?><br>
	Gender: <?php profileGender(); ?><br>
	Age: <?php profileAge(); ?><br>
	Country: <?php profileCountry(); ?><br>
	City: <?php profileCity(); ?><br>
	Shoe Size: <?php profileShoesize(); ?><br>
	Created: <?php profileCreated(); ?>
</h2>

<h1>Your Market</h1>
<?php

	$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>Contact E-Mail</th>";
		$html .= "<th>Description</th>";
		$html .= "<th>Price ($)</th>";
	$html .= "</tr>";
	
	foreach($sneakerdata as $c) {
		
		$html .= "<tr>";
			$html .= "<td>".$c->contactemail."</td>";
			$html .= "<td>".$c->description."</td>";
			$html .= "<td>".$c->price."</td>";
			//$html .= "<td><a href='edit.php?contactemail=".$c->contactemail."'>edit.php</a></td>";
		$html .= "</tr>";
		
	}

	$html .= "</table>";

	echo $html;


?>

