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
		</main>

		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
