<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebbok https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */
require_once './config.php';
include './header.php';
?>
<div class="row">

  <div class="panel panel-primary">
    <div class="panel-heading">
      <!-- you can place username/userid based on the database. -->
      <h3 class="panel-title">Welcome <?php echo $USER_NAME; ?>!</h3>
    </div>
    <div class="panel-body">
      <p>To rate a product you must use an user account which eliminates spamming. You need to create a separate user section(which is not covered in this tutorial).  
      <p>User login Is not covered in this system so I have hard codedly set <strong>USER ID</strong> and <strong>USER NAME</strong> in config.php.</p>
      <p class="label-danger" style="color: #000;"> ALWAYS MAKE SURE YOU HAVE AN ACTIVE <strong>USER ID</strong> TO GET ACCURATE RESULTS. <strong>USER ID</strong> MUST BE PRESENT IN DATABASE TOO</p>
      <p>Click on the product image and go to its details page. where you can give ratings for the products. User can rate a product only once. </p>
      <p>I have altered one code in the plugin <strong>jquery.raty.js</strong> in line no 214 <br></p>
      <p><strong>Previously</strong></p>
      <p class="label-warning" style="color: #000;"><?php echo htmlentities("_createScore: function() { return $('<input />', { type: 'hidden', name: this.opt.scoreName }).appendTo(this); }"); ?></p>
      <p><strong>Changed Code</strong></p>
      <p class="label-info" style="color: #000;"><?php echo htmlentities("_createScore: function() { return $('<input />', { type: 'hidden', name: this.opt.scoreName, id: this.opt.scoreName }).appendTo(this); }"); ?></p>
      <p>So if you used the library directly from <a href="http://wbotelhos.com/raty"> jquery raty website</a>, make sure you change the code first for proper functioning of this script. </p>      
      <p><strong>coding is fun :)</strong></p>
    </div>
  </div>


  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Our Best Selling Products</h3>
    </div>
    <div class="panel-body">

      <?php
      $sql = "SELECT `product_id`, `product_name`, `product_price` FROM `tbl_products` WHERE 1";
      try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
      } catch (Exception $ex) {
        echo $ex->getMessage();
      }

      // fetching ratings for specific product
      $ratings_sql = "SELECT count(*) as count, AVG(ratings_score) as score FROM `tbl_products_ratings` WHERE 1 AND product_id = :pid";
      $stmt2 = $DB->prepare($ratings_sql);

      for ($i = 0; $i < count($products); $i++) {

        try {
          $stmt2->bindValue(":pid", $products[$i]["product_id"]);
          $stmt2->execute();
          $product_rating = $stmt2->fetchAll();
        } catch (Exception $ex) {
          // you can turn it off in production mode.
          echo $ex->getMessage();
        }
        ?>
        <div class="col-sm-3 adjustdiv">
          <a href="products.php?pid=<?php echo $products[$i]["product_id"] ?>">
            <img src="images/1.png" class="img-thumbnail" width="200px" height="200px">
          </a>
          <div class="textContainer caption" >
            <div class="row">
              <div class="col-lg-12 prdname"><?php echo $products[$i]["product_name"] ?><span style="color: #000;"> - </span><span class="prdprice">&dollar;<?php echo $products[$i]["product_price"] ?></span></div>
            </div>
            <div class="row padding5 nlp nrp">
              <div class="col-lg-12">
                <?php
                if ($product_rating[0]["count"] > 0) {
                  echo "Average rating <strong>" . round($product_rating[0]["score"], 2) . "</strong> based on <strong>" . $product_rating[0]["count"] . "</strong> users";
                } else {
                  echo 'No ratings for this product';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>     

    </div>
  </div>


</div>
<?php
include './footer.php';
?>