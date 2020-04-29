<?php
	$categorys = $stmt->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);
	$sub_categorys = $stmt->query("SELECT * FROM `sub-category`")->fetchAll(PDO::FETCH_ASSOC);
	if(isset($_POST["submit-category"]))
	{
		if(empty($stmt->query("SELECT * FROM category WHERE name='".$_POST["category_name"]."'")->fetch()))
		{
			if($_POST["category_name"])
			{
				$stmt->query("INSERT INTO category(`id`,`name`) VALUES(NULL,'".$_POST["category_name"]."')");
				header("location:admin.php?category=true");
			}
		}
	}

	if(isset($_POST["submit-sub_category"]))
	{
		if(!empty($_POST["sub_category_name"]) && !empty($_POST["sub_cat-cat"]))
		{
			if(empty($stmt->query("SELECT * FROM `sub-category` WHERE name='".$_POST["sub_category_name"]."'")->fetch()))
			{
				$stmt->query("INSERT INTO `sub-category`(`id`,`name`, `id_category`) VALUES(NULL,'".$_POST["sub_category_name"]."', ".$_POST["sub_cat-cat"].")");
				header("location:admin.php?category=true");
			}
		}
	}

	if(isset($_GET["del_cat"]))
	{
		$stmt->query("DELETE FROM category WHERE id=".$_GET["del_cat"]);
		header("location:admin.php?category=true");
	}
	if(isset($_GET["del_sub_cat"]))
	{
		$stmt->query("DELETE FROM `sub-category` WHERE id=".$_GET["del_sub_cat"]);
		header("location:admin.php?category=true");
	}

?>



<a class='alert-body a-null text-black ' href='admin.php'></a>

<div class='alert-container admin-alert' id='manage-category'>
	<div class='flexr just-around align-center cats-zone'>
	    <div class='flexc just-start align-start admin-product-cat-zone' id='admin-manage-category'>
		    <h1>Category</h1>
		    <div class='flexr just-start wrap align-start admin-product-category'>
			    <?php
				    foreach($categorys as $category)
				    {
					echo "<label for='".$category["name"]."'class='cat-input'>".$category["name"]."
					<a href='admin.php?category=true&&del_cat=".$category["id"]."'/>X</a></label>";
				    }
			    ?>
			    <form action='admin.php?category=true' method='post'>
				<div class='input zone'>
					<input type='text' placeholder='category' name='category_name'/>
					<input type='submit' value='Add' name='submit-category' class='admin-input'/>
				</div>
			    </form>
		    </div>
	    </div>

	<div class=' flexc just-start align-start admin-product-cat-zone' id='admin-manage-sub_category'>
		    <h1>Sub-category</h1>
		    <div class='flexr just-start wrap align-start admin-product-category'>
    <?php
				    foreach($sub_categorys as $category)
				    {
					echo "
					<label for='".$category["name"]."'class='cat-input'>".$category["name"]." 
					<a href='admin.php?category=true&&del_sub_cat=".$category["id"]."'/>X</a></label>";
				    }
			    ?>
			    <form action='admin.php?category=true' method='post'>
				<div class='input zone'>
					<input type='text' placeholder='sub category' name='sub_category_name'/>
					<select name='sub_cat-cat'>
					<option selected disabled >Parent Category</option>
					<?php
					    foreach($categorys as $category)
					    {
							echo "<option value='".$category["id"]."'>".$category["name"]."</option>";
					    }

					?>
					</select>
					<input type='submit' value='Add' name='submit-sub_category' class='admin-input'/>
				</div>
			    </form>

		    </div>
	    </div>
	</div>	
</div>

