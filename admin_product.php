<?php
	$product = $stmt->query("SELECT products.title, products.price, users.name, products.image , products.description,
				products.orientation, products.staff, products.size, products.cost, products.location, 
				products.id_agent as id_agent, products.max_quantity
				FROM products 
				LEFT JOIN agents ON products.id_agent = agents.id
				LEFT JOIN users ON agents.id_user = users.id
				WHERE products.id=".$_GET["change_product"])->fetch(PDO::FETCH_ASSOC);

	$product_cats = $stmt->query("SELECT category.name, category.id
				FROM `category-tag`
				INNER JOIN category ON `category-tag`.id_category = category.id
				WHERE `category-tag`.id_product =".$_GET["change_product"]."
				GROUP BY category.name")->fetchAll(PDO::FETCH_ASSOC);
	$cats = $stmt->query("SELECT category.name, category.id , `category-tag`.id_product AS id_prod FROM category 
				LEFT JOIN `category-tag` ON category.id = `category-tag`.id_category 
				GROUP BY category.name")->fetchAll(PDO::FETCH_ASSOC);

	$product_cats = $stmt->query("SELECT `category`.name, `category`.id, `category-tag`.id_product AS id_prod FROM `category`
					LEFT JOIN `category-tag` ON `category`.id = `category-tag`.`id_category` 
					WHERE `category-tag`.`id_product` = ".$_GET["change_product"])->fetchAll(PDO::FETCH_ASSOC);

	$sub_cats = $stmt->query("SELECT `sub-category`.name, `sub-category`.id , `sub-category-tag`.id_product AS id_prod FROM `sub-category` 
				LEFT JOIN `sub-category-tag` ON `sub-category`.id = `sub-category-tag`.`id_sub-category` 
				GROUP BY `sub-category`.name")->fetchAll(PDO::FETCH_ASSOC);

	
	$product_sub_cats = $stmt->query("SELECT `sub-category`.name, `sub-category`.id, `sub-category-tag`.id_product AS id_prod FROM `sub-category`
					LEFT JOIN `sub-category-tag` ON `sub-category`.id = `sub-category-tag`.`id_sub-category` 
					WHERE `sub-category-tag`.`id_product` = ".$_GET["change_product"]." 
					GROUP BY `sub-category`.name")->fetchAll(PDO::FETCH_ASSOC);

	    if(isset($_POST["submit-change-product"]))
	    {
	    	if(isset($_FILES["admin-image-product"]))
		{
		    if(checkImage($_FILES["admin-image-product"]))
		    {
			$image = 'Media/Images/products/'.$_GET["change_product"].".".pathinfo($_FILES["admin-image-product"]["name"], PATHINFO_EXTENSION);
			foreach(scandir('Media/Images/products/') as $img)
			{
				if(pathinfo($img, PATHINFO_FILENAME) == pathinfo($image, PATHINFO_FILENAME))
				{
					unset($image);
					$image = 'Media/Images/products/'.$_GET["change_product"].".".pathinfo($_FILES["admin-image-product"]["name"], PATHINFO_EXTENSION);
					break;
				}
			}
			move_uploaded_file($_FILES["admin-image-product"]["tmp_name"], $image );		
			$stmt->prepare("UPDATE products SET image='$image' WHERE id=".$_GET["change_product"])->execute();
		    }

		}
		    foreach($_POST as $input=>$value)
		    {
			    switch($input)
			    {
				    case "title":
					    if($value != $product["title"])
					    {
						    if($stmt->query("UPDATE products SET title='".$value."' WHERE id=".$_GET["change_product"]))
						    {
							    echo "<p class='error'>Title has been changed</p>";
						    }
					    }
				    break;

				    case "price":

					    if($value != $product["price"])
					    {
						    if($stmt->query("update products set price='".$value."' where id=".$_GET["change_product"]))
						    {
							    echo "<p class='error'>Price has been changed</p>";
						    }
					    }
				    break;

				    case "desc":

					    if($value != $product["description"])
					    {
						    $value = htmlspecialchars(addslashes($value));
						    if($stmt->query("update products set description='".$value."' where id=".$_GET["change_product"]))
						    {
							    echo "<p class='error'>Description has been changed</p>";
						    }
					    }
				    break;

				    case "size":

					    if($value != $product["size"])
					    {
						    $value = htmlspecialchars(addslashes($value));
						    if($stmt->query("update products set size='".$value."' where id=".$_GET["change_product"]))
						    {
							    echo "<p class='error'>Size has been changed</p>";
						    }
					    }
				    break;

				    case "cost":

					    if($value != $product["cost"])
					    {
						    if($stmt->query("update products set cost='".$value."' where id=".$_GET["change_product"]))
						    {
							    echo "<p class='error'>Cost has been changed</p>";
						    }
					    }
				    break;

				    case "staff":

					    if($value != $product["staff"])
					    {
						    if($stmt->query("update products set staff='".$value."' where id=".$_GET["change_product"]))
						    {
							    echo "<p class='error'>Staff has been changed</p>";
						    }
					    }
				    break;

				    case "orientation":

					    if($value != $product["orientation"])
					    {
						    if($stmt->query("update products set orientation='".$value."' where id=".$_GET["change_product"]))
						    {
							    echo "<p class='error'>Orientation has been changed</p>";
						    }
					    }
				    break;

				    case "location":

					    if($value != $product["location"])
					    {
						    if($stmt->query("update products set location='".$value."' where id=".$_GET["change_product"]))
						    {
							    echo "<p class='error'>Location has been changed</p>";
						    }
					    }
				    break;

				    case "agent":

					    if($value != $product["id_agent"])
					    {
						    if($stmt->query("update products set id_agent=".$value." where id=".$_GET["change_product"]))
						    {
							    echo "<p class='error'>Agent has been changed</p>";
						    }
					    }
				    break;

				    case "category":
					    $stmt->query("DELETE FROM `category-tag` WHERE id_product=".$_GET["change_product"]);
					    foreach($value as $selected_category)
					    {
						$stmt->query("INSERT INTO `category-tag`(`id`, `id_category`, `id_product`)
								    VALUES(NULL, ".$selected_category.", ".$_GET["change_product"].")");
					    }
				    break;

				    case "sub_category":
					    $stmt->query("DELETE FROM `sub-category-tag` WHERE id_product=".$_GET["change_product"]);
					    foreach($value as $selected_sub_category)
					    {
						$stmt->query("INSERT INTO `sub-category-tag`(`id`, `id_sub-category`, `id_product`)
								    VALUES(NULL, ".$selected_sub_category.", ".$_GET["change_product"].")");
					    }
				    break;
			    }
		    }
		    unset($_POST);
		    header("location:admin.php");

		}


?>
<a class='alert-body a-null text-black ' href='admin.php'></a>





<div class='alert-container admin-alert'>
	

	<form action='admin.php?change_product=<?= $_GET["change_product"] ?>' method='post' id='admin-product-form' enctype='multipart/form-data'>
		<label for='admin-image-product' id='admin-product-image'>
			<img src='<?= $product["image"] ?>'/>
			<div id='image-overlay'><p>Click to change<br/> Image</p></div>
			<input type='file' id='admin-image-product' name='admin-image-product' />	
		</label>

		<div class='flexr just-center align-center' id='triple-input'>

		    <span class='flexc just-start align-start double-input'>
			    <span class='flexr just-between align-center'>

				<div class='input-zone admin-manage-input flexr just-start align-center'>
					<label for='title'>Title</label>
					<input type='text' value='<?= $product["title"] ?>' name='title'/>
				</div>

				<div class='input-zone admin-manage-input just-center align-center'>
					<label for='price'>Price</label>
					<input type='text' value='<?= $product["price"] ?>' name='price'/>
				</div>

			    </span>
			<textarea id='admin-product-desc' rows='6' cols='47' name='desc'> <?= $product["description"] ?> </textarea>
		    </span>

		    <div class='flexc just-center align-center' id='product-infos'>
			<div class='input-zone admin-manage-input flexr just-center align-center input-little'>
				<span>
				    <label for='size'>Size</label>
				    <input type='text' name='size' value='<?= $product["size"] ?>'/>
				</span>

				<span>
				    <label for='cost'>Cost</label>
				    <input type='text' name='cost' value='<?= $product["cost"] ?>'/>
				</span>
			</div>

			<div class='input-zone admin-manage-input flexr just-center align-center input-little'>
				<span>
				    <label for='staff'>Staff</label>
				    <input type='text' name='staff' value='<?= $product["staff"]?>'/>
				</span>

				<span>
				    <label for='location'>Area</label>
				    <input type='text' value='<?= $product["location"] ?>' name='location'/>
				</span>

				<span>
				    <label for='quantity'>Quantity</label>
				    <input type='text' name='quantity' value='<?= $product["max_quantity"]?>'/>
				</span>
				
			</div>


			<div class='input-zone admin-manage-input flexr just-center align-center input-little'>
				<span>
				    <label for='orientation'>Face</label>
				    <input type='text' name='orientation' value='<?= $product["orientation"]?>'/>
				</span>

				<span>
				    <label for='agent'>Agent</label>
				    <select name='agent'>
					    <?php
						    $selected = "";
						    foreach($agents as $agent)
						    {
							    if($agent["id"] == $product["id_agent"])
							    {
								    $selected = "selected";
							    }
							    echo "<option value='".$agent["id"]."' ".$selected.">".$agent["name"]."</option>";
							    $selected = "";
						    }
					    ?>
				    </select>
				</span>
			</div>
		    </div>

		</div>

		<div class='flexr just-around align-center cats-zone'>
		    <div class=' flexc just-start align-start admin-product-cat-zone'>
			    <h1>Category</h1>
			    <div class='flexr just-start wrap align-start admin-product-category'>
				    <?php
					    $filter = [];
					    foreach($product_cats as $cat)
					    {
						    echo "
						    <label for='".$cat["name"]."'class='cat-input'>".$cat["name"]." 
						    <input type='checkbox' name='sub_category[]' value='".$cat["id"]."' id='".$cat["name"]."'
						      checked/></label>";
						     array_push($filter,$cat["name"]);
					    }
					    foreach($cats as $category)
					    {
						    if(!in_array($category["name"], $filter))
						    {
							    echo "
							    <label for='".$category["name"]."'class='cat-input'>".$category["name"]." 
							    <input type='checkbox' name='category[]' value='".$category["id"]."' id='".$category["name"]."'
							     /></label>";
						    }
					    }
				    ?>
			    </div>
		    </div>

		    <div class=' flexc just-start align-start admin-product-cat-zone'>
			    <h1>Sub-category</h1>
			    <div class='flexr just-start wrap align-start admin-product-category'>
				    <?php
					    $filter = [];
					    foreach($product_sub_cats as $sub_cat)
					    {
						    echo "
						    <label for='".$sub_cat["name"]."'class='cat-input'>".$sub_cat["name"]." 
						    <input type='checkbox' name='sub_category[]' value='".$sub_cat["id"]."' id='".$sub_cat["name"]."'
						      checked/></label>";
						     array_push($filter,$sub_cat["name"]);
					    }
					    foreach($sub_cats as $category)
					    {
						    if(!in_array($category["name"], $filter))
						    {
							
							echo "
							<label for='".$category["name"]."'class='cat-input'>".$category["name"]." 
							<input type='checkbox' name='sub_category[]' value='".$category["id"]."' id='".$category["name"]."'
							  /></label>";
							 array_push($filter,$category["name"]);
						    }
					    }
				    ?>
			    </div>
		    </div>

		    
	    </div>

	    <div class='flexr just-center align-center'>
		<input type='submit' name='submit-change-product' value='Save change' class='admin-input'/>
		<a href='admin.php' class='admin-remove' >Return</a>
	    </div>

	</form>
</div>


