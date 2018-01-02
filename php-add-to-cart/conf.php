<?php 
session_start();
$conn  = @mysql_connect("localhost","root","root");
mysql_select_db("phpcooker_script",$conn);

?>