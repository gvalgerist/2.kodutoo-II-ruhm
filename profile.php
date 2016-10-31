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
	
?>

<h1>Minu Profiil</h1><h2><a href="data.php">Tagasi</a></h2><br><br>
<h2>	
	Email: <?php profileEmail(); ?><br>
	Gender: <?php profileGender(); ?><br>
	Age: <?php profileAge(); ?><br>
	Country: <?php profileCountry(); ?><br>
	City: <?php profileCity(); ?><br>
	Shoe Size: <?php profileShoesize(); ?><br>
	Created: <?php profileCreated(); ?>
</h2>

