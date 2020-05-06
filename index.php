<!DOCTYPE html>

<html lang="en">
	<head>
		<title>Boutique</title>
		<link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
		<link rel="stylesheet" type="text/css" href="CSS/index.css">
		<link rel="stylesheet" type="text/css" href="CSS/boot.css">
		<meta charset="UTF-8"/>
	</head>

	<body>
		<header>
			<?php include("header.php"); ?>
		</header>

		<main display="flexc just-center align-center">
			<video id="video-bg" autoplay muted loop>
				<source src="Media/Videos/index-bg.mp4" type="video/mp4">
			</video>
			
			<div id="title-box" class="center flexc just-center">
				<h1 id="main-topTitle">HouseBrand</h1>
				<h2 id="main-subTitle">Re-invent living</h2>
			</div>
			<div id='product-display' class='flexr just-center'>
				<?php
					$products = $stmt->query("SELECT * FROM products WHERE EXISTS(SELECT * FROM frontpage WHERE id_product = products.id)")->fetchAll(PDO::FETCH_ASSOC);

					foreach($products as $product)
					{ ?>
							<a class='product-displayer' href='product-description.php?id=<?=$product["id"]?>'
							style='background:url(<?=$product["image"]?>);background-size:cover'>
								<h1><u><?=$product["title"]?></u></h1>
							</a>
				<?php	}
				?>
			</div>
		</main>

		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
