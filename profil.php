<<<<<<< HEAD
<DOCTYPEtml>
=======
<!DOCTYPE html>
>>>>>>> master

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
		
<<<<<<< HEAD
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
=======
		<main class='flexr just-center align-center' >

			<?php if(isset($_GET["show"]))
				{
					switch($_GET["show"])
					{
						case "bought": 
							echo "<div class='flexc just-center align-center' id='bought-zone'>";	
							$bought = $stmt->query("SELECT *, users.id AS product_id ,
							users.name AS agent_name FROM bought
							INNER JOIN products ON bought.id_product = products.id
							INNER JOIN agents ON products.id_agent = agents.id
							INNER JOIN users ON agents.id_user = users.id
							WHERE bought.id_user =".$_SESSION["id"])->fetchAll(PDO::FETCH_ASSOC);
							if(!empty($bought))
							{
								foreach($bought as $product)
								{
								echo "<div class='profil-data-container'>";
									echo "<div class='bought-product-zone flexr just-between align-center'>";
									echo "<div class='flexc just-start align-start bought-product-title'>";
										echo "<h1><u>".$product["title"]."</u></h1>";
										echo "<p>".$product["price"]."$</p>";
										echo "<p>".$product["date"]."</p>";
										echo "<p class='bought-product-desc'>".$product["description"]."</p>";
									echo "</div>";
									echo "<div class='bought-agent-zone flexc align-center just-center'>";
										echo "<img src='".$product["image"]."' class='bought-product-image'/>";
										echo "<h2>Sold by <b>".$product["agent_name"]."</b></h2>";
										echo "<span class='flexr just-center align-center center'>";
										for($i=1;$i<=5;$i++) {
											echo "<a href='profil.php?show=bought&&rate=".$i."&&id=".$product["product_id"]."'>
											<img src='Media/Images/Assets/empty-star.png' class='rating-star'/>
											</a>";
										}
										echo "</span>";
									echo "</div>";
									echo "</div>";
								echo "</div>";
								}
							}
							echo "</div>";	
						break;	
							
						case "cart":

							echo "<div class='profil-data-container'>";
								
								
							echo "</div>";
						break;	
					}
				}

				if(isset($_GET["rate"]))
				{
					echo "<a href='profil.php?show=bought' class='alert-body'>";
					echo "</a>";
					echo "<div class='alert-container'>";
						// Recup data produit  + agent + rating
						// Demande commentaire
						// demander validation 
						// Maj agen + Maj commentaire
						// retour a la page profil.php?show=bought
					echo "</div>";
				}
			?>
			
			<form action='profil.php' method='POST' id='profil-container' class='flexc just-around'>
				<h1 class='center'><u><?=$usr["name"]?></u></h1>
				<label for='avatar-input' id='image-container'>
					<div  href='profil.php?image=true'>
						<img src='Media/Images/Avatars/<?=$usr["avatar"]?>' id='profil-image'/>
						<span>
							<p>Click to change</p>
						</span>
					</div>
					<input type='file' name='avatar' id='avatar-input'/>
				</label>

				<span id='profil-data' class='flexc wrap align-center center'>
					<a href='profil.php?show=cart'>Your cart</a>
					<a href='profil.php?show=bought'>Your purchases</a>
				</span>
				
				<label for='name' class='center input-zone just-between align-center'>Name
					<input type='text' value='<?=$usr["name"]?>' name='name'/>
				</label>

				<label for='password' class='center input-zone just-between align-center'>Password
					<input type='password' name='password'/>
				</label>


				<label for='Npassword' class='center input-zone just-between align-center'>New Password 
					<input type='password'  name='Npassword'/>
				</label>
				
				<label for='CNpassword' class='center input-zone just-between align-center'>Confirm Password 
					<input type='password'  name='CNpassword'/>
				</label>

				<input type='submit' value='Save' name='save_btn' class='profil-submit'/>
				
			</form>
>>>>>>> master
			
		</main>

		<footer>
			<?php include("footer.php") ?>
		</footer>
	</body>
</html>
