<?php
require("config.php");
if(isset($_GET['chaine']) == true){
    $chaine = $_GET['chaine'];
$dbh = pg_connect($host." ".$dbnameAff." ".$userpg." ".$pswpg);
    // attempt a connection
    if (!$dbh) {
        die("Error in connection: " . pg_last_error());
    }
    // execute query
    $sql = "INSERT INTO \"historique\" (\"chaine\", \"date\") VALUES ('".$chaine."', '".date("d-m-Y H:i")."')";

    $result = pg_query($dbh, $sql);
    if (!$result) {
        die("There was a problem uploading you data: " . pg_last_error());
    }

    echo "Data successfully inserted!";

    // free memory
    pg_free_result($result);

    // close connection
    pg_close($dbh);
}


?>