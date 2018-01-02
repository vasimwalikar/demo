<?php
include"conf.php";
$action = $_REQUEST['action'];
@$p_id   = trim($_REQUEST['p_id']);
//$_SESSION['product_cart'] = array();
if($action == 'add'){
     @$quantity = $_REQUEST['quantity'];
     if(!empty($p_id)){
         $query = "select * from product where product_id = '".$p_id."'";
         $rs = mysql_query($query,$conn) or die("failed".mysql_error());
         $product_data = mysql_fetch_assoc($rs);
        
         $product = array("p_id"=>$product_data['product_id'],"title"=>$product_data['product_title'],"price"=>$product_data['product_price']*$quantity,"image"=>$product_data['product_image'],"quantity"=>$quantity);
        
        if(isset($_SESSION['product_cart']) && !empty($_SESSION['product_cart']))
        {
            if(!array_key_exists($product_data['product_id'],$_SESSION['product_cart']))
            {
           
                $_SESSION['product_cart'][$product_data['product_id']] = $product;
           
            }
            else{
                
                $_SESSION['product_cart'][$product_data['product_id']]['price'] = $_SESSION['product_cart'][$product_data['product_id']]['price'] + ($product_data['product_price']*$quantity);
                $_SESSION['product_cart'][$product_data['product_id']]['quantity'] = $_SESSION['product_cart'][$product_data['product_id']]['quantity']+$quantity;
            }        
        }
        else{
          $_SESSION['product_cart'][$product_data['product_id']] = $product;
        }
    }    
}
if($action == "delete"){
    unset($_SESSION['product_cart'][$p_id]);
}

if($action == "empty"){
    session_destroy();
}
?>

<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <img src="cart.png" style="width:40px" > <?php echo count(@$_SESSION['product_cart']); ?> - Items<span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-cart" role="menu">
          <?php
          if(isset($_SESSION['product_cart'])){
          foreach($_SESSION['product_cart'] as $data){
          ?>
              <li>
                  <span class="item">
                    <span class="item-left" style="color:#0000" >
                        <img src="images/<?php echo $data['image']; ?>" alt="" style="width:60px;" />
                        <span class="item-info" style="color:#000;" >
                            <span><?php echo $data['title']; ?></span>
                            <span>Quantity : <?php echo $data['quantity']; ?></span>
                            <span>Price : <?php echo $data['price']; ?> INR</span>
                        </span>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right" onclick="remove_cart('<?php echo $data['p_id']; ?>')" >x</button>
                    </span>
                </span>
              </li>
          <?php }  } ?>
              <li class="divider"></li>
              <li><a class="text-center" href="">View Cart</a></li>
              <li><a class="text-center" href="#" onclick="empty_cart();" >Empty Cart</a></li>