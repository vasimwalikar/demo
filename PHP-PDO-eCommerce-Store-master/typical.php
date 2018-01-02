<?php
    // use this var_umb to get a list of PDO database drivers as an array object
    //var_dump(PDO::getAvailableDrivers());

    require "connect_to_mysql_pdo.php";
    /*** The SQL SELECT statement ***/
    $sql = "SELECT * FROM animals";
    echo '<table class="table table-striped table-bordered"><thead></thead><tr><th>Type</th><th>Name</th></tr><tbody>';
    foreach ($dbh->query($sql) as $row)
    {
        print '<tr><td>' . $row['animal_type'] .'</td> - <td>'. $row['animal_name'] . '</td></tr>';
    }
    echo '</tbody></table>';
    /*** close the database connection ***/
    $dbh = null;
?>