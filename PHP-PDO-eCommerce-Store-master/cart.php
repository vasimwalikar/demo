<?php
session_start();
include "connect_to_mysql_pdo.php";
include "functions.php";
setlocale(LC_MONETARY, "en_US"); //is this really useful?
///////////////////////////////////////////////////////////////////////////////////
//                          Add items to shopping cart
///////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['pid'])){
    $pid=$_POST['pid'];
    $wasFound=false;
    $i=0;
    // if cart session variable is not set or cart array is empty
    if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1 ){
        $_SESSION["cart_array"] = array(0=> array("item_id"=> $pid,"quantity"=>1));
    }
    else{
        foreach ($_SESSION["cart_array"] as $each_item){
            $i++;
            while(list($key,$value)=each($each_item)){
                if($key=="item_id" && $value==$pid){
                    // since item is in cart already, increase quantity
                    array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id"=>$pid,"quantity"=>$each_item['quantity']+1)));
                    $wasFound = true;
                }// close if condition
            }// close while loop
        }// close foreach loop
        if($wasFound == false){
            array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" =>1));
        } 
    }
    header("Location:cart.php");
}

///////////////////////////////////////////////////////////////////////////////////
//                          Empty the shopping cart
///////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['cmd']) && $_GET['cmd']=="emptycart"){
    unset($_SESSION["cart_array"]);
}

///////////////////////////////////////////////////////////////////////////////////
//                          Increase/Decrease the item quantity
///////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['item_to_inc']) && $_POST['item_to_inc']!=""){
    $item_to_inc = $_POST['item_to_inc'];
    $i=0;
    foreach ($_SESSION["cart_array"] as $each_item){
            $i++;
            while(list($key,$value)=each($each_item)){
                if($key=="item_id" && $value==$item_to_inc){
                    // since item is in cart already, increase quantity
                    array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id"=>$item_to_inc,"quantity"=>$each_item['quantity']+1)));
                    $wasFound = true;
                }// close if condition
            }// close while loop
        }// close foreach loop
}
if(isset($_POST['item_to_dec']) && $_POST['item_to_dec']!="" && $_POST['quant_val']>1){
    $item_to_dec = $_POST['item_to_dec'];
    $i=0;

    foreach ($_SESSION["cart_array"] as $each_item){
            $i++;
            while(list($key,$value)=each($each_item)){
                if($key=="item_id" && $value==$item_to_dec){
                    // since item is in cart already, increase quantity
                    array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id"=>$item_to_dec,"quantity"=>$each_item['quantity']-1)));
                    $wasFound = true;
                }// close if condition
            }// close while loop
        }// close foreach loop
}
///////////////////////////////////////////////////////////////////////////////////
//                          Remove item from the shopping cart
///////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["index_to_remove"]) && $_POST["index_to_remove"]!="" ){
    $key_to_remove = $_POST["index_to_remove"];
    if (count($_SESSION["cart_array"]) <= 1) {
        unset($_SESSION{"cart_array"}); // unset shopping cart if no items remain
    }
    else {
        unset($_SESSION["cart_array"]["$key_to_remove"]); // remove specefic item
        sort($_SESSION["cart_array"]); // sort cart so that the first index is 0
    }
}

///////////////////////////////////////////////////////////////////////////////////
//                          Display the shopping cart
///////////////////////////////////////////////////////////////////////////////////
$cartOutput = "";
$cart_total="";
if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1 ){
    $cartOutput= '<h3>Your Cart is empty</h3>';
}
else{
    $i=0;
    foreach($_SESSION["cart_array"] as $each_item) {
        $item_id = $each_item['item_id'];
        $res = $dbh->prepare("SELECT * FROM products WHERE id=?LIMIT 1");
        $res->execute([$item_id]);
        while ($row = $res->fetch()) {
            $product_name = $row['product_name'];
            $product_price = $row['price'];
        }
        $res->execute();
        $quant = $each_item['quantity'];
        $item_total = $product_price*$each_item['quantity'];
        $cart_total = $item_total+$cart_total;

        $cartOutput .= '
                    <tr>
                        <td><img src="inventory_images/'.$each_item['item_id'].'.jpg" alt="A plain and simple '.$product_name.'." title="A '.$product_name.'."/></td>
        ';
        $cartOutput .= '                <td>
                            <div>
                                <p><a href="product.php?id=' . $each_item['item_id'] . '">' . ucwords($product_name) . '</a> (Product ID:' . $each_item['item_id'] . ')</p><span class="price">' . money_format('%.2n', $product_price) . '</span>
                            </div>
                        </td>
        ';
        $cartOutput .= '                <td><form action="cart.php" method="post" class="pull-left">
                                <button name="incBtn'.$item_id.'" type="submit" value="increase">
                                <input type="hidden" name="item_to_inc" value="'.$item_id.'"/>+
                                </button>
                            </form>' . $each_item['quantity'] . '
                            <form action="cart.php" method="post" class="pull-right">
                                <button name="decBtn'.$item_id.'" type="submit" value="decrease">
                                <input type="hidden" name="quant_val" value="'.$each_item['quantity'].'"/>
                                <input type="hidden" name="item_to_dec" value="'.$item_id.'"/>-
                                </button>
                            </form>
                        </td>
        ';
        $cartOutput .= '                <td class="price">  ' .  money_format('%.2n', $item_total) . '
                            <form action="cart.php" method="post" class="pull-right">
                                <button name="deleteBtn'.$item_id.'" type="submit">
                                <input type="hidden" name="index_to_remove" value="'.$i.'"/>
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true">
                                </button>
                            </form>
                        </td>
                    </tr>
'; // name="deleteBtn"'.$item_id.'"; because we don't want duplicates
        $i++;
    }// close foreach loop
}// close else block
?>
<!DOCTYPE html>
<htmL>
<head>
    <title>My Cart - Ecommerce Store</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style type="text/css">
        body{
            margin-top: 25px;
        }
        td img{
            width: 100px;
        }
        .price{
            font-weight: bold;
            text-align: right;
        }
        .table>tbody>tr>td {
            border-top: none;
            border-bottom: 1px solid #ddd;
        }

        tr td:nth-child(2){
            width:100%;
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
        <div class="col-sm-8 col-md-9">
            <table class="table table-hover">
                <thead>
                    <tr class="info"><th>No.</th><th>Name</th><th>QNT</th><th style="text-align:right;">Total</th></tr>
                </thead>
                <tbody><?php echo $cartOutput; ?>
                    <tr>
                    <td colspan="2"></td>
                    <td class="price">Total:</td><td class="price"><?php echo money_format('%.2n', $cart_total); ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="cart.php?cmd=emptycart">Click Here to Empty your Cart</a>
        </div>
        <div class="col-sm-4 col-md-3">
            <button class="btn btn-primary" style="width:100%;margin-bottom:10px;padding:9px;">Check Out</button>
            <div class="well well-lg">
                <table class="table" style="border-top:0px;">
                    <tr><td>SUBTOTAL:<span class="pull-right price"><?php echo money_format('%.2n', $cart_total); ?></span></td></tr>
                    <tr><td>SHIPPING:<span class="pull-right">Free Shipping!</span></td></tr>
                    <tr><td>TAX:<span class="pull-right">Not Applicable</span></td></tr>
                    <tr class="info"><td>TOTAL:<span class="pull-right price"><?php echo money_format('%.2n', $cart_total); ?></span></td></tr>
                </table>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Coupon Code">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button">Apply</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

</div><!-- /.container -->
    <?php include_once("footer.php"); ?>
</body>
</html>