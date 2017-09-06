<?php 
include('config.php'); 
$query_parent = mysql_query("SELECT * FROM category") or die("Query failed: ".mysql_error());
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dependent DropDown List</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    
	$("#parent_cat").change(function() {
		$(this).after('<div id="loader"><img src="img/loading.gif" alt="loading subcategory" /></div>');
		$.get('loadsubcat.php?parent_cat=' + $(this).val(), function(data) {
			$("#sub_cat").html(data);
			// alert(data);
			$('#loader').slideUp(200, function() {
				$(this).remove();
			});
		});	
    });

    $("#sub_cat").change(function() {
		$(this).after('<div id="loader"><img src="img/loading.gif" alt="loading subcategory" /></div>');
		$.get('loadsubcat.php?sub_cat=' + $(this).val(), function(data) {
			$("#sub_cat2").html(data);
			// alert(data);
			$('#loader').slideUp(200, function() {
				$(this).remove();
			});
		});	
    });

});
</script>
</head>

<body>
<form method="get">
	<label for="category">Parent Category</label>
    <select name="parent_cat" id="parent_cat">
        <?php while($row = mysql_fetch_array($query_parent)): ?>
        <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['category']; ?></option>
        <?php endwhile; ?>
    </select>
    <br/><br/>
  
    <label>Sub Category</label>
    <select name="sub_cat" id="sub_cat"></select>

    <br/><br/>
  
    <label>Sub Category2</label>
    <select name="sub_cat2" id="sub_cat2"></select>
</form>
</body>
</html>
