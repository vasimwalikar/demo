<?php
/*
  @author: Shahrukh Khan
  @website: http://www.thesoftwareguy.in
  @facebook fanpage: https://www.facebook.com/Thesoftwareguy7
 */
error_reporting(E_ALL & ~E_NOTICE);
@ini_set('post_max_size', '64M');
@ini_set('upload_max_filesize', '64M');

/* * *********************************************** */
// database constants
define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', 'root');
define('DB_DATABASE', 'image_test');

$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}

if (isset($_POST["sub1"]) || isset($_POST["sub2"])) {
  // include resized library
  require_once('./php-image-magician/php_image_magician.php');
  $msg = "";
  $valid_image_check = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/bmp");
  if (count($_FILES["user_files"]) > 0) {
    $folderName = "uploads/";

    $sql = "INSERT INTO tbl_images(image_name) VALUES (:img)";
    $stmt = $DB->prepare($sql);

    for ($i = 0; $i < count($_FILES["user_files"]["name"]); $i++) {

      if ($_FILES["user_files"]["name"][$i] <> "") {

        $image_mime = strtolower(image_type_to_mime_type(exif_imagetype($_FILES["user_files"]["tmp_name"][$i])));
        // if valid image type then upload
        if (in_array($image_mime, $valid_image_check)) {

          $ext = explode("/", strtolower($image_mime));
          $ext = strtolower(end($ext));
          $filename = rand(10000, 990000) . '_' . time() . '.' . $ext;
          $filepath = $folderName . $filename;

          if (!move_uploaded_file($_FILES["user_files"]["tmp_name"][$i], $filepath)) {
            $emsg .= "Failed to upload <strong>" . $_FILES["user_files"]["name"][$i] . "</strong>. <br>";
            $counter++;
          } else {
            $smsg .= "<strong>" . $_FILES["user_files"]["name"][$i] . "</strong> uploaded successfully. <br>";

            $magicianObj = new imageLib($filepath);
            $magicianObj->resizeImage(100, 100);
            $magicianObj->saveImage($folderName . 'thumb/' . $filename, 100);

            /*             * ****** insert into database starts ******** */
            try {
              $stmt->bindValue(":img", $filename);
              $stmt->execute();
              $result = $stmt->rowCount();
              if ($result > 0) {
                // file uplaoded successfully.
              } else {
                // failed to insert into database.
              }
            } catch (Exception $ex) {
              $emsg .= "<strong>" . $ex->getMessage() . "</strong>. <br>";
            }
            /*             * ****** insert into database ends ******** */
          }
        } else {
          $emsg .= "<strong>" . $_FILES["user_files"]["name"][$i] . "</strong> not a valid image. <br>";
        }
      }
    }


    $msg .= (strlen($smsg) > 0) ? successMessage($smsg) : "";
    $msg .= (strlen($emsg) > 0) ? errorMessage($emsg) : "";
  } else {
    $msg = errorMessage("You must upload atleast one file");
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="http://www.thesoftwareguy.in/favicon.ico" type="image/x-icon" />
    <!--iOS/android/handheld specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Upload multiple images create thumbnails and save path to database with php and mysql">
    <meta name="keywords" content="php, mysql, thumbnail,upload image, check mime type">
    <meta name="author" content="Shahrukh Khan">
    <title>Upload multiple images create thumbnails and save path to database with php and mysql - thesoftwareguy</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <style>
      .files{height: 30px; margin: 10px 10px 0 0;width: 250px; }
      .add{ font-size: 14px; color: #EB028F; border: none; }
      .rem a{ font-size: 14px; color: #f00; border: none; }
      .submit{width: 110px; height: 30px; background: #6D37B0; color: #fff;text-align: center;}
    </style>
    <script src="jquery-1.9.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $(".add").click(function() {
          $('<div><input class="files" name="user_files[]" type="file" ><span class="rem" ><a href="javascript:void(0);" >Remove</span></div>').appendTo(".contents");

        });
        $('.contents').on('click', '.rem', function() {
          $(this).parent("div").remove();
        });

      });
    </script>
  </head>
  <body>
    <div id="container">
      <div id="body">
        <div class="mainTitle" >Upload multiple images create thumbnails and save path to database with php and mysql</div>
        <div class="height20"></div>
        <article>
          <?php echo $msg; ?>
          <div class="height20"></div>
          <div style="width: 380px; margin: 0 auto;">
            <h3 style="text-align: center;">Image will be resized to 100px X 100px </h3>
            <form name="f1" action="index.php" method="post" enctype="multipart/form-data">            
              <fieldset>
                <legend>Demo1</legend>
                Attach multiple Files:
                <input class="files" name="user_files[]" type="file" multiple="multiple" >
                <div class="height10"></div>
                <div><input type="submit" class="submit" name="sub1" value="Upload Images" /> </div>
              </fieldset> 
            </form>
            <div style="width: 380px; margin: 0 auto;">
              <form name="f2" action="index.php" method="post" enctype="multipart/form-data">
                <fieldset>
                  <legend>Demo2</legend>

                  <input class="files" name="user_files[]" type="file" ><span><a href="javascript:void(0);" class="add" >Add More</a></span>
                  <div class="contents"></div>
                  <div class="height10"></div>
                  <div><input type="submit" class="submit" name="sub2" value="Upload Images" /> </div>
                </fieldset>
              </form>
            </div>
          </div>
          <div class="height10"></div>
          <?php
          // fetch all records
          $sql = "SELECT * FROM tbl_images WHERE 1 ";
          try {
            $stmt = $DB->prepare($sql);
            $stmt->execute();
            $images = $stmt->fetchAll();
          } catch (Exception $ex) {
            echo $ex->getMessage();
          }
          ?>
          <table class="bordered">
            <tr><th>ID</th><th>thumbnail</th><th>ORIGINAL</th></tr>
            <?php
            if (count($images) > 0) {
              foreach ($images as $img) {
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo $img["id"]; ?></td>
                  <td style="text-align: center;">
                    <a href="uploads/thumb/<?php echo $img["image_name"]; ?>" target="_blank">
                      <img src="uploads/thumb/<?php echo $img["image_name"]; ?>" alt="<?php echo $img["image_name"]; ?>">
                    </a>
                  </td>
                  <td style="text-align: center;">
                    <a href="uploads/<?php echo $img["image_name"]; ?>" target="_blank">
                      <img src="uploads/<?php echo $img["image_name"]; ?>" alt="<?php echo $img["image_name"]; ?>" width="300" height="300">
                    </a>
                  </td>
                </tr>  
                <?php
              }
            } else {
              ?>
			   <tr>
              <td colspan="3">No images in the database.</td>
            </tr> 
            <?php } ?>
          </table>
          <div class="height10"></div>
        </article>
        <div class="height10"></div>
        <footer>
          <div class="copyright"> &copy; 2013 <a href="http://www.thesoftwareguy.in" target="_blank">thesoftwareguy</a>. All rights reserved </div>
          <div class="footerlogo"><a href="http://www.thesoftwareguy.in" target="_blank"><img src="http://www.thesoftwareguy.in/thesoftwareguy-logo-small.png" width="200" height="47" alt="thesoftwareguy logo" /></a> </div>
        </footer>
      </div>
    </div>

  </body>
</html>
<?php

function errorMessage($str) {
  return '<div style="width:50%; margin:0 auto; border:2px solid #F00;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
}

function successMessage($str) {
  return '<div style="width:50%; margin:0 auto; border:2px solid #06C;padding:2px; color:#000; margin-top:10px; text-align:center;">' . $str . '</div>';
}
?>