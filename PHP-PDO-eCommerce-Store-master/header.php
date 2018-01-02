<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Store</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="<?php echo ($page == "index.php" ? "active" : "");?>"><a href="index.php">Home</a></li>
                <li class="<?php echo ($page == "cart.php" ? "active" : "");?>"><a href="cart.php"><span style="padding-right:5px;" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> My Cart</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>
<div class="container head">
    <div class="row">
        <div class="col-md-12 page-header">
            <h1><?php if($page == "cart.php"){echo "Your Shopping Cart";}else{echo"eCommerce Store";}?></h1>
        </div>
    </div>
</div>
