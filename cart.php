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
            <?php include("header.php");?> 
        </header>   

            <?php

            $deleteAll="DELETE FROM basket WHERE id_user='".$_SESSION['id']."' ";
            // FONCTION PERMETTANT SOIT DELETE ALL SOIT DELETE UN ARTICLE
            function delete($requeteDelete){
                $id_product=$_POST['id_product'];
                $connexion=mysqli_connect("localhost","root","","boutique");
                $requete=$requeteDelete;
                $query=mysqli_query($connexion,$requete);
                header("location:cart.php");
            }

            if(isset($_POST['removeArticle'])){
                $id_product=$_POST['id_product'];
                $deleteOnce="DELETE FROM basket WHERE id_product='".$id_product."' AND id_user='".$_SESSION['id']."' ";
                delete($deleteOnce);
            }
            
            // SUPPRESION DES ARTICLES DU PANIER LORS DE L'ACHAT + INSERTION DES DONNEES DU PANIER DANS BOUGHT
            if(isset($_POST['acheter'])){
                $connexion=mysqli_connect("localhost","root","","boutique");
                $requete="SELECT id,id_user,id_product,quantity FROM basket WHERE id_user='".$_SESSION['id']."'";
                $query=mysqli_query($connexion,$requete);
                $resultat=mysqli_fetch_all($query);

                foreach($resultat as $achat){
                    $date=date("Y-m-d:H-m-s");
                    $requeteInsert="INSERT INTO `bought` (`id_user`,`id_product`,`date`,`quantity`) VALUES ('".$achat[1]."','".$achat[2]."','".$date."','".$achat[3]."')";
                    $query=mysqli_query($connexion,$requeteInsert);
                    $requeteDelete="DELETE FROM basket WHERE id_product='".$achat[2]."' AND id_user='".$achat[1]."'";
                    $queryDelete=mysqli_query($connexion,$requeteInsert);
                }
                delete($deleteAll);
                header("location:cart.php");

            }
            ?>


        <main class='flexr just-center align-center'>
            
            <section class="flexc">
                <div class="titrePanier">Panier (<?php if(isset($_SESSION['nb_prod_panier'])){ echo $_SESSION['nb_prod_panier'];} else{echo 0;} ?>)</div>
                <section id="panierList" class='flexc just-between align-center'>
                
                    <div id='products-box-basket' class='flexc just-between align-center'>

                        <!-- AFFICHAGE PRODUIT MIS AU PANIER -->

                        <?php
                            $query = "SELECT title, image, users.name, users.avatar as avatar,  products.id as id_prod, size, price, cost , staff, location, orientation, basket.id as id_basket FROM products
                            INNER JOIN agents ON products.id_agent = agents.id
                            INNER JOIN users ON agents.id_user = users.id
                            INNER JOIN basket ON products.id = basket.id_product
                            WHERE basket.id_user='".$_SESSION['id']."'";
                            
                            $products = $stmt->query($query)->fetchAll(PDO::FETCH_ASSOC); 
                            $_SESSION['nb_prod_panier']=count($products);

                            if(empty($products)){
                                ?>    <div id="aucunAchat">Votre panier est vide</div> <?php
                                }
                            foreach($products as $product){ 
                            ?>
                            <div class='flexr just-between product-zone'>
                                <div class='product-box flexr just-between align-center center' 
                                    style='background-image:url(<?=$product["image"]?>); background-size:cover;'> 
                                </div>
                                <div class='product-infos-basket flexc just-evenly align-start'>    
                                    <p>Size: <?=$product["size"]?>m&#178;</p>
                                    <p>Location: <?=$product["location"]?></p>
                                    <p>Orientation: <?=$product["orientation"]?></p>
                                    <p>Staff: <?=$product["staff"]?></p>
                                    <p>Cost/Year: <?=$product["cost"]?>$</p>

                                    <form method="POST">
                                        <input type="hidden" name="id_product" value="<?php echo $product['id_prod'] ;?>">
                                        <input type="submit" name="removeArticle" class="removeArticle" value="Remove">
                                    </form>

                                </div>
                            </div>
                            <?php } ?>
                    </div>	

                </section>

                <div class="titrePanier">Acheté (<?php if(isset($_SESSION['nb_prod_achete'])){echo $_SESSION['nb_prod_achete'];} else{echo 0;} ?>)</div>
                <section id="panierList"  class='flexc just-between align-center'>
            
                    <div id='products-box-basket' class='flexc just-between align-center'>
                        
                        <!-- AFFICHAGE PRODUIT ACHETER -->

                        <?php
                        $requeteBought="SELECT title, image, users.name, users.avatar as avatar,  products.id as id_prod, size, price, cost , staff, location, orientation FROM products
                        INNER JOIN agents ON products.id_agent = agents.id
                        INNER JOIN users ON agents.id_user = users.id
                        INNER JOIN bought ON products.id = bought.id_product
                        WHERE bought.id_user='".$_SESSION['id']."'";

                        $productsBought = $stmt->query($requeteBought)->fetchAll(PDO::FETCH_ASSOC); 
                        $_SESSION['nb_prod_achete']=count($productsBought);
                        if(empty($productsBought)){
                        ?>    <div id="aucunAchat">Vous n'avez fait aucun achat</div> <?php
                        }
                        foreach($productsBought as $product){ 
                        ?>
                        <div class='flexr just-between product-zone'>
                            <div class='product-box flexr just-between align-center center' 
                                style='background-image:url(<?=$product["image"]?>); background-size:cover;'> 
                                </div>
								    <div id='product-bought'>Produit Acheté</div>
                            </div>
                        <?php } 
                        ?>
                    </div>	

                </section>
            </section>

            <section id="ValidationAchat">

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
                    <article id="InfoAvantValidation"></article>
                    <article id="ValidationAchatOk">
                        <form method="POST">
                            <input type="hidden" name="achat" value="acheter">
                            <input type="submit" name="acheter" id="acheter" value="Valider achat">
                        </form>
                    </article>
                </div>
                
            </section>

        </main>

            </br></br></br>
        <footer>
            <?php include("footer.php"); ?>
        </footer>

    </body>
</html>