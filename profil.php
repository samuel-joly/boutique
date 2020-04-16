<!DOCTYPE html>

<html lang='en'>
	<head>
		<title>Boutique</title>
		<link rel='stylesheet' type='text/css' href="CSS/stylesheet.css" />		
		<link rel="stylesheet" type="text/css" href="CSS/boot.css"/>
		<link rel="stylesheet" type="text/css" href="CSS/profil.css">
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
					    unset($_POST);
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
							    
							    
						    echo "</div";
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

			    $link = $_SERVER["HTTP_REFERER"];
			?>
			
			<form action='<?= $link ?>' enctype='multipart/form-data' method='POST' id='profil-container' class='flexc just-around'>
				<h1 class='center'><u><?=$usr["name"]?></u></h1>
				<label for='avatar-input' id='image-container'>
					<div id='sub-img-container'>
						<img src='Media/Images/Avatars/<?=$usr["avatar"]?>' alt='Img not found' id='profil-image'/>
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

				<label for='mail' class='center input-zone just-between align-center'>Email
					<input type='email' value='<?=$usr["email"]?>' name='mail'/>
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

				<?php
					if(isset($_POST["save_btn"]))
					{
						$name = htmlspecialchars(addslashes($_POST["name"]));
						if(password_verify($_POST["password"],$usr["password"]))
						{
							if($name != $usr["name"])
							{
							    if ($stmt->query("UPDATE users SET name='".$name."' WHERE id=".$_SESSION["id"]))
							    {
							    	echo "<p class='error'>User name changed to ".$name."</p>";
								unset($name);
								unset($_POST["name"]);
							    }
							}
							if($_POST["mail"] != $usr["email"])
							{
								if($stmt->query("UPDATE users SET email='".$_POST["mail"]."' WHERE id=".$_SESSION["id"]))	
								{
									echo "<p class='error'>Your email has been changed</p>";
									unset($_POST["mail"]);
								}
							}
							if(strlen($_POST["Npassword"]) > 0)
							{
								if($_POST["Npassword"] == $_POST["CNpassword"])
								{
									if(!password_verify($_POST["Npassword"], $usr["password"]))
									{
										$password = password_hash($_POST["Npassword"], PASSWORD_BCRYPT);
										if($stmt->query("UPDATE users SET password='".$password."' WHERE id=".$_SESSION["id"]))
										{
											echo "<p class='error'>Your password has been changed</p>";
											unset($_POST["Npassword"]);
											unset($_POST["CNpassword"]);
										}
									}
									else
									{
										echo "<p class='error'>Your password still the same</p>";
										die;
									}
								}
								else
								{
									echo "<p class='error'>New password doesnt match with confirm password</p>";
									unset($_POST["Npassword"]);
									unset($_POST["CNpassword"]);
									die;
								}
							}
							if(isset($_FILES["avatar"]))
							{
								$type = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
								if($type != 'jpg' && $type != 'png' && $type != 'jpeg')
								{
									echo "<p class='error'>Image format allowed: jpg, png, jpeg</p>";
									die;
								}

								$name = $_SESSION["id"].".".$type;
								foreach(scandir("Media/Images/Avatars/") as $avatar)
								{
									if(pathinfo($avatar, PATHINFO_FILENAME) == pathinfo($name,PATHINFO_FILENAME))
									{
										$path = "Media/Images/Avatars/".$avatar;
										unset($path);
									}
								}
								move_uploaded_file($_FILES["avatar"]["tmp_name"], "Media/Images/Avatars/".$name);
								$stmt->query("UPDATE users SET avatar='".$name."' WHERE id=".$_SESSION["id"]);
							}
						}
						else
						{
							echo "<p class='error'>Wrong password</p>";
							die;
						}
						unset($_POST);
					}


				?>
				
			</form>
			
		</main>

		<footer>
			<?php include("footer.php") ?>
		</footer>
	</body>
</html>
