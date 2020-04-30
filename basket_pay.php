<?php

	$requeteInfo="SELECT DISTINCT id_product, quantity, max_quantity,price as totalprice,
	title,id_agent FROM basket 
	INNER JOIN products On basket.id_product=products.id WHERE id_user='".$_SESSION['id']."'";
	$resultatInfo=$stmt->query($requeteInfo)->fetchAll();
	$requetePrice="SELECT SUM(price) as totalprice 
	FROM products 
	INNER JOIN basket On products.id=basket.id_product WHERE id_user='".$_SESSION['id']."'";
	$resultatPrice=$stmt->query($requetePrice)->fetchAll();

?>
<div id="validationBasket" class='flexr just-center align-center'>
	<div class='flexc just-center align-center'>
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
		?></div> 		
    </article>
    	<a class='cart-btn a-null text-black' href='profil.php?show=cart&&gotopayment=true' >Go to payment</a>
    </div>
</div>
