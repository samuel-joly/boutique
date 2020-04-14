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
            if(isset($_POST['removeArticle'])){
                $id_product=$_POST['id_product'];
                $connexion=mysqli_connect("localhost","root","","boutique");
                $requete="DELETE FROM basket WHERE id_product='".$id_product."' AND id_user='".$_SESSION['id']."' ";
                $query=mysqli_query($connexion,$requete);
                header("location:cart.php");
            }
            ?>


        <main class='flexr just-center align-center'>

            <section id="panierList"  class='flexc just-between align-center'>
            
                <div id='products-box-basket' class='flexc just-between align-center'>

                    <?php
                        $query = "SELECT title, image, users.name, users.avatar as avatar,  products.id as id_prod, size, price, cost , staff, location, orientation, basket.id as id_basket FROM products
                        INNER JOIN agents ON products.id_agent = agents.id
                        INNER JOIN users ON agents.id_user = users.id
                        INNER JOIN basket ON products.id = basket.id_product
                        WHERE basket.id_user='".$_SESSION['id']."'";
                        
                    $products = $stmt->query($query)->fetchAll(PDO::FETCH_ASSOC); 
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
                                        <input type="submit" name="removeArticle" id="removeArticle" value="Remove">
                                    </form>

                                </div>
                            </div>
                        <?php } ?>
                </div>	

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
                <?php
                if(isset($_POST['acheter'])){
                    $connexion=mysqli_connect("localhost","root","","boutique");
                    $requete="SELECT id,id_user,id_product,quantity FROM basket WHERE id_user='".$_SESSION['id']."'";
                    $query=mysqli_query($connexion,$requete);
                    $resultat=mysqli_fetch_all($query);
                    var_dump($resultat);

                    foreach($resultat as $achat){
                        $date=date("Y-m-d:H-m-s");
                        $requeteInsert="INSERT INTO `bought` (`id_user`,`id_product`,`date`,`quantity`) VALUES ('".$achat[1]."','".$achat[2]."','".$date."','".$achat[3]."')";
                        $query=mysqli_query($connexion,$requeteInsert);
                        echo $requete;
                    }

                }
                ?>


    




        <footer>
            <?php include("footer.php"); ?>
        </footer>

    </body>
</html>