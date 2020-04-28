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
            
            <?php
             include("header.php");
             include("functionPrix.php")
            ?> 
        </header>   
        

            <?php

            $deleteAll="DELETE FROM basket WHERE id_user='".$_SESSION['id']."' ";

            // FONCTION PERMETTANT SOIT DELETE ALL SOIT DELETE UN ARTICLE
            function delete($requeteDelete){
                $id_product=$_POST['id_basket'];
                $connexion=mysqli_connect("localhost","root","","boutique");
                $requete=$requeteDelete;
                $query=mysqli_query($connexion,$requete);
                header("location:cart.php");
            }

            function InsertAndDelete($resultat,$connexion){
                foreach($resultat as $achat){

                    $requeteVerif="SELECT id_product FROM bought where id_user='".$_SESSION['id']."'";
                    $queryVerif=mysqli_query($connexion,$requeteVerif);
                    $resultatVerif=mysqli_fetch_all($queryVerif);
                    
                    if($resultatVerif[0]!=$achat[2]){
                        $date=date("Y-m-d:H-m-s");
                        
                        $requeteInsert="INSERT INTO `bought` (`id_user`,`id_product`,`date`,`quantity`) VALUES ('".$achat[1]."','".$achat[2]."','".$date."','".$achat[3]."')";

                        $query=mysqli_query($connexion,$requeteInsert);
                        $requeteDelete="DELETE FROM basket WHERE id_product='".$achat[2]."' AND id_user='".$achat[1]."'";
                        $queryDelete=mysqli_query($connexion,$requeteDelete);
                    }
                }
            }

            if(isset($_POST['removeArticle'])){
                $id_basket=$_POST['id_basket'];
                echo $id_basket;
                $deleteOne="DELETE FROM basket WHERE id='".$id_basket."' AND id_user='".$_SESSION['id']."' ";
                delete($deleteOne);
            }
            // SUPPRESION DES ARTICLES DU PANIER LORS DE L'ACHAT + INSERTION DES DONNEES DU PANIER DANS BOUGHT
            if(isset($_POST['acheter'])){
                if(!empty($product)){
                    ?>
                        <div id="validationPanierbis">
                            Buy product(s)
                            <form method="POST">
                                <div id="formulairePayement">                            
                                    <input id="inputPayement" type="text" name="Name" placeholder="Name">
                                    <input id="inputPayement" type="text" name="LastName" placeholder="Last name">
                                    <input id="inputPayement" type="text" name="Adress" placeholder="Adress">
                                    <input id="inputPayement" type="text" name="Tel" placeholder="Tel">
                                    <input id="inputPayement" type="text" name="Email" placeholder="Email">
                                    <br>
                                    <input id="inputPayement" type="text" name="Codecarte1" placeholder="code1">
                                    <input id="inputPayement" type="text" name="Codecarte2" placeholder="code2">
                                    <input id="inputPayement" type="text" name="Codecarte3" placeholder="code3"></br>
                                    <input id="inputPayement" type='submit' name='validerReel' class="addcartgoback-insideBis" value='Buy Product(s)'>
                                </div>
                            </form>or </br>
                            <a href='cart.php'>Come Back</a> 
                        </div>
                    <?php 
                     }
                else{
                    ?>
                        <div id="validationPanierbis2">
                            You cart is empty... <br><br>
                            <a href='cart.php'>Come Back</a> 
                        </div>
                    <?php
                }

            }
            
            if(isset($_POST['validerReel'])){

                    $connexion=mysqli_connect("localhost","root","","boutique");
                    $requete="SELECT id,id_user,id_product,quantity FROM basket WHERE id_user='".$_SESSION['id']."'";
                    $query=mysqli_query($connexion,$requete);
                    $resultatReel=mysqli_fetch_all($query);

                    InsertAndDelete($resultatReel,$connexion);
                    delete($deleteAll);              
            }
            ?>


        <main class='flexr just-center align-center'>

            <?php 
                $query = "SELECT title, image, users.name, users.avatar as avatar,  products.id as id_prod, size, price, cost , staff, location, orientation, basket.id as id_basket FROM products
                INNER JOIN agents ON products.id_agent = agents.id
                INNER JOIN users ON agents.id_user = users.id
                INNER JOIN basket ON products.id = basket.id_product
                WHERE basket.id_user='".$_SESSION['id']."'";
                $products = $stmt->query($query)->fetchAll(PDO::FETCH_ASSOC); 
            ?>
            
            <section class="flexc">

                <div class="titrePanier">Cart (<?php if(isset($products)){ echo count($products);} else{echo 0;} ?>)
                </div>

            <section id="panierList" class='flexc just-between align-center'>
                
                <div id='products-box-basket' class='flexc just-between align-center'>

                    <!-- AFFICHAGE PRODUIT MIS AU PANIER -->

                    <?php
                    $connexion=mysqli_connect("localhost","root","","boutique");
                    $requetebis="SELECT id,id_user,id_product,quantity FROM basket WHERE id_user='".$_SESSION['id']."'";
                    $querybis=mysqli_query($connexion,$requetebis);
                    $resultatReelbis=mysqli_fetch_all($querybis);
                        

                        if(empty($products)){
                            ?>    <div id="aucunAchat">Your cart is empty</div> <?php
                            }
                            $i=0;
                        foreach($products as $product){ 
                        ?>
                        <div class='flexr just-between product-zone-cart'>

                            <div class='product-box flexr just-between align-center center' 
                                style='background-image:url(<?=$product["image"]?>); background-size:cover;'> 
                            </div>

                            <div class='product-infos-basket flexc just-evenly align-start'>    
                                <p>Size: <?=$product["size"]?></p>
                                <p>Location: <?=$product["location"]?></p>
                                <p>Orientation: <?=$product["orientation"]?></p>
                                <p>Staff: <?=$product["staff"]?></p>
                                <p>Cost/Year: <?php affichagePrix($product["cost"])?></p>

                                <form method="POST">
                                    <input type="hidden" name="id_basket" value="<?php echo $resultatReelbis[$i][0]; $i++ ;?>">
                                    <input type="submit" name="removeArticle" class="removeArticle" value="Remove">
                                </form>

                            </div>
                        </div>
                        <?php 
                        } ?>
                </div>	

                </section>

                <div class="titrePanier">Purchased (<?php if(isset($_SESSION['nb_prod_achete'])){echo $_SESSION['nb_prod_achete'];} else{echo 0;} ?>)
                </div>

                <section id="panierList"  class='flexc just-between align-center'>
            
                    <div id='products-box-basket' class='flexc just-between align-center'>
                        
                        <!-- AFFICHAGE PRODUIT ACHETER -->

                        <?php
                        $requeteBought="SELECT title, image, users.name, users.avatar as avatar, products.id as id_prod, size, price, cost, staff, location, orientation FROM products
                        INNER JOIN agents ON products.id_agent = agents.id
                        INNER JOIN users ON agents.id_user = users.id
                        INNER JOIN bought ON products.id = bought.id_product
                        WHERE bought.id_user='".$_SESSION['id']."'";

                        $productsBought = $stmt->query($requeteBought)->fetchAll(PDO::FETCH_ASSOC); 
                        $_SESSION['nb_prod_achete']=count($productsBought);
                        if(empty($productsBought)){
                        ?>    <div id="aucunAchat">You made no purchase</div> <?php
                        }
                        foreach($productsBought as $product){ 
                        ?>
                            <div class='flexr just-between product-zone'>

                                <div class='product-box flexr just-between align-center center' 
                                style='background-image:url(<?=$product["image"]?>); background-size:cover;'> 
                                </div>

								<div id='product-bought'><?php echo $product['title'] ?>  <br>
                                    Purchased product
                                </div>
								    
                            </div>
                        <?php 
                        } 
                        ?>
                    </div>	

                </section>

            </section>

            <!-- SECTION DIV DROITE INFO ACHAT ET ACHAT -->

            <section id="ValidationAchat">

                    <?php 
                        $connexion=mysqli_connect("localhost","root","","boutique");
                        $requetePrice="SELECT SUM(price) as totalprice FROM products INNER JOIN basket On products.id=basket.id_product WHERE id_user='".$_SESSION['id']."'";
                        $query=mysqli_query($connexion,$requetePrice);
                        $resultatPrice=mysqli_fetch_all($query);

                        $requeteMaxQuantityGroup="SELECT SUM(quantity) FROM basket WHERE id_user='".$_SESSION['id']."' GROUP BY id_product";
                        $queryMaxQuantityGroup=mysqli_query($connexion,$requeteMaxQuantityGroup);
                        $resultatMaxQuantityGroup=mysqli_fetch_all($queryMaxQuantityGroup);

                        
                        $requeteInfo="SELECT id_product, quantity, max_quantity,price as totalprice,title,id_agent FROM basket INNER JOIN products On basket.id_product=products.id WHERE id_user='".$_SESSION['id']."'";
                        $queryInfo=mysqli_query($connexion,$requeteInfo);
                        $resultatInfo=mysqli_fetch_all($queryInfo);
                        // var_dump($resultatInfo);
                        // echo ($requeteInfo);
                    ?>

                <div id="infoProduct">
                    <article id="infoTechnique">
                        Info technique sur le/les biens
                        <!-- HERE -->

                    </article>
                    <article id="option">
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
                    </article>
                </div>
            
                <div id="validationBasket">
                    <article id="InfoAvantValidation">
                    <?php for($i=0;$i<count($resultatInfo); $i++){
                                    if($resultatInfo>1 && $i!=0){
                                        echo "+</br>";
                                        echo $resultatInfo[$i][4]." ".affichagePrix($resultatInfo[$i][3])." x".$resultatInfo[$i][1];
                                    }
                                    else
                                    {
                                        echo $resultatInfo[$i][4]." ".affichagePrix($resultatInfo[$i][3])." x".$resultatInfo[$i][1];
                                    }
                                    
                                    echo "</br>";
                                }
                                echo "</br>";
                                ?><div id="totalPrice"><?php echo "Total Price : </br> ";
                                if(!empty($resultatInfo)){
                                    affichagePrix($resultatPrice[0][0]);} 
                                else{
                                    echo "0 $</br>";
                                }
                                ?></div> <?php
                                 ?>
                                
                    </article>
                </div>
                        <article id="ValidationAchatOk">
                                
                            <div id="affichagePrix">
                                <?php
                                ?>
                            </div>
    
                            <div id="byuBouton">
                                <form method="POST">
                                    <input type="submit" name="acheter" id="acheter" value="Buy product(s)">
                                </form>
                            </div>
    
                        </article>
                
            </section>

        </main>

            </br></br></br>
        <footer>
            <?php include("footer.php"); ?>
        </footer>

    </body>
</html>