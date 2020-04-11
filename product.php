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

				 if(isset($_POST["filter_submit"])) 
				 { 
				 	include("filter.php"); 
				 } 
					
				
				if(isset($_GET["filter"]))
				{
					unset($_SESSION["product_filter"]);
				}

				if(!isset($_SESSION["product_filter"]))
				{
					$query = "SELECT title, image, users.name, users.avatar as avatar,  products.id as id_prod, size, price, cost , staff, location, orientation FROM products
						INNER JOIN agents ON products.id_agent = agents.id
						INNER JOIN users ON agents.id_user = users.id ";
				}
				else
				{
					$query = $_SESSION["product_filter"];
					echo $query;
				}
					
				$products = $stmt->query($query)->fetchAll(PDO::FETCH_ASSOC); 
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
								<a href='product-description.php?id=<?=$product["id_prod"]?>&cat=<?php echo $_GET["category"]; ?>' class='product-link'>See More</a>
							</div>
						</div>
				<?php	}	?>
			</div>	
		
			<div id='filter' class='flexc align-start'>
				<form id='filter-form' method='post' action='product.php'>
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
			

						<p class='filter-separator' style='margin-bottom:5px;'>Category</p>
						<div class='filter-tag' style='max-height:280px;'>
							<?php
					$category_tag = $stmt->query("SELECT `category-tag`.id as id, category.name as name
					FROM `category-tag` INNER JOIN category ON `category-tag`.id = category.id")->fetchAll();

					$sub_category_tag = $stmt->query("SELECT `sub-category-tag`.id as id, `sub-category`.name as name 
					FROM `sub-category-tag` INNER JOIN `sub-category` ON `sub-category-tag`.id = `sub-category`.id")->fetchAll();
							
							
							$category = $stmt->query('SELECT * FROM category')->fetchAll(PDO::FETCH_ASSOC);
							$sub_category = $stmt->query('SELECT * FROM `sub-category`')->fetchAll(PDO::FETCH_ASSOC);
							
							foreach($category as $cat_tag)
							{
								echo "<span class='cat_tag'><input name='cat[]' type='radio' id='".$cat_tag["name"]."'
								value='".$cat_tag["id"]."'/>
								<label for='".$cat_tag["name"]."'>".$cat_tag["name"]."</label></span>";
							}
							
							?>
						</div>
						<p class='filter-separator' style='margin-bottom:5px;'>Tag</p>
						<div class='filter-tag' >
							<?php

							$sub_category = $stmt->query('SELECT * FROM `sub-category`')->fetchAll(PDO::FETCH_ASSOC);
							
							foreach($sub_category as $sub_cat_tag)
							{
								echo "<span class='cat_tag'><input type='checkbox' id='".$sub_cat_tag["name"]."'
								name='sub_cat[]' value='".$sub_cat_tag["id"]."'/>
								<label for='".$sub_cat_tag["name"]."' >".$sub_cat_tag["name"]."</label></span>";
							}
							?>
						</div>
					</div>
					
					<p class='filter-separator'>Name</p>
					<div class='filter-input-zone' id='filter-search'>
						<label for='search'>Search :</label><input type='text' name='search'/>
					</div>
					<div class='flexc just-center center align-center'>
						<input type='submit' name='filter_submit' value='Search' id='filter-submit' style='align-self:center;'/>
						<a href='product.php?filter=clear' id='filter-reset'>Reset filter</a>
				
				
				</form>
				
			</div>
		</main>

		<footer>
			<?php include("footer.php"); ?>
		</footer>
	
	</body>
</html>
