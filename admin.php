<!DOCTYPE html>

<html lang='en'>
	<head>
		<link rel='stylesheet' type='text/css' href="CSS/stylesheet.css" />		
		<link rel="stylesheet" type="text/css" href="CSS/boot.css"/>
		<link rel="stylesheet" type="text/css" href="CSS/admin.css">
		<meta charset='UTF-8'>
		<title>Admin</title>
	</head>

	<body id='inscription-body'>
	
		<header> 
			<?php 


				include("header.php");
				
				if(!isset($_SESSION["id"]) || !isset($_SESSION["admin"]))
				{
					header("location:connexion.php");
				}
				$products = $stmt->query("SELECT products.id AS id , products.price AS price , products.title AS title,
							users.name AS agent_name   , agents.id AS agent_id   
							FROM products
							LEFT JOIN agents ON products.id_agent = agents.id
							LEFT JOIN users ON agents.id_user = users.id
							WHERE NOT EXISTS(SELECT * FROM bought WHERE id_product = products.id)")->fetchAll(PDO::FETCH_ASSOC);
				

				$users = $stmt->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);	
				$agents = $stmt->query("SELECT users.name, users.id, SUM(products.price) AS price, users.avatar AS avatar 
							FROM agents 
							INNER JOIN users ON agents.id_user = users.id 
							LEFT JOIN products ON agents.id = products.id_agent 
							GROUP BY users.name")->fetchAll(PDO::FETCH_ASSOC);
				$boughts = $stmt->query("SELECT products.id AS id , products.price AS price , products.title AS title, bought.date AS date, users.name as acheteur
							FROM bought 
							INNER JOIN products ON bought.id_product = products.id
							INNER JOIN users ON bought.id_user = users.id")->fetchAll(PDO::FETCH_ASSOC);
				$total = $stmt->query("SELECT SUM(products.price) as total FROM bought INNER JOIN products ON bought.id_product = products.id")->fetchAll(PDO::FETCH_ASSOC);
				$total_product = $stmt->query("SELECT SUM(products.price) AS total_price, COUNT(products.id) AS total_product FROM products
								WHERE NOT EXISTS(SELECT * FROM bought WHERE bought.id_product= products.id)")->fetch(PDO::FETCH_ASSOC);

			
			?>
		</header>

		<main class='flexc just-start align-center'>
		<?php
			
				if(isset($_GET["change_product"]))
				{
				    include("admin_product.php");
				}

				if(isset($_GET["add_product"]))
				{
					include("admin_add_product.php");
				}

				if(isset($_GET["del_product"]))
				{
					$stmt->query("DELETE FROM products WHERE id=".$_GET["del_product"]);
					header('location:admin.php');
				}
				if(isset($_GET["category"]))
				{
					include("manage_category.php");
				}
				if(isset($_GET["agent_delete"]))
				{
					$stmt->query("DELETE FROM agents WHERE id=".$_GET["agent_delete"]);
					header('location:admin.php');
				}
				if(isset($_GET["profil"]))
				{
					include("admin_profil.php");
				}
				if(isset($_GET["user_delete"]))
				{
					$stmt->query("DELETE FROM users WHERE id=".$_GET["user_delete"]);
					header('location:admin.php');
				}
		?>

			<label for='admin-prod-desc' id='admin-products' class='admin-top flexc just-start align-start center'>
				<input type='checkbox' id='admin-prod-desc' class='input-admin'/>
				<h1 class='flexr just-between'>Products<p>&darr;</p></h1>
				<div class='admin-sub'>
					<?php 
						foreach($products as $product)
						{
							echo "
							<div class='admin-product-desc'>
								<span class='flexc just-center align-center'>
									<h1 class='admin-product-name'>".$product["title"]."</h1>
									<p><u>".$product["price"]."$</u></p>
								</span>
								<p>Managed by <i>".$product["agent_name"]."</i></p>
								<span class='flexr just-start align-start center'>
									<a href='admin.php?change_product=".$product["id"]."'class='admin-input'>Modify</a>
									<a href='admin.php?del_product=".$product["id"]."'class='admin-remove'>Delete</a>
								</span>
							</div>";
						}
						
					?>
				</div>
				<div  class='info-admin-prod flexr just-between align-center'>
					<p>Total of<b> <?=$total_product["total_product"]?> products </b>worth of <b><?=$total_product["total_price"]?>$</b></p>
					<span class='flexr just-end '>
						<a href='admin.php?add_product=true' class='add-product'>Add product</a>
						<a href='admin.php?category=true' class='add-product'>Manage category</a>
				        </span>
				</div>
			</label>			

			<label for='admin-bought-desc' id='admin-bought' class='admin-top flexc just-start align-start center'>
				<input type='checkbox' id='admin-bought-desc' class='input-admin'/>
				<h1 class='flexr just-between'>Sales (<?= $total[0]["total"] ?>$)<p>&darr;</p></h1>
				<div class='admin-sub'>
					<?php
						foreach($boughts as $bought)
						{
							echo "
							<div id='admin-product-bought-desc' class=' admin-product-desc'>
								<span class='flexr just-start align-center'>
									<h1 class='admin-product-name'>".$bought["title"]."</h1>
									<p>--<u>".$bought["price"]."$</u></p>
								</span>
								<p>Bought by <i>".$bought["acheteur"]."</i><br/>".$bought["date"]."</p>
							</div>";
						}
		
					?>
				</div>
			</label>

			<label for='admin-agent-desc' id='admin-agent' class='admin-top flexc just-start align-start center'>
				<input type='checkbox' id='admin-agent-desc' class='input-admin'/>
				<h1 class='flexr just-between'>Agents<p>&darr;</p></h1>
				<div class='admin-sub'>
					    <?php
					    	$count = 0;
						foreach($agents as $agent)
						{
							echo "
							<div class='admin-agent-desc'>
								<span class='flexr just-between align-center'>
									<h1 class='admin-agent-name'>".$agent["name"]."</h1>
									<img src='Media/Images/Avatars/".$agent["avatar"]."' class='admin-agent-avatar'/>
								</span>
								<span class='flexr just-between align-start center'>
									<a href='admin.php?profil=".$agent["id"]."' class='admin-input'>More</a>
									<a href='admin.php?agent_delete=".$agent["id"]."' class='admin-remove'>Downgrade</a>
								</span>
							</div>";
							$count++;
						}
		
					?>
				</div>
				<?php 
				
				echo "<div class='admin-info-prod admin-info-users flexr just-between align-center'>
					<p>Total of <b>".$count." agents</b> managing <b>".$total_product["total_product"]." products</b>.</p>
				</div>";
				?>
			</label>

			<label for='admin-user-desc' id='admin-user' class='admin-top flexc just-start align-start center'>
				<input type='checkbox' id='admin-user-desc' class='input-admin'/>
				<h1 class='flexr just-between'>Users<p>&darr;</p></h1>
				<div class='admin-sub'>
					    <?php
					    	$count = 0;
						foreach($users as $user)
						{
							echo "
							<div class='admin-agent-desc'>
								<span class='flexr just-between align-center'>
									<h1 class='admin-agent-name'>".$user["name"]."</h1>
									<img src='Media/Images/Avatars/".$user["avatar"]."' class='admin-agent-avatar'/>
								</span>
								<span class='flexr just-between align-start center'>
									<a href='admin.php?profil=".$user["id"]."' class='admin-input'>See Infos</a>
									<a href='admin.php?user_delete=".$user["id"]."' class='admin-remove'>Delete</a>
								</span>
							</div>";
							$count ++;
						}
		
					?>
				</div>
				<?php 
				echo "<div class='admin-info-prod admin-info-users flexr just-between align-center'><p>Total of <b>".$count." users</b>.</p>";
				echo "</div>"; ?>	
			</label>
		</main>

		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>
