<?php
try {
    $host = 'localhost';
    $dbnm = 'cart';
    $user = 'root';
    $pass = 'root';
    $dbh = new PDO('mysql:host='.$host.';dbname='.$dbnm, $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>