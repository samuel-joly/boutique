<div  class="flexc align-start">
	<?php 	session_start(); 
	$stmt = new PDO("mysql:host=localhost;dbname=boutique","root","");
	$category = $stmt->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);
	?>



	<div id="product-dropdown" class="flexr">
		<a href="product.php" class="header-link">Products&rarr;</a>	
		<div id="categorie-dropdown">

			<?php
				foreach($category as $cat)
				{
					echo "
					<div class='header-cat'> 
						<a href='product.php?category=".$cat["id"]."'>".$cat["name"]."</a><div class='sub-content'>";

					$sub_category = $stmt->query("SELECT * FROM `sub-category` WHERE id_category =".$cat["id"])->fetchAll(PDO::FETCH_ASSOC);
					foreach($sub_category as $sub_cat)
					{
						echo "<a href='product.php?category=".$sub_cat["id_category"]."&&sub_category=".$sub_cat["id"]."'>".$sub_cat["name"]."</a>";
					}

					echo "</div> </div>";
				}
			?>
			
		</div>
	</div>
	<?php
		if(isset($_SESSION["id"]))
		{	?>	
			<a href="profil.php" class="header-link" id="profil-link">Profil</a>
			<a href="index.php?deco=true" class="header-link">Disconnect</a>
	<?php 	}
		else
		{ ?>
			<a href="inscription.php" class="header-link" id="profil-link">Inscription</a>
			<a href="connexion.php" class="header-link" id="profil-link">Connexion</a>
	<?php	} ?>
	<a href="cart.php" class="header-link" id="cart-link" >Cart</a>
	<a href="cart.php" class="header-link" id="search-link" >Search</a>
	<a href="cart.php" class="header-link" id="contact-link" >Contact</a>
</div>

<div id="header-categorie">

<?php
	if(isset($_GET["deco"]))
	{
		session_destroy();
		header("location:index.php");
	}
?>
