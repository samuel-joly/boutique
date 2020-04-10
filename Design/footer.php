<?php
	$stmt = new PDO("mysql:host=localhost;dbname=boutique","root","");
	$category = $stmt->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);
?>



<?php if(isset($_SESSION["id"])) { ?>
	<div class='footer-container'>		<a href='profil.php'>Profil</a>		<a href='index.php?deco=true'>Disconnect</a>		</div>
<?php } ?>

	<div class='footer-container'>
		<?php
			foreach($category as $cat)
			{
				echo "<a href='product.php?category=".$cat["id"]."'>".$cat["name"]."</a>";
			}
		?>
	</div>
</div>
