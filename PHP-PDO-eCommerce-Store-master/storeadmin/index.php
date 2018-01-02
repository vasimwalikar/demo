<?php

// start the session
session_start();
// make sure the user is logged in (if the session variable "manager" is set or not)
if (!isset($_SESSION["manager"])) {
	//otherwise send to the login page
	header("location: admin_login.php");
	// prevent resof of the page from running if user is not logged in
	exit();
}
//-----------------------------------------------------------


// get value from session variables and assign them to to local variables
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter non-numbers for security preg_replace(RegEx pattern, replacement , data )
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter non-numbers and non-letters for security
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]);
echo "managerID [". $managerID . "] manager: [". $manager . "] password: [". $password."]<br>";

// connect to MySQL Database
include "../connect_to_mysql_pdo.php";

//$res= $dbh->prepare("SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1");
$res= $dbh->prepare("SELECT * FROM admin WHERE id=? AND username=? AND password=? LIMIT 1");
$res->execute([$managerID,$manager,$password]);
$existCount = $res->rowCount();  //count the number of rows, same as mysql mysql_num_rows($sqlquery);
if($existCount==0){
	echo "Your login session data is not on record in the database. Please log in again here:<a href='admin_login.php'>Admin Login</a><br>"; //echo this if someone tries to forge session cookies
	echo " existCount is: [".$existCount."] and type is: ". gettype($existCount) . "<br>"; 
	echo '<pre>';
	var_dump($_SESSION);
	echo '</pre>';
	//echo "managerID [". $managerID . "] manager: [". $manager . "] password: [". $password."]";
	exit(); // prevent resof of the page from running if user is not logged in
}

?>
<!DOCTYPE html>
<htmL>
<head>
    <title>Admin Page (index)</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<?php 
	$path_parts = pathinfo(__FILE__);
	$GLOBALS['page'] = $path_parts['basename'];
	include_once("admin_header.php");
?>
<div class="container">
	<h1>Admin Area</h1>
	<div class="list-group">
	<a class="list-group-item"href="inventory_list.php">Manage Inventory</a>
	</div>
</div>
</body>
</htmL>