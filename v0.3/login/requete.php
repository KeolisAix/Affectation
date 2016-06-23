<?php
require("../config.php");
if(isset($_GET['date']) == true){
    $ladate = $_GET['date'];
$dbh = pg_connect($host." ".$dbnameAff." ".$userpg." ".$pswpg);
    // attempt a connection
    if (!$dbh) {
        die("Error in connection: " . pg_last_error());
    }
    // execute query
    $sql = "SELECT * FROM \"public\".\"historique\"";
    $result = pg_query($dbh, $sql);
    while($row = pg_fetch_array($result)) {
        //echo "Chaine: " . $row["chaine"]. " - Date: " . $row["date"]. "<br>";
        echo "<option value=" . $row["chaine"]. ">" . $row["date"]. "</option>";
    }

    // free memory
    pg_free_result($result);

    // close connection
    pg_close($dbh);
    
}


?>