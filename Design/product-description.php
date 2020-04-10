<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product description</title>
        <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="CSS/boot.css">
    </head>


    <body id="product-descritption-body">
        <header> 
            <?php include("header.php"); ?> 
        </header>    

        <main class='flexr just-center align-center'>

                    <?php 

                    // requete INFO GENERAL MAISON
                    $connexion =mysqli_connect("localhost","root","","boutique");
                    $requete="SELECT image as img,title as titre,description as descr,price as prix,users.name as nom_utilisateurs,size as taille,location,orientation,staff, cost,id_agent,max_quantity FROM products INNER JOIN agents ON products.id_agent=agents.id INNER JOIN users ON agents.id_user=users.id where products.id='".$_GET['id']."'";
                    $query=mysqli_query($connexion,$requete);
                    $resultat=mysqli_fetch_assoc($query);

                    // requete TAG
                    $nameCat=$_GET['cat'];
                    $requete2="SELECT name FROM sub_category where id_category='".$nameCat."'";
                    $query2= mysqli_query($connexion,$requete2);
                    $resultat2=mysqli_fetch_all($query2);
                    $i=0;

                    // requete CATEGORIE
                    $requete3="SELECT name FROM category where id='".$nameCat."'";
                    $query3= mysqli_query($connexion,$requete3);
                    $resultat3=mysqli_fetch_row($query3);
                    $nameCategory=$resultat3[0];
                    // $requete2="SELECT category.name sub-category.name FROM products INNER JOIN category ON category_tag.id_category = category.id INNER JOIN sub-category ON sub-category-tag.id = sub-category.id INNER JOIN sub-category ON products.id = sub-category.id_product INNER JOIN  category-tag ON products.id = category-tag.id_product where products.id='".$_GET['id']."'";
                    // $query2=mysqli_connect($connexion,$requete2);
                    // $resultat2=mysqli_fetch_all($query2);
                    // var_dump($resultat2);
                    // var_dump($resultat);
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
            
            <section id="imgDescr"  class='flexc just-between align-center'>

                <div id="img-product" style='background-image:url("<?php echo $image; ?>"); background-size:cover;'>
                </div>

                <div id="descr-product">
                    <article id="titre-product-description"><?php echo $title; ?></article>
                    <article id="description-product-description"> <?php echo $description; ?>
                    </article>
                    
                    <article id="infos-product-description">
                        <article id="prixetagent">
                            <div id="price-product"><?php echo $price;?> $</div>
                            <section id="agent-pics">
                                <div id="agentPics">Agent pics</div>
                                <div id="agentName"> Agent name</div>
                            </section>
                            
                        </article>

                        <article id="flex-img-div4">
                            <div class="img-div4">IMG</div>
                            <div class="img-div4">IMG</div>
                            <div class="img-div4">IMG</div>
                            <div class="img-div4">IMG</div>
                        </article>

                    </article>
                </div>

                <div id="agent-note">
                    <article class="agent-note-div">
                        <div class="inside-agent-note"></div>
                        <div class="agent-note-footer">
                            <div class="info-agent">Info agent</div>
                            <div class="agentName1">Agent pics</div>
                        </div>
                    </article>

                    <article class="agent-note-div">
                        <div class="inside-agent-note"></div>
                        <div class="agent-note-footer">
                            <div class="info-agent">Info agent</div>
                            <div class="agentName1">Agent pics</div>
                        </div>
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
                    <div class="specificitesDiv"> Category : <?php echo $nameCategory; ?> </div>
                    <div class="specificitesDiv"> Size : <?php echo $taille; ?> m²</div>
                    <div class="specificitesDiv"> Location : <?php echo $location; ?></div>
                    <div class="specificitesDiv"> Direction : <?php echo $orientation; ?></div>
                    <div class="specificitesDiv"> Staff : <?php echo $staff; ?></div>
                    <div class="specificitesDiv"> Facility : </div>
                    <div class="specificitesDiv"> Cost/Year : <?php echo $cost; ?> $</div>
                </div>
                <div id="addcartgoback"> 
                    <?php $id=$_GET['id']; ?>
                    <a href="cart.php?id=<?php echo $id?>"><article class='addcartgoback-inside'>Add to Cart</article></a><br>
                    <a href="product.php?category=<?php echo $nameCat;?>"><article class="addcartgoback-inside">Go Back</article></a>
                </div>
            </section>
        
        </main>





        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>



