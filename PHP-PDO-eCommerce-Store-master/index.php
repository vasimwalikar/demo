<?php
include "connect_to_mysql_pdo.php";
$dynamic_list = "";
if(isset($_GET["cat"])){
    $res = $dbh->prepare("SELECT * FROM products WHERE category=? LIMIT 10");
    $res->execute([$_GET["cat"]]);
}
else{
    $res = $dbh->prepare("SELECT * FROM products LIMIT 10");
    $res->execute();
}
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
        $more = "";
        if (strlen($product_details)>60) {
            $product_details = substr($product_details,60);
            $more = '...<a href="product.php?id='.$product_id.'">read more</a>';
        }
        $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        $dynamic_list .= '
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <img src="inventory_images/'.$product_id.'.jpg" alt="">
                <div class="caption">
                    <h4 class="pull-right">Rs.'.$product_price.'</h4>
                    <h4><a href="product.php?id='.$product_id.'">'.$product_name.'</a>
                    </h4>
                    <p>'.$product_details.$more.'</p>
                </div>
                <div class="extra-data">
                    <p class="pull-right">'.$date_added.'</p>
                     <p>'.$product_cat.' > '.$product_subcat.'</p>
                </div>
            </div>
        </div>';
    }
}
else {
    $dynamic_list = "We have no products listed here.";
}
$dbh = null;
?>
<!DOCTYPE html>
<htmL>
<head>
    <title>Ecommerce Store</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style type="text/css">
    body {
        margin-top: 25px;
    }
    .thumbnail img{
        width: 100%;
        height: 150px;
    }
    .extra-data {
    padding-right: 10px;
    padding-left: 10px;
    color: #d17581;
    }
    .caption {
        height:110px;
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
            <p class="lead">Categories</p>
            <div class="list-group">
                <a href="index.php" class="list-group-item">All Items</a>
                <a href="index.php?cat=Shirts" class="list-group-item">Shirts</a>
                <a href="index.php?cat=Pants" class="list-group-item">Pants</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <p><?php echo $dynamic_list; ?> </p>
            </div>
        </div>
    </div>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>