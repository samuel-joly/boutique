
<?php

	$cats = $stmt->query("SELECT category.name, category.id , `category-tag`.id_product AS id_prod FROM category 
				LEFT JOIN `category-tag` ON category.id = `category-tag`.id_category 
				GROUP BY category.name")->fetchAll(PDO::FETCH_ASSOC);

	$sub_cats = $stmt->query("SELECT `sub-category`.name, `sub-category`.id FROM `sub-category` 
				GROUP BY `sub-category`.name")->fetchAll(PDO::FETCH_ASSOC);

	$error = [];
	    if(isset($_POST["submit-add-product"]))
	    {
	    	if(isset($_FILES["admin-image-product"]))
		{
		    foreach($_POST as $input=>$value)
		    {
			    switch($input)
			    {
				    case "title":
					    if($value != "")
					    {
					    	$title = $value;
					    }
					    else
					    {
						$error[] = "title missing";
					    }
				    break;

				    case "price":

					    if($value != "")
					    {
					    	$price = $value;
					    }
					    else
					    {
						$error[] = "price missing";
					    }
				    break;

				    case "desc":

					    if($value != "")
					    {
					    	$desc = $value;
					    }
					    else
					    {
						$error[] = "description missing";
					    }
				    break;

				    case "size":

					    if($value != "")
					    {
					    	$size = $value;
					    }
					    else
					    {
						$error[] = "size missing";
					    }
				    break;

				    case "cost":

					    if($value != "")
					    {
					    	$cost = $value;
					    }
					    else
					    {
						$error[] = "cost missing";
					    }
				    break;

				    case "staff":

					    if($value != "")
					    {
					    	$staff = $value;
					    }
					    else
					    {
						$error[] = "staff missing";
					    }
				    break;

				    case "orientation":

					    if($value != "")
					    {
					    	$orientation = $value;
					    }
					    else
					    {
						$error[] = "orientation missing";
					    }
				    break;

				    case "location":

					    if($value != "")
					    {
					    	$location = $value;
					    }
					    else
					    {
						$error[] = "location missing";
					    }
				    break;

				    case "agent":

					    if($value != "")
					    {
					    	$agent = $value;
					    }
					    else
					    {
						$error[] = "agent missing";
					    }
				    break;

				    case "max_quantity":

					    if($value != "")
					    {
					    	$quantity = $value;
					    }
					    else
					    {
						$error[] = "max_quantity missing";
					    }
				    break;
				    
			    }
		    }
		    if(empty($error))
		    {
			    if(empty($stmt->query("SELECT * FROM products WHERE title='$title'")->fetchAll()))
			    {
				    if(empty($error) &&  isset($_FILES["admin-image-product"]))
				    {
					    $stmt->prepare("INSERT INTO `products`(`id`, `price`, `title`, `description`, `image`, `size`, `location`, `orientation`, `staff`, `cost`, `id_agent`, `max_quantity`) 
					     VALUES (NULL, $price, '$title','$desc', 'default',$size, '$location','$orientation',$staff,$cost,$agent, $quantity )")->execute();
					     $id = $stmt->query("SELECT id FROM products WHERE title='".$title."'")->fetch(PDO::FETCH_ASSOC)["id"];

					    if(checkImage($_FILES["admin-image-product"]))
					    {
						$image = 'Media/Images/products/'.$id.".".pathinfo($_FILES["admin-image-product"]["name"], PATHINFO_EXTENSION);
						foreach(scandir('Media/Images/products/') as $img)
						{
							if("Media/Images/products/".$img == $image)
							{
								unset($image);
								$image = 'Media/Images/products/'.$id.".".pathinfo($_FILES["admin-image-product"]["name"], PATHINFO_EXTENSION);
								break;
							}
						}
						move_uploaded_file($_FILES["admin-image-product"]["tmp_name"], $image );		
						$stmt->prepare("UPDATE products SET image='$image' WHERE id=".$id)->execute();
					    }
					
					foreach($_POST["category"] as $category)
					{
						$stmt->query("INSERT INTO `category-tag`(`id`,`id_category`,`id_product`) 
							      VALUES(NULL, $category, $id)");
					}
					
					foreach($_POST["sub_sub_category"] as $subcategory)
					{
						$stmt->query("INSERT INTO `sub-category-tag`(`id`,`id_sub-category`,`id_product`) 
							      VALUES(NULL, '$subcategory', $id)");
					}
				    }
			    }
			    unset($_POST);
			    header("location:admin.php");
		    }
		    else
		    {
			//echo renderError($error);
		    }
		}
	    }

?>
<a class='alert-body a-null text-black ' href='admin.php'></a>

<div class='alert-container admin-alert'>
	
	<form action='admin.php?add_product=true' method='post' id='admin-product-form' enctype='multipart/form-data'>
		<label for='admin-image-product' id='admin-product-image'>
			<img src='Media/Images/default.jpg'/>
			<div id='image-overlay'><p>Click to change<br/> Image</p></div>
			<input type='file' id='admin-image-product' name='admin-image-product' />	
		</label>

		<div class='flexr just-center align-center' id='triple-input'>

		    <span class='flexc just-start align-start double-input'>
			    <span class='flexr just-between align-center'>

				<div class='input-zone admin-manage-input flexr just-start align-center'>
					<label for='title'>Title</label>
					<input type='text' name='title'/>
				</div>

				<div class='input-zone admin-manage-input just-center align-center'>
					<label for='price'>Price</label>
					<input type='text' name='price'/>
				</div>

			    </span>
			<textarea id='admin-product-desc' rows='6' cols='47' name='desc'></textarea>
		    </span>

		    <div class='flexc just-center align-center' id='product-infos'>
			<div class='input-zone admin-manage-input flexr just-center align-center input-little'>
				<span>
				    <label for='size'>Size</label>
				    <input type='text' name='size' />
				</span>

				<span>
				    <label for='cost'>Cost</label>
				    <input type='text' name='cost' />
				</span>
			</div>

			<div class='input-zone admin-manage-input flexr just-center align-center input-little'>
				<span>
				    <label for='staff'>Staff</label>
				    <input type='text' name='staff' />
				</span>

				<span>
				    <label for='location'>Area</label>
				    <input type='text' name='location'/>
				</span>

				<span>
				    <label for='max_quantity'>Quantity</label>
				    <input type='text' name='max_quantity' />
				</span>
			</div>

			<div class='input-zone admin-manage-input flexr just-center align-center input-little'>
				<span>
				    <label for='orientation'>Face</label>
				    <input type='text' name='orientation' />
				</span>
				
				<span>
				    <label for='agent'>Agent</label>
				    <select name='agent'>
					    <?php
						    foreach($agents as $agent)
						    {
							    echo "<option value='".$agent["id"]."'>".$agent["name"]."</option>";
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
					    foreach($cats as $category)
					    {
						    echo "
						    <label for='".$category["name"]."'class='cat-input'>".$category["name"]." 
						    <input type='checkbox' name='category[]' value='".$category["id"]."' id='".$category["name"]."'
						    /></label>";
					    }
				    ?>
			    </div>
		    </div>

		    <div class=' flexc just-start align-start admin-product-cat-zone'>
			    <h1>Sub-category</h1>
			    <div class='flexr just-start wrap align-start admin-product-category'>
				    <?php
					    foreach($sub_cats as $sub_category)
					    {
						echo "
						<label for='".$sub_category["name"]."'class='cat-input'>".$sub_category["name"]." 
					<input type='checkbox' name='sub_sub_category[]' value='".$sub_category["id"]."' id='".$sub_category["name"]."'
						/></label>";
					    }
				    ?>
			    </div>
		    </div>

		    
	    </div>

	    <div class='flexr just-center align-center'>
		<input type='submit' name='submit-add-product' value='Save change' class='admin-input'/>
		<a href='admin.php' class='admin-remove'>Return</a>
	    </div>

	</form>
</div>


