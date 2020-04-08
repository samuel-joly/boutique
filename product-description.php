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
                    $requete="SELECT image FROM products where id='".$_GET['id']."'";
                    $query=mysqli_query($connexion,$requete);
                    $resultat=mysqli_fetch_row($query);
                    $image=$resultat[0];
                    ?>
            
            <section id="imgDescr"  class='flexc just-between align-center'>

                <div id="img-product" style='background-image:url("<?php echo $image; ?>"); background-size:cover;'>
                </div>

                <div id="descr-product">
                    <article id="titre-product-description">Title</article>
                    <article id="description-product-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam ipsam, explicabo earum deleniti praesentium obcaecati? Repellendus quae maxime sapiente vero, debitis temporibus eligendi. Ad facere aliquid in repellendus ab omnis voluptates aspernatur illo rerum necessitatibus ipsa quaerat, iusto magnam rem debitis tempore laboriosam asperiores maxime veniam labore, excepturi, dicta atque!
                    </article>
                    
                    <article id="infos-product-description">Infos
                        <article id="prixetagent">
                            <div id="price-product">PRICE</div>
                            <div id="agentName">Agent name</div>
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
                    Spécificités <br>
                    Spécificités <br>
                    Spécificités <br>
                    Spécificités <br>
                    Spécificités <br>
                </div>
                <div id="addcartgoback"> 
                    <article class="addcartgoback-inside">Add to Cart</article>
                    <article class="addcartgoback-inside">Go Back</article>
                </div>
            </section>
        
        </main>





        <footer>
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>



