<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panier</title>
        <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="CSS/cart.css">
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
                    
                    if(empty($resutatVerif)){
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
            
            $query = "SELECT title, image, users.name, users.avatar as avatar,  products.id as id_prod, size, price, cost , staff, location, orientation, basket.id as id_basket FROM products
            INNER JOIN agents ON products.id_agent = agents.id
            INNER JOIN users ON agents.id_user = users.id
            INNER JOIN basket ON products.id = basket.id_product
            WHERE basket.id_user='".$_SESSION['id']."'";
            $products = $stmt->query($query)->fetchAll(PDO::FETCH_ASSOC); 
        
            // SUPPRESION DES ARTICLES DU PANIER LORS DE L'ACHAT + INSERTION DES DONNEES DU PANIER DANS BOUGHT
            if(isset($_POST['acheter'])){
                if(!empty($products)){
                    ?>
                        <div id="validationPanierbis">
				Buy Product<br><br>
                            <form method="POST">
                                <div id="formulairePayement">                            
                                    <input class="inputPayements center" type="text" required name="Name" placeholder="Name">
                                    <input class="inputPayements center" type="text" required name="LastName" placeholder="Last name">
                                    <input class="inputPayements center" type="text"  required name="Adress" placeholder="Adress">
                                    <input class="inputPayements center" type="tel" required name="Tel" minlength="10" maxlength="11" placeholder="Tel">
                                    <input class="inputPayements center" type="email" required name="Email" placeholder="Email">
                                    <br>
                                    <input class="inputPayements center" type="text" minlength="16" required maxlength="16" name="Codecarte1" placeholder="Card number">
                                    <div id="flexrow">
                                        <input type="number" id="validationPanierbis3" name="trip-start" value="01" min="01" required max="12">
                                        <input type="number" id="validationPanierbis3" name="trip-start1" value="2020" min="2020" required max="2030">
                                    </div>
                                    <input class="inputPayements center" type="text" minlength="3" maxlength="3" required name="Codecarte3" placeholder="Visual cryptogram"></br>
                                    <input id="validationPanierbis4" type='submit' name='validerReel' class="addcartgoback-insideBis" value='Buy Product(s)'>
                                or </br>
                                <a href='cart.php' id="validationPanierbis5" class="addcartgoback-insideBis">Come Back</a> 
                                </div>
                            </form>
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

                if(isset($_POST['Name']) && isset($_POST['LastName']) && isset($_POST['Adress']) && isset($_POST['Tel']) && isset($_POST['Email']) && isset($_POST['Codecarte1']) && isset($_POST['trip-start']) && isset($_POST['trip-start1']) && isset($_POST['Codecarte3']) && isset($_POST['Name'])){

                    $connexion=mysqli_connect("localhost","root","","boutique");
                    $requete="SELECT id,id_user,id_product,quantity FROM basket WHERE id_user='".$_SESSION['id']."'";
                    $query=mysqli_query($connexion,$requete);
                    $resultatReel=mysqli_fetch_all($query);

                    InsertAndDelete($resultatReel,$connexion);
                    delete($deleteAll);  

                    // Si le site était réellement fonctionnelle on proposerait de sauvegarder les informations si l'utilisateur en avait envie, et on crypterai le tout pour proteger les informations confidentielle de l'utilisateur et l'on enverrai cela dans la bdd.
                    // On pourrait également faire une facture, que l'on renverrai sur l'addresse mail que l'utilisateur aurait laissé
                    // Le débit se ferait après vérifications des informations et questionnement de la banque pour savoir si cette achat peux se faire
                    // Après toute ces vérifications et action, l'utilisateur aura acheter le produit, et il en sera informé (fenêtre de confirmation, facture envoyer sur son email etc...)
                } 
                else{
                    echo "Please fill in all the necessary information</br>";
                }          
            }
            ?>


        <main class='flexr just-center align-center'>


            
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
                                style='background-image:url(<?=$product["image"]?>); background-size:cover;width:60em;height:20em;'> 
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
                    <div id="nbcart">
                        Number of Product in your cart : <?php if(isset($products)){ echo count($products);} else{echo 0;} ?> <br>
                    </div>
                    </article>

                    <?php if(!empty($resultatInfo)){
                        $requeteInfo="SELECT DISTINCT id_product, quantity, max_quantity,price as totalprice,title,id_agent FROM basket INNER JOIN products On basket.id_product=products.id WHERE id_user='".$_SESSION['id']."'";
                        $queryInfo=mysqli_query($connexion,$requeteInfo);
                        $resultatInfo=mysqli_fetch_all($queryInfo);
                        ?>
                    <article id="option">
                        <?php

                        $j=1;
                    for($i=0;$i<count($resultatInfo); $i++){
                        $connexion=mysqli_connect("localhost","root","","boutique");
                        $requeteInfoAgent="SELECT name,email,avatar,title FROM users INNER JOIN products ON users.id='".$resultatInfo[$i][5]."'";
                        // echo $requeteInfoAgent;
                        $queryInfoAgent=mysqli_query($connexion,$requeteInfoAgent);
                        $resultatInfoAgent=mysqli_fetch_all($queryInfoAgent);
                        // var_dump($resultatInfoAgent);
                            // var_dump($resultatInfo);
                        ?>
                        <div id="optionDiv">
                            <div id=alignTextProducts><?php echo "Contact Agent (".ucfirst($resultatInfoAgent[$i][3]); ?>)<br></div>
                            <div id="infoAgent"><?php echo "Name : ".ucfirst($resultatInfoAgent[$i][0]); ?><br>
                                <?php echo "Email : ".$resultatInfoAgent[$i][1]; $j++?><br>
                            </div>
                        </div>
                        <?php } }?>
                    </article>
                </div>
            
                <div id="validationBasket">
                    <article id="InfoAvantValidation">
                    <?php for($i=0;$i<count($resultatInfo); $i++){
                                    if($resultatInfo>1 && $i!=0){
                                        echo "+</br>";
                                        echo $resultatInfo[$i][4]." x ".$resultatInfo[$i][1]." = "; affichagePrix($resultatInfo[$i][3]);
                                    }
                                    else
                                    {
                                        echo $resultatInfo[$i][4]." x ".$resultatInfo[$i][1]." = "; affichagePrix($resultatInfo[$i][3]);
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
