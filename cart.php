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
            
                <?php
                $connexion= mysqli_connect("localhost","root","","boutique");
                $requete=" SELECT * FROM basket AS PAN INNER JOIN products AS PRO On PRO.id=PAN.id_product WHERE id_user='".$_SESSION['id']."'";
                $query=mysqli_query($connexion,$requete);
                $resultat=mysqli_fetch_all($query);

                for($i=0;$i<count($resultat);++$i){

                    ?>
                        <div id="houseInBasket">
                    <?php

                    echo $idProductBasket=$resultat[$i][0].'</br>';
                    echo $idProduct=$resultat[$i][2].'</br>';
                    echo $quantity=$resultat[$i][3].'</br>';
                    echo $price=$resultat[$i][5].'</br>';
                    echo $title=$resultat[$i][6].'</br>';
                    echo $img=$resultat[$i][8].'</br>';
                    echo $size=$resultat[$i][9].'</br>';
                    echo $location=$resultat[$i][10].'</br>';
                    echo $orientation=$resultat[$i][11].'</br>';
                    echo $staff=$resultat[$i][12].'</br>';
                    echo $cost=$resultat[$i][13].'</br>';
                    echo $idAgent=$resultat[$i][14].'</br>';
                    echo $maxQuantity=$resultat[$i][15].'</br>';

                    ?>
                        </div>
                    <?php
                }
                ?>

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
                    Les options proposées sur le/les biens
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