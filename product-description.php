<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product description</title>
        <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="CSS/product-description.css">
        <link rel="stylesheet" type="text/css" href="CSS/boot.css">
    </head>


    <body id="product-descritption-body">

        <header> 
            <?php include("header.php");
            include("functionPrix.php");
            ?> 
        </header>    

        <main class='flexr just-center align-center'>

            <?php 

            // requete INFO GENERAL MAISON
            $connexion =mysqli_connect("localhost","root","","boutique");
            $requete="SELECT image as img,title as titre,description as descr,price as prix,users.name as nom_utilisateurs,size as taille,location,orientation,staff, cost,id_agent,max_quantity FROM products INNER JOIN agents ON products.id_agent=agents.id INNER JOIN users ON agents.id_user=users.id where products.id='".$_GET['id']."'";
            $query=mysqli_query($connexion,$requete);
            $resultat=mysqli_fetch_assoc($query);

            // requete TAG
            $requete2="SELECT `sub-category`.name FROM products 
	    		INNER JOIN `sub-category-tag` ON `products`.id=`sub-category-tag`.`id_product` 
			INNER JOIN `sub-category` ON `sub-category-tag`.`id_sub-category` = `sub-category`.id 
			WHERE products.id=".$_GET["id"];
            $query2= mysqli_query($connexion,$requete2);
            $resultat2=mysqli_fetch_all($query2);
            $i=0;
            

            // requete CATEGORIE
            $requete3="SELECT `category`.name FROM category 
		 	INNER JOIN `category-tag` ON `category`.id=`category-tag`.`id_category` 
			WHERE `category-tag`.id_product=".$_GET["id"];
            $query3= mysqli_query($connexion,$requete3);
            $resultat3=mysqli_fetch_all($query3);
            $nameCategory=$resultat3;

	    $requete4="SELECT users.name as name, users.avatar as avatar FROM agents 
	    		INNER JOIN users ON agents.id_user = users.id
			INNER JOIN products ON agents.id = products.id_agent
			WHERE products.id=".$_GET["id"];
	    $query4= mysqli_query($connexion, $requete4);
	    $resultat4=mysqli_fetch_row($query4);
	    $agent = $resultat4;

            $id_product=$_GET['id'];
            $image=$resultat['img'];
            $title=$resultat['titre'];
            $description=$resultat['descr'];
            $price=$resultat['prix'];
            $name=$resultat['nom_utilisateurs'];
            $taille=$resultat['taille'];
            $location=$resultat['location'];
            $orientation=$resultat['orientation'];
            $staff=$resultat['staff'];
            $cost=$resultat['cost'];
            $idAgent=$resultat['id_agent'];
            $max_quantity=$resultat['max_quantity'];
            ?>
            
            <section id="imgDescr"  class='flexc just-center align-center'>

                <div id="img-product" style='background-image:url("<?php echo $image; ?>"); background-size:cover;'>
                </div>

                <div id="descr-product">
                    <article id="titre-product-description"><?php echo $title; ?>
                    </article>
                    <article id="description-product-description"> <?php echo $description; ?>
                    </article>
                    
                    <article id="infos-product-description">
                        <article id="prixetagent">
                            <div id="price-product"><?php affichagePrix($price);?></div>
                            <section id="agent-pics">
                                <div id="agentPics"><img src='Media/Images/Avatars/<?=$agent[1]?>'/></div>
                                <div id="agentName"><?=$agent[0]?></div>
                            </section>
                            
                        </article>

                    </article>
                </div>

            </section>    

            <section id="tag-product-descr">
                <div id="tag">

                    <?php
                        while($i<count($resultat2)){
                            ?>
                            <div class="tagName tag-inside">
                            <?php echo "#".$resultat2[$i][0]."</br>";
                            ++$i;
                            ?>
                            </div>
                            <?php
                        };
                    ?>

                </div>
                <div id="specificites">
                    <div class="specificitesDiv"> Category : <?php foreach($nameCategory as $cat) {echo "|".$cat[0];}?> </div>
                    <div class="specificitesDiv"> Size : <?php echo $taille; ?> m²</div>
                    <div class="specificitesDiv"> Location : <?php echo $location; ?></div>
                    <div class="specificitesDiv"> Direction : <?php echo $orientation; ?></div>
                    <div class="specificitesDiv"> Staff : <?php echo $staff; ?></div>
                    <div class="specificitesDiv"> Cost/Year : <?php affichagePrix($cost); ?></div>
                </div>

                <!-- ADD TO CART SECTION -->
                <div id="addcartgoback"> 
                    <?php $id=$_GET['id']; ?>

                    <form method="POST">
                            <article class='addcartgoback-inside'>
                                <input type="submit" name="valider" class="addcartgoback-insideBis0" value="Add to Cart"><br>
                            </article>
                    </form>

                    <a href="product.php"><article class="addcartgoback-inside">Go Back</article></a>
                </div>
            </section>
        
        </main>


        <?php
        $connexion= mysqli_connect("localhost","root","","boutique");
        $requete= "SELECT * FROM basket where id_product='".$id_product."' AND id_user='".$_SESSION['id']."' ";
        $query= mysqli_query($connexion,$requete);
        $resultatVerif=mysqli_fetch_all($query);

        $requeteBought= "SELECT * FROM bought where id_product='".$id_product."' AND id_user='".$_SESSION['id']."' ";
        $queryB= mysqli_query($connexion,$requeteBought);
        $resultatB=mysqli_fetch_all($queryB);
        
        if(isset($_POST['valider']) && $_POST['valider']=="Add to Cart"){
            
            if(count($resultatB)<$max_quantity){

                // EVITE D'ENVOYER 2 FOIS LA MEME MAISON DANS LA PAGE PANIER

                    if(count($resultatVerif)<$max_quantity AND count($resultatB)<$max_quantity AND (count($resultatVerif)+count($resultatB))<$max_quantity){
                    ?>
                        <div id="validationPanier">
                            Put in your Cart ?
                            <form method="POST">
                                <input type='submit' name='validerReel' class="addcartgoback-insideBis" value='Yes'>
                            </form>or </br>
                            <a href='product-description.php?id=<?php echo $id_product; ?>'>Come Back</a> 
                        </div>

                    <?php
                    }

                else{  
                    ?>
                        <div id="validationPanier">
                            You have <b>reached</b> the maximum purchase number for this product (<?php echo $max_quantity ?> Max) </br><br>
                            <a href='product-description.php?id=<?php echo $id_product; ?>&cat=<?php echo $nameCat;?>'>Come Back</a>
                        </div>
                    <?php
        
                    }
    
            }
            else{  
                ?>
                    <div id="validationPanier">
                        You have <b>bought</b> the maximum purchase number for this product (<?php echo $max_quantity ?> Max) </br><br>
                        <a href='product-description.php?id=<?php echo $id_product; ?>'>Come Back</a>
                    </div>
                <?php
    
                }

        }

        if(isset($_POST['validerReel'])){
            $connexion= mysqli_connect("localhost","root","","boutique");
            $requeteInsert= "INSERT INTO `basket`(`id_user`, `id_product`, `quantity`) VALUES ('".$_SESSION['id']."','".$id_product."',1)";
            $query=mysqli_query($connexion,$requeteInsert);
            // echo $requeteInsert;
        }
        ?>

        <footer>
            <?php include("footer.php"); ?>
        </footer>

    </body>
</html>



