<?php
if(isset($_GET['id'])){
    $id = preg_replace('#[^0-9]#i', '',$_GET['id']);
}
else{
    echo "no such product exist";
    exit();
    $dbh = null;
}
include "connect_to_mysql_pdo.php";
$dynamic_list = "";
    $res = $dbh->prepare("SELECT * FROM products WHERE id='$id' LIMIT 1");
    $res->execute();
    $productCount = $res->rowCount();
    if ($productCount > 0) {
        while ($row = $res->fetch()) {
            $product_id = $row['id'];
            $product_name = $row['product_name'];
            $product_price = $row['price'];
            $product_cat = $row['category'];
            $product_subcat = $row['subcategory'];
            $product_details = $row['details'];
            $check = $product_details;
            if (strlen(trim($check)) == 0){
                $product_details = "<u>No Details</u>";
            }
            $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }
    }

    else {
        $dynamic_list = "This product does not exist.";
    }
    $dbh = null;
?>
<!DOCTYPE html>
<htmL>
<head>
    <title><?php echo $product_name;?> - Ecommerce Store</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style type="text/css">
        body {
            margin-top: 25px;
        }
        .thumbnail img{
            width: 100%;
        }
        .caption-full {
            padding-right: 10px;
            padding-left: 10px;
        }
        .extra-data {
            padding-right: 10px;
            padding-left: 10px;
            color: #d17581;
        }
        .thumbnail .caption-full {
            padding: 9px;
            color: #333;
        }
    </style>
</head>
<body>
<?php 
    $path_parts = pathinfo(__FILE__);
    $GLOBALS['page'] = $path_parts['basename'];
    include_once("header.php"); 
?>
<div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="thumbnail">
                <img class="img-responsive" src="inventory_images/<?php echo $id;?>.jpg" alt="">
                <div class="caption-full">
                    <h3 class="pull-right">Rs.<?php echo $product_price;?></h3>
                    <h3><a href="#"><?php echo$product_name ?></a>
                    </h3>
                    <p><?php echo$product_details; ?></p>
                    <form id="form1" name="form1" method="post" action="cart.php">
                        <div class="form-group">
                            <input type="hidden" name="pid" id="pid" value="<?php echo $id;?>"/>
                            <input type="submit" class="btn btn-default btn-primary" id="button" value="add to cart">
                        </div>
                    </form>

                </div>
                <div class="extra-data">
                    <p class="pull-right"><?php echo $date_added;?></p>
                    <p><?php echo $product_cat.' > '.$product_subcat;?></p>
                </div>
            </div>
            </div>

        </div>

    </div>
    <!-- /.container -->
    <?php include_once("footer.php"); ?>
</body>
</html>