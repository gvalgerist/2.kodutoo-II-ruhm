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
		
		savecar($cleanInput($_POST["plate"]), $_POST["color"]);
		
		
	}

	$cardata=getallcars();
	echo"<pre>";
	var_dump($cardata);
	echo"</pre>";
	
?>
<h1>Data</h1>

<p>
	Tere tulemast <?=$_SESSION["userEmail"];?>
	<a href="?logout=1">Logi valja</a>

</p>

	<form method="POST">

		<label>Salvesta auto</label><br><br>
	
		<label>Auto number</label><br>
		<input name="plate" type="text" placeholder="123 ABC"><br><br>
	
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


