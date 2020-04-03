<!DOCTYPE html>

<html lang='en'>
	<head>
		<title>Boutique</title>
		<link rel='stylesheet' href='CSS/stylesheet.css' type='text/css'/>		
		<link rel="stylesheet" type="text/css" href="CSS/boot.css"/>
		<meta charset='UTF-8'>
	</head>

	<body id='inscription-body'>
		<header> <?php include("header.php"); ?> </header>
		
		<main>
			<h1 id='top-title'>Log In</h1>
			<form action='' method='post' id='connect-form' class='user-form'>
				<div class='input-zone'>
					<label for='login'>Login :</label> <input type='text' name='login' required/>
				</div>

				<div class='input-zone'>
					<label for='password'>Password:</label> <input type='password' name='password' required/>
				</div>

				<input type='submit' name='connect_submit' value='Connexion'/>
				<?php if($_GET["error"] ?? "" == "password") { ?>
					<p class='error'>Wrong password or login</p>
				<?php } ?>
			</form>
		</main>
	</body>
</html>


<?php
	if(isset($_SESSION["id"]))
	{
		header("location:index.php");
	}

	$stmt = new PDO("mysql:host=localhost;dbname=boutique","root","");

	if(isset($_POST["connect_submit"]))
	{
		$login = htmlspecialchars($_POST["login"]);
		$password =htmlspecialchars($_POST["password"]);
		
		if($login != "" && $password != "")
		{
			$usr = $stmt->query("SELECT * FROM users WHERE name = '".$login."'")->fetch(PDO::FETCH_ASSOC);
			if(!empty($usr))
			{
				if(password_verify($password, $usr["password"]))
				{
					$_SESSION["id"] = $usr["id"];
					header("location:index.php");
				}
				else
				{
					header("location:connexion.php?error=password");
				}
			}
		}
	}
?>	
