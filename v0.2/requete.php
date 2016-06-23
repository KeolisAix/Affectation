<?php
require("config.php");
$dbh = pg_connect($host." ".$dbnamevehicule." ".$userpg." ".$pswpg);
    // attempt a connection
    if (!$dbh) {
        die("Error in connection: " . pg_last_error());
    }
    // execute query
    $sql = "COPY base(periode, descriptif, num_service, type_jours, lundi, mardi, mercredi, jeudi, vendredi, samedi, dimanche, num_voiture, arret_debut, heure_debut, arret_fin, heure_fin) FROM '/var/www/html/test.txt' WITH DELIMITER ';' CSV HEADER encoding 'LATIN1'";

    $result = pg_query($dbh, $sql);
    if (!$result) {
        die("There was a problem uploading you data: " . pg_last_error());
    }

    echo "Data successfully inserted!";

    // free memory
    pg_free_result($result);

    // close connection
    pg_close($dbh);

?>