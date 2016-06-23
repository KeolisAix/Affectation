<?php
require("../obj/class/sql.php");
if(isset($_GET['chaine']) == true){
    $chaine = $_GET['chaine'];
$dbh = $pdoAffectation;
    // attempt a connection
    if (!$dbh) {
        die("Error in connection: " . pg_last_error());
    }
    // execute query
    $pdoAffectation->query("INSERT INTO \"historique\" (\"chaine\", \"date\") VALUES ('".$chaine."', '".date("d-m-Y H:i")."')");

    echo "Data successfully inserted!"; 
}
?>