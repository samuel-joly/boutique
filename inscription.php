<!DOCTYPE html>

<html lang='en'>
	<head>
		<title>Boutique</title>
		<link rel='stylesheet' type='text/css' href="CSS/stylesheet.css" />		
		<link rel="stylesheet" type="text/css" href="CSS/inscription.css">
		<link rel="stylesheet" type="text/css" href="CSS/boot.css"/>
		<meta charset='UTF-8'>
	</head>

	<body id='inscription-body'>
		<header> <?php include("header.php"); ?> </header>
		
		<main class='flexc just-center align-center'>
			<h1 id='top-title'>Sign Up </h1>
			<form action='' method='post' id='connect-form' class='user-form'>
				<div class='input-zone'>
					<label for='login'>Login :</label> <input type='text' name='login' required/>
					<?php if($_GET["error"] ?? "" == "loginp") { ?>
						<p class='error'>Login already taken</p>
					<?php } ?>
				</div>

				<div class='input-zone'>
					<label for='email'>Email :</label> <input type='email' name='email' required/>
				</div>

				<div class='input-zone'>
					<label for='password'>Password:</label> <input type='password' name='password' required/>
				</div>

				<div class='input-zone'>
					<label for='check_password'>Check password :</label> <input type='password' name='check_password' required/>

					<?php if($_GET["error"] ?? "" == "passwordv") { ?>
						<p class='error'>Passwords do not match</p>
					<?php } ?>
				</div>

				<input type='submit' name='connect_submit' value='Connexion'/>

					<?php if($_GET["error"] ?? "" == "complete") { ?>
						<p class='error'>All the input should be complete</p>
					<?php } ?>
			</form>
		</main>

		<footer>
			<?php include("footer.php") ?>
		</footer>

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
		$email = htmlspecialchars($_POST["email"]);
		$password = htmlspecialchars($_POST["password"]);
		$check_password = htmlspecialchars($_POST["check_password"]);
		
		if($login != "" && $email != "" && $password != "")
		{
			$usr = $stmt->query("SELECT * FROM users WHERE name = '".$login."'")->fetch(PDO::FETCH_ASSOC);
			if(empty($usr))
			{
				if($password == $check_password)
				{
					if($stmt->query("INSERT INTO users(`id`,`name`,`email`,`password`,`avatar`) VALUES(NULL, '$login', '$email', '".password_hash($password, PASSWORD_BCRYPT)."', 'avatar/default.png')"))
					{
						header("location:connexion.php?login=$login");
					}
				}
				else
				{
					header("location:inscription.php?error=passwordv");
				}
			}
			else
			{
				header("location:inscription.php?error=logint");
			}
		}
	}

?>	
