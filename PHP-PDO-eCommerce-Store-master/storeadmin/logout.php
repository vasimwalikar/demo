<?php
session_start();
//$_SESSION = array();
unset ($_SESSION["id"]);
unset ($_SESSION["manager"]);
unset ($_SESSION["password"]);
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
session_destroy();
header("location: admin_login.php");
exit();
?>