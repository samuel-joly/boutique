<?php
	session_start();
	$connect = false;
	if(isset($_SESSION["id"]))
	{
		$usr_name = $_SESSION["nom"];
		$connect = true;
	}


?>


<div  class="flexc align-start">
	<?php if($connect) { ?>
		<a href="index.php?deco=true" class="header-link">Deconnexion</a>
	<?php } ?>


	<div id="product-dropdown" class="flexr">
		<a href="product.php" class="header-link">Products&rarr;</a>	
		<div id="categorie-dropdown">
			<div class="header-cat">
				<a href="product.php?categorie=1">Categorie#1</a>
				<div class="sub-content">
					<a href="product.php?subcategorie=1">SubCat#1</a>
					<a href="product.php?subcategorie=1">SubCat#2</a>
					<a href="product.php?subcategorie=1">SubCat#3</a>
					<a href="product.php?subcategorie=1">SubCat#4</a>
				</div>
			</div>
			
			<div class="header-cat">
				<a href="product.php?categorie=1">Categorie#2</a>
				<div class="sub-content">
					<a href="product.php?subcategorie=1">SubCat#1</a>
					<a href="product.php?subcategorie=1">SubCat#2</a>
					<a href="product.php?subcategorie=1">SubCat#3</a>
					<a href="product.php?subcategorie=1">SubCat#4</a>
				</div>
			</div>
			
			<div class="header-cat">
				<a href="product.php?categorie=1">Categorie#3</a>
				<div class="sub-content">
					<a href="product.php?subcategorie=1">SubCat#1</a>
					<a href="product.php?subcategorie=1">SubCat#2</a>
					<a href="product.php?subcategorie=1">SubCat#3</a>
					<a href="product.php?subcategorie=1">SubCat#4</a>
				</div>
			</div>
			
			<div class="header-cat">
				<a href="product.php?categorie=1">Categorie#4</a>
				<div class="sub-content">
					<a href="product.php?subcategorie=1">SubCat#1</a>
					<a href="product.php?subcategorie=1">SubCat#2</a>
					<a href="product.php?subcategorie=1">SubCat#3</a>
					<a href="product.php?subcategorie=1">SubCat#4</a>
				</div>
			</div>
			
		</div>
	</div>

	<a href="profil.php" class="header-link" id="profil-link">Profil</a>
	<a href="cart.php" class="header-link" id="news-link" >News</a>
	<a href="cart.php" class="header-link" id="cart-link" >Cart</a>
	<a href="cart.php" class="header-link" id="search-link" >Search</a>
	<a href="cart.php" class="header-link" id="contact-link" >Contact</a>
</div>

<div id="header-categorie">