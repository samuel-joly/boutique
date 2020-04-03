
<!DOCTYPE html>

<html lang='en'>
	<head>
		<title>Boutique</title>
		<link rel='stylesheet' type='text/css' href="CSS/stylesheet.css" />		
		<link rel="stylesheet" type="text/css" href="CSS/boot.css"/>
		<meta charset='UTF-8'>
	</head>

	<body id='inscription-body'>
		<header> 
			<?php 
				include("header.php");
				
				if(!isset($_SESSION["id"]))
				{
					header("location:connexion.php");
				}

				$usr = $stmt->query("SELECT * FROM users WHERE id =".$_SESSION["id"])->fetch(PDO::FETCH_ASSOC);
			?> 
		</header>
		
		<main class='flexr just-center align-center'>
			
			
			<div id='profil-container' class='flexc just-around'>
				<h1 class='center'><u><?=$usr["name"]?></u></h1>
				<img src='Media/Images/Avatars/<?=$usr["avatar"]?>' id='profil-image'/>

				<span id='profil-data' class='flexr wrap'>
					<a href='profil.php?show_bought=true'>Your purchases</a>
					<a href='profil.php?show_basket=true'>Your basket</a>
					<a href='profil.php?show_comments=true'>Your comments</a>
					<a href='profil.php?show_note=true'>Your notes</a>
				</span>


			</div>
			
		</main>
	</body>
</html>
