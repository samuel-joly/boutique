<!--<div style='position:absolute; top:0px;left:0px;  display:flex; align-items:center; justify-content:center; width:100%; height:100%; background:rgba(0,0,0,0.5);'>
<div style='width:fit-content;height:fit-content;border-radius:10px; background-color:#4c4b4b; padding:1em;'>--!>

<?php
	$query = "SELECT title, image, users.name, users.avatar as avatar, products.id as id_prod, size, price, cost , staff, location, orientation FROM products
	INNER JOIN agents ON products.id_agent = agents.id INNER JOIN users ON agents.id_user = users.id";
	
	$is_first = true;
	
	if(!empty($_POST["cat"]) || !empty($_POST["sub_cat"]))
	{
		$query .= " INNER JOIN `category-tag` ON products.id = `category-tag`.id_product INNER JOIN `sub-category-tag` ON products.id = `sub-category-tag`.id_product";
	}
	
	foreach($_POST as $key=>$value)
	{
		if(!empty($value) && $key != "filter_submit") {
		
			if($is_first)
			{
				$query .= " WHERE ";
				$is_first = false;
			}
			else
			{
				$query .= " AND ";
			}

			switch($key)
			{
				case "min-price":
					$query .= "price>=".($value*1000);
				break;
				
				case "max-price":
					$query .= "price<=".($value*1000);
				break;
				
				case "min-size":
					$query .= "size>=".$value;
				break;
				
				case "max-size":
					$query .= "size<=".$value;
				break;
				
				case "cat":
					$is_cat_first = true;
					foreach($value as $cat_val)
					{
						if($is_cat_first)
						{
							$is_cat_first = false;
						}
						else
						{
							$query .= " AND ";
						}
						
						$query .= " EXISTS( SELECT `category-tag`.`id_product` FROM `category-tag` WHERE `category-tag`.`id_category` = ".$cat_val." AND
						`category-tag`.`id_product` = `products`.`id`)";
					}
				break;
				
				case "sub_cat":
					$is_sub_cat_first = true;
					foreach($value as $sub_cat_val)
					{
						if($is_sub_cat_first)
						{
							$is_sub_cat_first = false;
						}
						else
						{
							$query .= " AND ";
						}
						
						$query .= " EXISTS( SELECT `sub-category-tag`.`id_product` FROM `sub-category-tag` WHERE
						`sub-category-tag`.`id_sub-category` = ".$sub_cat_val." AND `sub-category-tag`.`id_product` = `products`.`id`)";
					}

				break;

				case 'search':
					
				break;
				
			}


		}
	}

	if(!empty($_POST["cat"]) || !empty($_POST["sub_cat"]))
	{
		$query .= " GROUP BY title";
	}

	$_SESSION["product_filter"] = $query;
?>

<!--</div>
</div> --!>
