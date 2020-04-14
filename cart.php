<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panier</title>
        <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="CSS/boot.css">
    </head>

    <body id="cart-body">

        <header> 
            <?php include("header.php"); ?> 
        </header>   


        <main class='flexr just-center align-center'>

            <section id="panierList"  class='flexc just-between align-center'>
            
            <div id='products-box-basket' class='flexc just-between align-center'>

                    <?php
    					$query = "SELECT title, image, users.name, users.avatar as avatar,  products.id as id_prod, size, price, cost , staff, location, orientation, basket.id as id_basket FROM products
						INNER JOIN agents ON products.id_agent = agents.id
						INNER JOIN users ON agents.id_user = users.id
                        INNER JOIN basket ON products.id = basket.id_product
						WHERE basket.id_user='".$_SESSION['id']."'"
                        ;

					
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
							<div class='product-infos-basket flexc just-evenly align-start'>
								<p>Size: <?=$product["size"]?>m&#178;</p>
								<p>Location: <?=$product["location"]?></p>
								<p>Orientation: <?=$product["orientation"]?></p>
								<p>Staff: <?=$product["staff"]?></p>
                                <p>Cost/Year: <?=$product["cost"]?>$</p>
                                <form method="POST">
                                    <input type="submit" name="removeArticle" id="removeArticle" value="Remove">
                                </form>
							</div>
						</div>
                <?php

                    if(isset($_POST['removeArticle'])){
                        echo "remove article ok </br>";
                        echo "le  produit".$product["title"]."</br>";
                        $connexion=mysqli_connect("localhost","root","","boutique");
                        $requete="DELETE FROM basket WHERE id_product='".$product['id_prod']."' AND id_user='".$_SESSION['id']."' AND id='".$product['id_basket']."'";
                        $query=mysqli_query($connexion,$requete);
                        echo $requete;
                    }
            
            }	?>
			</div>	

            </section>


            <section id="ValidationPanier">

            <div id="infoProduct">
                <article id="infoGeneral">
                    Info general sur le/les biens
                </article>
                <article id="infoTechnique">
                    Info technique sur le/les biens
                </article>
                <article id="option">
                    Les options proposées sur le/les biens <br>
                    <div id="optionDiv">
                        Option 1 :
                        <label for="ouiOption1">Oui</label><input type="radio">
                        <label for="nonOption1">Non</label><input type="radio"><br>
                    </div>
                    <div id="optionDiv">
                        Option 2 :
                        <label>Oui</label><input type="radio"></input>
                        <label>Non</label><input type="radio"></input><br>
                    </div>
                    <div id="optionDiv">
                        Option 3 :
                        <label>Oui</label><input type="radio"></input>
                        <label>Non</label><input type="radio"></input><br>
                    </div>
                    <div id="optionDiv">
                        Option 4 :
                        <label>Oui</label><input type="radio"></input>
                        <label>Non</label><input type="radio"></input><br>
                    </div>
                </article>
            </div>
            
            <div id="validationBasket">

            </div>
                
            </section>

        </main>


    




        <footer>
            <?php include("footer.php"); ?>
        </footer>

    </body>
</html>