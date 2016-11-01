<?php

	require("functions.php");

	//kui ei ole kasutaja id'd
	if(!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
		
	}



	if(isset($_GET["logout"])){
		
		session_destroy();
		header("Location:login.php");
		exit();
		
	}

	
	if(isset($_POST["contactemail"]) && isset($_POST["description"]) && isset($_POST["price"]) &&
		!empty($_POST["contactemail"]) && !empty($_POST["description"]) && !empty($_POST["price"])
		) {
		
		savesneaker(cleanInput($_POST["contactemail"]), cleanInput($_POST["description"]), cleanInput($_POST["price"]));
		
		
	}
	
	$sneakerdata=getallsneakers();
?>

<h1>
	Welcome<a href="user.php"> <?=$_SESSION["userEmail"];?></a>!
</h1>
<p>
	<a href="profile.php">Minu profiil</a>
	<br><a href="?logout=1">Logi valja</a>

</p>

<h2>Sell Sneakers</h2>

	<form method="POST">

		<label><b>Create a post</b></label><br><br>
	
		<label>Description</label><br>
		<textarea rows="2" cols="40" name="description" type="text" maxlength="50" placeholder="ex. Air Jordan X Retro 'OVO', size 43"></textarea><br><br>
		
		<label>Price ($)</label><br>
		<input name="price" type="integer" placeholder="ex. 490"><br><br>
		
		<label>Contact E-Mail</label><br>
		<input name="contactemail" type="text" value="<?=$_SESSION["userEmail"];?>">
		
		<br><br>
		<input type="submit" value="Save & Post">



	</form>
	
<h2>Market</h2>
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
