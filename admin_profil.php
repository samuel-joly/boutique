<?php

	$user = $stmt->query("SELECT * FROM users WHERE id=".$_GET["profil"])->fetch(PDO::FETCH_ASSOC);
	$agent = $stmt->query("SELECT * FROM agents WHERE id_user=".$_GET["profil"])->fetch(PDO::FETCH_ASSOC);
	if(!empty($agent))
	{
		$managed_products = $stmt->query("SELECT * FROM products
						WHERE id_agent=".$agent["id"]." AND NOT
						EXISTS(SELECT * FROM bought WHERE id_product=products.id)
						")->fetchAll(PDO::FETCH_ASSOC);
	}
	if(isset($_GET["upgrade"]))
	{
		$stmt->query("INSERT INTO agents(`id`,`id_user`) VALUES(NULL, ".$_GET["profil"].")");
		header("location:admin.php?profil=".$_GET["profil"]);
	}

	if(isset($_POST["submit-profil"]))
	{
		$name = $_POST["name"];
		$email = $_POST["email"];
		if($name != $user["name"] && $name != "")
		{
			$stmt->query("UPDATE users SET name='".$name."' WHERE id=".$_GET["profil"]);
		}
		if($email != $user["email"] && $email != "")
		{
			$stmt->query("UPDATE users SET email='".$email."' WHERE id=".$_GET["profil"]);
		}
		$link = "location:admin.php?profil=".$_GET["profil"];
		header($link);
	}

?>
<a class='alert-body a-null text-black ' href='admin.php'></a>

<div class='alert-container admin-alert' id='admin-profile'>
	<form action='admin.php?profil=<?=$_GET["profil"]?>' method='POST'>
		<div class='flexr just-around align-center'>
			<img src='Media/Images/avatars/<?=$user["avatar"]?>' id='admin-user-image'/>
			<span class='flexc just-center align-center'>
				<div class='input-zone'>
					<label for='name'>Name</label>
					<input type='text' name='name' value='<?=$user["name"]?>'/>
				</div>

				<div class='input-zone'>
					<label for='email'>Email</label>
					<input type='mail' value='<?=$user["email"]?>' name='email'/>
				</div>
			</span>

			<div class='flexr just-start align-start wrap' id='manages_product_info'>
				<?php
				if(isset($managed_products))
				{
					foreach($managed_products as $prod)
					{ ?>
						<div class='managed_product flexc just-center align-center'>
							<h1><?=$prod["title"]?></h1>
							<a class='admin-input' href='admin.php?change_product=<?=$prod["id"]?>'>Info</a>
						</div>
				<?php	}
				}
				?>
			</div>

		</div>
		    <div class='flexr just-center align-center'>
			<input type='submit' name='submit-profil' value='Save change' class='admin-input'/>
			<a href='admin.php' class='admin-remove'>Return</a>
			<?php

	
				if(!isset($managed_products))
				{ ?>
					<a class='admin-input center' style='justify-self:center;align-self:center;' href='admin.php?profil=<?=$_GET["profil"]?>&&upgrade=<?=$user["id"]?>'>
					Upgrade to agent</a>
		<?php		}

			?>
		    </div>
	</form>

</div>
