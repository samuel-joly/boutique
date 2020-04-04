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

		<main class='flexr just-center align-center'>
			<div id='products-box' class='flexc just-between align-center'>
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
										<p>Superficie: <?=$product["size"]?> m&#178;</p>
										<p>Agency : <?=$product["cost"]?> $</p>
									</div>

									<div class='product-agent-zone flexc just-center align-center'>
										<h1 class='product-agent-name'><?=$product["name"]?></h1>
										<img src='Media/Images/Avatars/<?=$product["avatar"]?>' class='product-agent-avatar'/>
									</div>
								</div>

							</div>
							<div class='product-infos-plus flexc just-evenly align-start'>
								<p>Size: <?=$product["size"]?>m&#178;</p>
								<p>Location: <?=$product["location"]?></p>
								<p>Orientation: <?=$product["orientation"]?></p>
								<p>Staff: <?=$product["staff"]?></p>
								<p>Cost/Year: <?=$product["cost"]?>$</p>
								<a href='product.php?id=<?=$product["id_prod"]?>' class='product-link'>See More</a>
							</div>
						</div>
				<?php	}	?>
			</div>	
		
			<div id='filter' class='flexc align-start'>
				<form id='filter-form' action='filter.php' method='post'>
					<h1 id='filter-title'>Filter</h1>	
					<div id='filter-zone' class='flexc just-start align-center'>
						<p class='filter-separator'>Price</p>
						<div id='filter-price' class='flexr just-between align-center'>
							<div class='filter-input-zone'>
								<label for='min-price'>Min</label>
								<input type='text' name='min-price' />k$
							</div>

							<div class='filter-input-zone'>
								<label for='max-price'>Max</label>
								<input type='text' name='max-price' />k$
							</div>
						</div>
					
						<p class='filter-separator'>Size</p>
						<div id='filter-price' class='flexr just-between align-center'>
							<div class='filter-input-zone'>
								<label for='min-size'>Min</label>
								<input type='text' name='min-size' />m&#178;
							</div>

							<div class='filter-input-zone'>
								<label for='max-size'>Max</label>
								<input type='text' name='max-size' />m&#178;
							</div>
						</div>
						<h1 id='filter-separator'>Tags</h1>
						<div id='filter-tag'>
							<?php
					$category_tag = $stmt->query("SELECT `category-tag`.id as id, category.name as name
					FROM `category-tag` INNER JOIN category ON `category-tag`.id = category.id")->fetchAll();

					$sub_category_tag = $stmt->query("SELECT `sub-category-tag`.id as id, `sub-category`.name as name 
					FROM `sub-category-tag` INNER JOIN `sub-category` ON `sub-category-tag`.id = `sub-category`.id")->fetchAll();
							
							
							$category = $stmt->query('SELECT * FROM category')->fetchAll(PDO::FETCH_ASSOC);
							$sub_category = $stmt->query('SELECT * FROM `sub-category`')->fetchAll(PDO::FETCH_ASSOC);
//							var_dump($category);
							foreach($category as $cat_tag)
							{
								echo "<span class='cat_tag'><input type='checkbox' id='".$cat_tag["name"]."'
								name='".$cat_tag["id"]."' id='".$cat_tag["name"]."'/>
								<label for='".$cat_tag["name"]."'>".$cat_tag["name"]."</label></span>";
							}
							
							foreach($sub_category as $sub_cat_tag)
							{
								echo "<span class='cat_tag'><input type='checkbox' id='".$sub_cat_tag["name"]."'
								name='".$sub_cat_tag["id"]."'/>
								<label for='".$sub_cat_tag["name"]."' >".$sub_cat_tag["name"]."</label></span>";
							}
							?>
						</div>
					</div>
				
				</form>
			</div>
		</main>

		<footer>
			<?php include("footer.php"); ?>
		</footer>
	
	</body>
</html>
