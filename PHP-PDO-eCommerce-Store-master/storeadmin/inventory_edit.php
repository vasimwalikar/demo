<!DOCTYPE html>
<htmL>
<head>
    <title>Inventory List</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>

	<?php
	// start the session
	session_start();
	// make sure the user is logged in (if the session variable "manager" is set or not)
	if (!isset($_SESSION["manager"])) {
		//otherwise send to the login page
		header("location: admin_login.php");
		// prevent resof of the page from running if user is not logged in
		exit();
	}
	// get value from session variables and assign them to to local variables
	$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter non-numbers for security preg_replace(RegEx, substitute , data )
	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter non-numbers and non-letters for security
	$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]);
	// connect to MySQL Database
	include "../connect_to_mysql_pdo.php";
	//$res= $dbh->prepare("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1");
	$res= $dbh->prepare("SELECT * FROM admin WHERE id=? AND username=? AND password=? LIMIT 1");
	$res->execute([$managerID,$manager,$password]);
	$existCount = $res->rowCount();  //count the number of rows, same as mysql mysql_num_rows($sqlquery);
	if($existCount==0){
		echo "Your login session data is not on record in the database. Please log in again here:<a href='admin_login.php'>Admin Login</a><br>"; //echo this if someone tries to forge session cookies
		exit(); // prevent resof of the page from running if user is not logged in
	}

	/*-------------------- GET(PARSE) FORM DATA ---------------*/
	if(isset($_POST['fr_itemname']) && isset($_POST["fr_price"])) {
		$fr_id = $_POST['this_id'];
 		$fr_name = $_POST['fr_itemname'];
 		$fr_price = $_POST['fr_price'];
 		$fr_category = $_POST['fr_category'];
 		$fr_subcategory = $_POST['fr_subcategory'];
 		$fr_details = $_POST['fr_details'];

 		$res= $dbh->prepare("UPDATE products SET product_name=?, price=?, category=?, subcategory=?, details=? WHERE id=?");
		$res->execute([$fr_name, $fr_price, $fr_category, $fr_subcategory, $fr_details, $fr_id]);
		if($_FILES['fr_image']['tmp_name'] != "") {
			$newname = "$fr_id.jpg";
			move_uploaded_file($_FILES['fr_image']['tmp_name'], "../inventory_images/".$newname);
		}
		// prevent form resubmission on reload
		header("location: inventory_list.php");
		exit();
	}

	/*-------------------- EDIT ITEMS-------------------*/
	if(isset($_GET["pid"])){
		$targetID = $_GET["pid"];
		$product_list = "";
		$res = $dbh->prepare("SELECT * FROM products WHERE id='$targetID' LIMIT 1");
		$res->execute();
		$productCount = $res->rowCount();
		if ($productCount > 0) {
			while ($row = $res->fetch()) {
				// $product_id = $row['id'];
	    		$product_name = $row['product_name'];
	    		$product_price = $row['price'];
	    		$product_cat = $row['category'];
	    		$product_subcat = $row['subcategory'];
	    		$product_details = $row['details'];
	    		$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
    		}
		}
		else {
			echo "Item with ID $targetID does not exist!";
			exit();
		}
	}
	?>
	<style type="text/css">
		.input-group-addon {
			min-width: 125px;
			text-align: right;
		}

	</style>
</head>
<body>
<?php include_once("../header.php"); ?>
<div class="container">
	<div class="row">
		<form id="form1" name="form1" method="post" action="inventory_edit.php" class="form-horizontal" enctype="multipart/form-data">
			<div class="form-group hidden">
			    <div class="input-group">
			    	<span class="input-group-addon">Product ID</span>
					<input name="this_id" type="text" class="form-control" id="this_id" size="40" value="<?php echo $targetID;?>"/>
				</div>
			</div>
			<div class="form-group">
			    <div class="input-group">
			    	<span class="input-group-addon">Product ID</span>
					<input name="showid" type="text" class="form-control" id="showid" size="40" value="<?php echo $targetID;?>" disabled/>
				</div>
			</div>
			<div class="form-group">
			    <div class="input-group">
			    	<span class="input-group-addon">Product Name</span>
					<input name="fr_itemname" type="text" class="form-control" id="fr_itemname" size="40" value="<?php echo $product_name;?>"/>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
			    	<span class="input-group-addon">Product Price</span>
					<input name="fr_price" type="text" class="form-control" id="fr_price" size="40" value="<?php echo $product_price;?>" />
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
			    	<span class="input-group-addon">Category</span>
					<input name="fr_category" type="text" class="form-control" id="fr_category" size="40" value="<?php echo $product_cat;?>" />
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
			    	<span class="input-group-addon">Subcategory</span>
					<input name="fr_subcategory" type="text" class="form-control" id="fr_subcategory" size="40" value="<?php echo $product_subcat;?>" />
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
			    	<span class="input-group-addon">Product Details</span>
					<textarea name="fr_details" rows="4" class="form-control" id="fr_details" size="40"><?php echo $product_details;?></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
			    	<span class="input-group-addon">Product Image</span>
					<input name="fr_image" type="file" class="form-control" id="fr_image" />
				</div>
			</div>
			<div class="form-group">
			<input name="button" type="submit" class="btn btn-default btn-primary" id="button" value="Make Changes"/>
			<a class="btn btn-default" href="inventory_list.php">Cancel</a>
			<!--<p class="helper-text">Not an admin? <a href="#">Go to the store.</a></p>-->
			</div>
		</form>
	</div>
</div>
<?php include_once("../footer.php"); ?>
</body>
</htmL>