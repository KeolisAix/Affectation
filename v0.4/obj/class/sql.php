<?php 
$pdoAffectation = new PDO("pgsql:dbname=affectation;host=192.168.207.22;user=postgres;password=postgres"); 
$pdoVehicule = new PDO("pgsql:dbname=vehicules;host=192.168.207.22;user=postgres;password=postgres");

function getServiceSQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."v_voiture" ORDER BY num_agent ASC, "min" ASC LIMIT 300';    
    $req = $pdoAffectation->query($sql);
    return $req;
}
function getCitaroSQL($pdoVehicule)
{
    $sql = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'CITARO\'';  
    $req = $pdoVehicule->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$row["parc_keolis"].'\')" style="width: 695px, position: relative">'.$row["parc_keolis"].'</div>';
    }
}
function getCitySQL($pdoVehicule)
{
    $sql = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'CITY 21\'';  
    $req = $pdoVehicule->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$row["parc_keolis"].'\')" style="width: 695px, position: relative">'.$row["parc_keolis"].'</div>';
    }
}
function getCrosswaySQL($pdoVehicule)
{
    $sql = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'CROSSWAY LE\'';
    $req = $pdoVehicule->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$row["parc_keolis"].'\')" style="width: 695px, position: relative">'.$row["parc_keolis"].'</div>';
    }
}
function getGXSQL($pdoVehicule)
{
    $sql = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'GX 127C\'';   
    $req = $pdoVehicule->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$row["parc_keolis"].'\')" style="width: 695px, position: relative">'.$row["parc_keolis"].'</div>';
    }
}
function getSetraSQL($pdoVehicule)
{
    $sql = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'SETRA 415 NF\'';  
    $req = $pdoVehicule->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$row["parc_keolis"].'\')" style="width: 695px, position: relative">'.$row["parc_keolis"].'</div>';
    }
}
?> 