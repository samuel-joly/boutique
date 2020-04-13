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

				if(isset($_POST["profil-comment-input"]))
				    {
					    if(strlen($_POST["comment"]) > 0)
					    {
						    $comment = htmlspecialchars(addslashes($_POST["comment"]));
						    $stmt->query("INSERT INTO `comments`(`id`, `id_creator`, `id_agent`,
						    `date`, `comment`, `id_product`) VALUES (NULL, ".$_SESSION["id"].", ".$_GET["id_agent"].",
						    CURRENT_DATE, '".$comment."', ".$_GET["id_prod"].")");

						    $stmt->query("INSERT INTO `ratings`(`id`,`id_agent`,`value`,`id_creator`, `id_product`) VALUES
						    (NULL, ".$_GET["id_agent"].", ".$_GET["rate"].", ".$_SESSION["id"].", ".$_GET["id_prod"].")");
					    }
					    header('location:profil.php?show=bought');
				    }

				if(isset($_GET["rate"]))
				{
				    $comm = $stmt->query("SELECT * FROM comments WHERE id_creator =".$_SESSION["id"]." AND comments.id_product=".$_GET["id_prod"])->fetch();
				    $rate = $stmt->query("SELECT * FROM ratings WHERE id_creator =".$_SESSION["id"]." AND ratings.id_product =".$_GET["id_prod"])->fetch();
				    if(!empty($comm) || !empty($rate))
				    {
					header("location:profil.php?show=bought");
				    }
			    }
			    $usr = $stmt->query("SELECT * FROM users WHERE id =".$_SESSION["id"])->fetch(PDO::FETCH_ASSOC);
		    ?> 
	    </header>
	    
	    <main class='flexr just-center align-center' >

		    <?php if(isset($_GET["show"]))
			    {
				    switch($_GET["show"])
				    {
					    case "bought": 
						    echo "<div class='flexc just-center align-center' id='bought-zone'>";	
						    $bought = $stmt->query("SELECT 
						    products.title, products.price, products.description, products.image, products.id,
						    users.id AS agent_id ,users.name AS agent_name,
						    ratings.value AS rate, bought.date
						    FROM bought
						    INNER JOIN products ON bought.id_product = products.id
						    INNER JOIN agents ON products.id_agent = agents.id
						    INNER JOIN users ON agents.id_user = users.id
						    LEFT JOIN ratings ON products.id = ratings.id_product
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
									    	    if($i < $product["rate"]+1)
										    {

											echo "<a href=''>
											<img src='Media/Images/Assets/star.png' class='rating-star'/>
											</a>";
										    }
										    else
										    {
										    
											echo "<a href='profil.php?show=bought&&rate=".$i."&&id_agent=".$product["agent_id"]."&&id_prod=".$product["id"]."'>
											<img src='Media/Images/Assets/empty-star.png' class='rating-star'/>
											</a>";
										    }
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
					    foreach($bought as $product)
					    {
						    if($product["id"] == $_GET["id_prod"])
							{
								$bought = $product;
								break;
							}
						}
						echo "<h1> You rated <u>".$bought["agent_name"]."</u> to ".$_GET["rate"]."/5 for ".$bought["title"]."</h2>";
						echo "<p>For submitting your rating, please leave a comment:</p>";
						echo "<form action='profil.php??show=bought&&rate=".$_GET["rate"]."&&id_agent=".$_GET["id_agent"]."&&id_prod=".$_GET["id_prod"]."' method='post' id='profil-rate-form'>
							<textarea name='comment' cols='80' rows='10' maxlength='255'></textarea>
							<input type='submit' value='envoyer' name='profil-comment-input'/>
							</form>";
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
			
		</main>

		<footer>
			<?php include("footer.php") ?>
		</footer>
	</body>
</html>
