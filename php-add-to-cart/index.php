<?php include"conf.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>add to cart in php using session and jquery </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

 


<div class="container-fluid">
  <div class="row">
 
  <div class="col-sm-12" ><>
  <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Add To Cart Example</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
      <ul class="nav navbar-nav navbar-right" style="margin-right:5%;" >
        <li class="dropdown cart_data"  >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <img src="cart.png" style="width:40px" > 0 - Items<span class="caret"></span></a>
      
      
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  </div>
   </div>
 
 <div class="row content" style="padding-top:2%;" >  
   <!-- <div class="col-sm-3 sidenav">
      
    </div>-->

    <div class="col-sm-12">
    
    
    
      <h2>add to cart in php using session and jquery</h2>
      <hr/>
      
      <div class="container">
    <div class="row">
    
    <?php
    $query = "select * from product";
    $rs = mysql_query($query,$conn) or die("failed".mysql_error());
    while($data = mysql_fetch_assoc($rs)){
    ?>
        <div class="col-md-3">
              <div class="thumbnail">
                <img src="images/<?php echo $data['product_image']; ?>" alt="" class="img-responsive">
                <div class="caption">
                  <h4 class="pull-right"><?php echo $data['product_price']; ?></h4>
                  <h4><a href="#">Vagitable</a></h4>
                  <p><?php echo $data['product_desc']; ?></p>
                </div>
                <div class="ratings" style="text-align:center;" >
                  Quantity:  <input type="number" class="quantity<?php echo $data['product_id']; ?>" min="1"  style="max-width:50px;" value="1" >
                </div>
                <br />
                <div class="space-ten"></div>
                <div class="btn-ground text-center">
                    
                    <button type="button" class="btn btn-primary" onclick="add_cart('<?php echo $data['product_id']; ?>')" ><i class="fa fa-shopping-cart"></i> Add To Cart</button>
                   
                </div>
                <div class="space-ten"></div>
              </div>
            </div>
    <?php } ?>
            
            
                       
    </div>
</div>

      
      
    </div>
  </div>
</div>

<script>

function add_cart(p_id=""){
    var quantity = $(".quantity"+p_id).val();
    $.ajax({
        type:"post",
        url:"ajax_cart.php",
        data:{action:'add',p_id:p_id,quantity:quantity},
        success:function(result){
            $('.cart_data').html(result);
        }
    });
}


add_cart();


function remove_cart(p_id){
    //alert(p_id);
    $.ajax({
        type:"post",
        url:"ajax_cart.php",
        data:{action:'delete',p_id:p_id},
        success:function(result){
            $('.cart_data').html(result);
        }
    });
}

function empty_cart(){
    $.ajax({
        type:"post",
        url:"ajax_cart.php",
        data:{action:'empty'},
        success:function(result){
            $('.cart_data').html(result);
        }
    });
}

</script>

 

</body>
</html>