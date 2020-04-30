<?php
            $deleteAll="DELETE FROM basket WHERE id_user='".$_SESSION['id']."' ";
            // FONCTION PERMETTANT SOIT DELETE ALL SOIT DELETE UN ARTICLE
            function delete($requeteDelete){
                $connexion=mysqli_connect("localhost","root","","boutique");
                $requete=$requeteDelete;
                $query=mysqli_query($connexion,$requete);
                header("location:profil.php?show=bought");
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
	if(isset($_GET["del_prod"]))
	{
		$stmt->query("DELETE FROM basket WHERE id_product=".$_GET["del_prod"]);
		$link = "profil.php?show=cart";
		header($link);
	}
    $query = "SELECT title, image, users.name, users.avatar as avatar,products.description as description,products.id as id,  products.id as id_prod, size, price, cost , staff, location, orientation,
    basket.id as id_basket FROM products
    INNER JOIN agents ON products.id_agent = agents.id
    INNER JOIN users ON agents.id_user = users.id
    INNER JOIN basket ON products.id = basket.id_product
    WHERE basket.id_user='".$_SESSION['id']."'";
    $products = $stmt->query($query)->fetchAll(PDO::FETCH_ASSOC);
    if(isset($_GET['gotopayment'])){
	if(!empty($products)){
	    ?>
	    
		<a class='alert-body a-null text-black ' href='profil.php?show=cart'></a>

		<div class='alert-container admin-alert' id='bought-zone'>

		<div id="validationPanierbis">
		    Enter your credit card data <br><br>
		    <form method="POST">
			<div id="formulairePayement" class='flexc just-center align-center'>
			<div class='flexr just-start align-center'>
			    <input id="inputPayement" type="text" required name="Name" placeholder="Name">
			    <input id="inputPayement" type="text" required name="LastName" placeholder="Last name">
			</div>
			<div class='flexr just-start align-center'>
			    <input id="inputPayement" type="text"  required name="Adress" placeholder="Adress">
			    <input id="inputPayement" type="tel" required name="Tel" minlength="10" maxlength="11" placeholder="Tel">
			</div>
			    <input id="inputPayement" type="email" required name="Email" placeholder="Email">
			    <br>
			    <input id="inputPayement" type="text" minlength="16" required maxlength="16" name="Codecarte1" placeholder="Card number">
			    <div id="flexrow">
				<input type="number" name="trip-start" value="01" min="01" required max="12">
				<input type="number" name="trip-start1" value="2020" min="2020" required max="2030">
			    </div>
			    <input id="inputPayement" type="text" minlength="3" maxlength="3" required name="Codecarte3" placeholder="Visual cryptogram"></br>
			    <input id="inputPayement" type='submit' class='cart-btn' name='validerReel' class="addcartgoback-insideBis" value='Buy Product(s)'>
			    or </br>
		    <a class='cart-btn a-null text-black' href='cart.php'>Come Back</a> 

			</div>
		    </form>		</div></div>
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


        if(empty($products))
	{ ?>
		<div id="aucunAchat">Your cart is empty</div>
<?php   }

    foreach($products as $product)
    {
	    echo "<div class='profil-data-container'>";
		    echo "<div class='bought-product-zone flexr just-between align-center'>";
			    echo "<div class='flexc just-start align-start bought-product-title'>";
				    echo "<h1><u>".$product["title"]."</u></h1>";
				    echo "<p>".$product["price"]."$</p>";
				    echo "<p class='bought-product-desc'>".$product["description"]."</p>";
			    echo "</div>";

			    echo "<div class='bought-agent-zone flexc align-center just-center'>";
				    echo "<img src='".$product["image"]."' class='bought-product-image'/>";
				    echo "<a class='a-null text-black cart-btn' style='margin:0.2em;' href='profil.php?show=cart&&del_prod=".$product["id"]."'>Remove from cart</a>";
			    echo "</div>";
		    echo "</div>";
	    echo "</div>";
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
