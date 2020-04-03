<DOCTYPEtml>

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

			<?php if(isset($_GET["show"]))
				switch($_GET["show"])
				{
					case "bought": 

						echo "<div class='profil-data-container'>";
							
							
						echo "</div>";
						
					 break;	

						
					case "basket":

						echo "<div class='profil-data-container'>";
							
							
						echo "</div>";
					break;	


					case "comments":

						echo "<div class='profil-data-container'>";
							
							
						echo "</div>";
					break;	


					case "note":

						echo "<div class='profil-data-container'>";
							
							
						echo "</div>";
					break;	
				}


			?>
			<div id='profil-container' class='flexc just-around'>
				<h1 class='center'><u><?=$usr["name"]?></u></h1>
				<img src='Media/Images/Avatars/<?=$usr["avatar"]?>' id='profil-image'/>

				<span id='profil-data' class='flexr wrap'>
					<a href='profil.php?show=bought'>Your purchases</a>
					<a href='profil.php?show=basket'>Your basket</a>
					<a href='profil.php?show=comments'>Your comments</a>
					<a href='profil.php?show=note'>Your notes</a>
				</span>
			</div>
			
		</main>

		<footer>
			<?php include("footer.php") ?>
		</footer>
	</body>
</html>
