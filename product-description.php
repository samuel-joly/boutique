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
                    $connexion =mysqli_connect("localhost","root","","boutique");
                    $requete="SELECT image as img,title as titre,description as descr,price as prix,users.name as nom_utilisateurs,size as taille,location,orientation,staff, cost,id_agent,max_quantity FROM products INNER JOIN agents ON products.id_agent=agents.id INNER JOIN users ON agents.id_user=users.id where products.id='".$_GET['id']."'";
                    $query=mysqli_query($connexion,$requete);
                    $resultat=mysqli_fetch_assoc($query);
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
                    
                    <article id="infos-product-description">Infos
                        <article id="prixetagent">
                            <div id="price-product"><?php echo $price;?></div>
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
                            <div class="info-agent">Infos agent</div>
                            <div class="agentName1">Agent name</div>
                        </div>
                    </article>

                    <article class="agent-note-div">
                        <div class="inside-agent-note"></div>
                        <div class="agent-note-footer">
                            <div class="info-agent">Infos agent</div>
                            <div class="agentName1">Agent name</div>
                        </div>
                    </article>
                </div>

            </section>    

            <section id="tag-product-descr">
                <div id="tag">
                    <article class="tag-inside">Tag</article>
                    <article class="tag-inside">Tag</article>
                    <article class="tag-inside">Tag</article>
                    <article class="tag-inside">Tag</article>
                    <article class="tag-inside">Tag</article>
                </div>
                <div id="specificites">
                    Category : <br>
                    Size : <?php echo $taille; ?>m²<br>
                    Location : <?php echo $location; ?><br>
                    Direction : <?php echo $orientation; ?><br>
                    Staff : <?php echo $staff; ?><br>
                    Facility : <br>
                    Cost/Year : <?php echo $cost; ?>$<br>
                </div>
                <div id="addcartgoback"> 
                    <?php $id=$_GET['id']; ?>
                    <a href="cart.php?id=<?php echo $id?>"><article class='addcartgoback-inside'>Add to Cart</article></a>
                    <a href="product.php"><article class="addcartgoback-inside">Go Back</article></a>
                </div>
            </section>
        
        </main>





        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>



