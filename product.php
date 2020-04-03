<!DOCTYPE html>

<html lang='en'>
	<head>
		<title>Boutique</title>
		<link rel='stylesheet' type='text/css' href="CSS/stylesheet.css" />		
		<link rel="stylesheet" type="text/css" href="CSS/boot.css"/>
		<meta charset='UTF-8'>
	</head>

	<body id='product-body'>
		<header> 
			<?php include("header.php"); ?> 
		</header>

		<main>
			<div id='products-box' class='flexc just-center align-center'>
			<?php
				$products = $stmt->query("SELECT *, products.id as id_prod FROM products INNER JOIN agents ON products.id_agent = agents.id INNER JOIN users ON agents.id_user = users.id")->fetchAll(PDO::FETCH_ASSOC);
				//var_dump($products);
				
				foreach($products as $product)
				{ ?>
					<div class='flexr just-between product-zone'>
						<div class='product-box flexr just-between align-center center' 
							style='background-image:url(<?=$product["image"]?>); background-size:cover;'> 
								<div class=' product-info-product flexr just-between align-center'>
									<div class='flexc just-center'>
										<span class='flexr just-start'>
											<h1 class='product-name'><?=$product["title"]?> -- </h1>
											<h1 class='product-price'><?=$product["price"]?>$</h1>
										</span>
										<p>Superficie: <?=$product["size"]?> meters</p>
										<p>Agency : <?=$product["cost"]?> $</p>
									</div>

									<div class='product-agent-zone flexc just-center align-center'>
										<h1 class='product-agent-name'><?=$product["name"]?></h1>
										<img src='Media/Images/Avatars/<?=$product["avatar"]?>' class='product-agent-avatar'/>
									</div>
								</div>

							</div>
							<div class='product-infos-plus flexc just-evenly align-start'>
								<p>Size: <?=$product["size"]?></p>
								<p>Location: <?=$product["location"]?></p>
								<p>Orientation: <?=$product["orientation"]?></p>
								<p>Staff: <?=$product["staff"]?></p>
								<p>Cost/Year: <?=$product["cost"]?>$</p>
								<a href='product.php?id=<?=$product["id_prod"]?>' class='product-link'>See More</a>
							</div>
						</div>
				<?php	}	?>
			</div>	
		</main>

		<footer>
			<?php include("footer.php"); ?>
		</footer>
	
	</body>
</html>
