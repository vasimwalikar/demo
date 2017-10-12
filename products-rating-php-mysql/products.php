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
<!-- include this file everytime you want to use rating plugin -->
<script src="raty/jquery.raty.js" type="text/javascript"></script>

<div class="row">
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h3 class="panel-title">Welcome <?php echo $USER_NAME; ?>!</h3>
    </div>
    <div class="panel-body">
      <p>MAKE SURE YOU HAVE AN ACTIVE <strong>USER ID</strong> AND <strong>PRODUCT ID</strong> TO GET ACCURATE RESULTS.</p>
    </div>
  </div>


  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Product Details</h3>
    </div>
    <div class="panel-body">

      <?php
      // fetch product details
      $sql = "SELECT `product_id`, `product_name`, `product_price` FROM `tbl_products` WHERE 1 AND product_id = :pid";
      try {

        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":pid", intval($_GET["pid"]));
        $stmt->execute();
        // fetching products details
        $products = $stmt->fetchAll();
      } catch (Exception $ex) {
        echo $ex->getMessage();
      }

      // fetching ratings for specific product
      $ratings_sql = "SELECT count(*) as count, AVG(ratings_score) as score FROM `tbl_products_ratings` WHERE 1 AND product_id = :pid";
      $stmt2 = $DB->prepare($ratings_sql);

      try {
        $stmt2->bindValue(":pid", $_GET["pid"]);
        $stmt2->execute();
        $product_rating = $stmt2->fetchAll();
      } catch (Exception $ex) {
        // you can turn it off in production mode.
        echo $ex->getMessage();
      }

      if (isset($USER_ID)) {
        // check if user has rated this product or not
        $user_rating_sql = "SELECT count(*) as count FROM `tbl_products_ratings` WHERE 1 AND product_id = :pid AND user_id= :uid";
        $stmt3 = $DB->prepare($user_rating_sql);

        try {
          $stmt3->bindValue(":pid", $_GET["pid"]);
          $stmt3->bindValue(":uid", $USER_ID);
          $stmt3->execute();
          $user_product_rating = $stmt3->fetchAll();
        } catch (Exception $ex) {
          // you can turn it off in production mode.
          echo $ex->getMessage();
        }
      }
      ?>

      <div class="col-sm-12">
        <div class="row">

          <?php
          if (count($products) > 0) {
            ?>
            <div class="col-sm-4">
              <a href="products.php?pid=<?php echo $products[0]["product_id"] ?>">
                <img src="images/2.png" class="img-thumbnail" width="500px" height="500px">
              </a>
            </div>
            <div class="col-sm-8">
              <div class="padding10 ntp">
                <h3 class="ntm"><?php echo $products[0]["product_name"] ?></h3>
                <h3>&dollar;<?php echo $products[0]["product_price"] ?></h3>

                <div id="avg_ratings">
                  <?php
                  // display the ratings for this product
                  if ($product_rating[0]["count"] > 0) {
                    echo "Average rating <strong>" . round($product_rating[0]["score"], 2) . "</strong> based on <strong>" . $product_rating[0]["count"] . "</strong> users";
                  } else {
                    echo 'No ratings for this product';
                  }
                  ?>
                </div>

                <?php
                // if user has not rated this product then show the ratings button
                if ($user_product_rating[0]["count"] == 0) {
                  ?>  
                  <div class=" padding10 clearfix"></div>
                  <div id="rating_zone">

                    <div class="pull-left">
                      <!-- ratings will display here, make sure u bind #prd in the javascrript below -->
                      <div id="prd"></div>
                    </div>
                    <div class="pull-left">
                      <button class="btn btn-primary btn-sm" id="submit" type="button">submit</button>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <?php
                } else {
                  echo '<div class="padding20 nlp"><p><strike>You have already rated this product</strike></p></div>';
                }
                ?>
                <div class="padding10 clearfix"></div>
                <a class="btn btn-info" href="index.php"><span class="glyphicon glyphicon-chevron-left"></span> back to listing</a>
              </div>
            </div>
          <?php } else { ?>
            <div class="col-sm-12">
              <div class="padding20 nlp"><p><strike>No products found</strike></p></div>
            </div>
          <?php } ?>

        </div>

      </div>

    </div>
  </div>
</div>

<script>
  $(function() {
    $('#prd').raty({
      number: 5, starOff: 'raty/img/star-off-big.png', starOn: 'raty/img/star-on-big.png', width: 180, scoreName: "score",
    });
  });
</script>

<script>
  $(document).on('click', '#submit', function() {
<?php
if (!isset($USER_ID)) {
  ?>
      alert("You need to have a account to rate this product?");
      return false;
<?php } else { ?>

      var score = $("#score").val();
      if (score.length > 0) {
        $("#rating_zone").html('processing...');
        $.post("update_ratings.php", {
          pid: "<?php echo $_GET["pid"]; ?>",
          uid: "<?php echo $USER_ID; ?>",
          score: score
        }, function(data) {
          if (!data.error) {
            // success message
            $("#avg_ratings").html(data.updated_rating);
            $("#rating_zone").html(data.message).show();
          } else {
            // failure message
            $("#rating_zone").html(data.message).show();
          }
        }, 'json'
                );
      } else {
        alert("select the ratings.");
      }

<?php } ?>
  });
</script>
<?php
include './footer.php';
?>