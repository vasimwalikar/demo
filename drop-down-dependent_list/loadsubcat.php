<?php 
include('config.php');

$parent_cat = $_GET['parent_cat'];

$sub_cat = $_GET['sub_cat'];

$query = mysql_query("SELECT * FROM subcategory WHERE cat_id = {$parent_cat}");
while($row = mysql_fetch_array($query)) {
	echo "<option value='$row[subcat_id]'>$row[subcategory]</option>";
}

$query = mysql_query("SELECT * FROM subcategory2 WHERE subcat_id = {$sub_cat}");
while($row = mysql_fetch_array($query)) {
	echo "<option value='$row[subcat2_id]'>$row[subcat2]</option>";
}

?>