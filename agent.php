<!DOCTYPE html>

<html lang='en'>
	<head>
		<title>Boutique</title>
		<link rel='stylesheet' type='text/css' href="CSS/stylesheet.css" />		
		<link rel="stylesheet" type="text/css" href="CSS/products.css">
		<link rel="stylesheet" type="text/css" href="CSS/filter.css">
		<link rel="stylesheet" type="text/css" href="CSS/boot.css">
		<meta charset='UTF-8'>
	</head>

	<body id='product-body'>
		<header>
			<?php include("header.php");
						
			if(isset($_GET["agent"]))
			{
				$agent = $stmt->query("SELECT * FROM agents INNER JOIN users ON agents.id_user = users.id
				WHERE agents.id=".$_GET["agent"])->fetch(PDO::FETCH_ASSOC);

				$rating = $stmt->query("SELECT AVG(value) FROM ratings WHERE id_agent=".$_GET["agent"])->fetch()[0];

				$products = $stmt->query("SELECT * FROM products WHERE id_agent = ".$_GET["agent"])->fetchAll(PDO::FETCH_ASSOC);

				$comments = $stmt->query("SELECT *, users.name as creator FROM comments 
				INNER JOIN users ON comments.id_creator = users.id 
				INNER JOIN ratings ON comments.id_product = ratings.id_product
				WHERE comments.id_agent=".$_GET["agent"])->fetchAll(PDO::FETCH_ASSOC);
			}
			else
			{
				header("location:index.php");
			}
			?>
		</header>
		
		<main class='flexr just-center align-center'>


			<div class='flexc just-center align-center' id='comment-zone'>
				<?php
					foreach($comments as $comment)
					{ ?>
						<div class='flexc just-start align-center'>
							<span class='comment-head flexr just-between'>
								<?= $comment["creator"] ?>
								<?= $comment["date"] ?>
							</span>

							<div class='comment-zone flexc align-center'>
								<?= $comment["comment"] ?>

								<div class='flexr'>
								<?php
									for($i=0;$i<5;$i++)
									{
										if($i < $comment["value"])
										{
											echo "<img src='Media/Images/Assets/star.png' class='rating-star'/>";
										}
										else
										{
											echo "<img src='Media/Images/Assets/empty-star.png' class='rating-star'/>";
										}
									}
								?>
								</div>

							</div>

						</div>					
				<?php	}


				?>
			</div>


			<div class='flexc just-center align-center' id='agent-profile'>
				<img src='Media/Images/Avatars/<?= $agent["avatar"] ?>' class='product-agent-avatar'/>
				<h1><?= $agent["name"] ?></h1>
				<div class='flexr just-center align-center'>
				<?php
					for($i=0;$i<5;$i++)
					{
						if($i < $rating)
						{
							echo "<img src='Media/Images/Assets/star.png' class='rating-star'/>";
						}
						else
						{
							echo "<img src='Media/Images/Assets/empty-star.png' class='rating-star'/>";
						}
					}
				?>
				</div>

				<div class='flexc just-between' id='product-manage-zone'>
					<?php
						foreach($products as $product)
						{ ?>
							<div class='flexr just-around align-start'>
								<img src='<?=$product["image"]?>' class='managed-prod-img'/>
								<span class='flexc just-start align-start'>
									<?=$product["title"]?>
									<?=$product["price"]?>$
									<a class='admin-input' href='product-description.php?id=<?=$product["id"]?>'/>See More</a>
								</span>
							</div>
					<?php	}
					?>
				</div>

			</div>



		</main>




		<footer>
			<?php include("footer.php"); ?>
		</footer>

	</body>


</html>
