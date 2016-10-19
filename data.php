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

	
	if(isset($_POST["plate"]) && isset($_POST["color"]) &&
		!empty($_POST["plate"]) && !empty($_POST["color"])
		) {
		
		savecar(cleanInput($_POST["plate"]), cleanInput($_POST["color"]));
		
		
	}

	$cardata=getallcars();
	//echo"<pre>";
	//var_dump($cardata);
	//echo"</pre>";
	
?>
<h1>Oled sisse logitud (DATA)</h1>

<p>
	Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?></a>!<br>
	<br><a href="profile.php">Minu profiil</a>
	<br><a href="?logout=1">Logi valja</a>

</p>

	<form method="POST">

		<h2>Salvesta auto</h2>
	
		<label>Auto number</label><br>
		<input name="plate" type="text" placeholder="123ABC"><br><br>
	
		<label>Auto varv</label><br>
		<input name="color" type="color">

		<br><br>
		<input type="submit" value="Salvesta">



	</form>

<h2>Autod</h2>
<?php

	$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>plate</th>";
		$html .= "<th>color</th>";
	$html .= "</tr>";
	
	foreach($cardata as $c) {
		//echo $c->plate."<br>";
		
		$html .= "<tr>";
			$html .= "<td>".$c->id."</td>";
			$html .= "<td>".$c->plate."</td>";
			$html .= "<td style='color:".$c->color."'>".$c->color."</td>";
		$html .= "</tr>";
		
	}

	$html .= "</table>";

	echo $html;


?>

<h2>Sneakers</h2>

	<form method="POST">

		<label><b>Create a post</b></label><br><br>
	
		<label>Title</label><br>
		<input name="title" type="text" placeholder="Title"><br><br>
	
		<label>Description</label><br>
		<textarea rows="6" cols="80" name="description" type="text" placeholder="test"></textarea>
		
		
		<br><br>
		<input type="submit" value="Save & Post">



	</form>


