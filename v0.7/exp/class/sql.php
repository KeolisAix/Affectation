<?php 
$pdoAffectation = new PDO("pgsql:dbname=affectation;host=192.168.207.22;user=postgres;password=postgres"); 
$pdoVehicule = new PDO("pgsql:dbname=vehicules;host=192.168.207.22;user=postgres;password=postgres");

function getServiceSQL($pdoAffectation, $periode, $JourDeAffectation)
{
    $jourlowcase = strtolower($JourDeAffectation);
    $sql = "SELECT DISTINCT * FROM \"public\".\"base\" WHERE periode = '".$periode."' AND \"" . $jourlowcase ."\" = 'O' ORDER BY \"public\".base.code_tache ASC, arret_debut_heure ASC";    
    $req = $pdoAffectation->query($sql);
    return $req;
}
function getServiceSQLCount($pdoAffectation, $codeTache)
{
    $agent = "";
    $sql = "SELECT count(DISTINCT code_service) FROM \"public\".\"base\" WHERE code_tache = '".$codeTache."'";    
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        $count = $row["count"];
    }

    if($count >= 3){
        $agent = getAgent($pdoAffectation, $codeTache);
    }
    return $agent;
}
function getServiceDoubleName($pdoAffectation, $codeTache, $datedebutheure)
{
    $ServiceCode = "";
    $sql = "SELECT DISTINCT * FROM \"public\".\"base\" WHERE code_tache = '".$codeTache."' AND arret_debut_heure = '".$datedebutheure."' ORDER BY \"public\".base.code_tache ASC, arret_debut_heure ASC";    
$req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        $ServiceCode = $row["code_service"];
    }
    return $ServiceCode;
}
function getAgent($pdoAffectation, $codeTache)
{
    $agents=0;
    $sql = "SELECT code_service FROM \"public\".\"base\" WHERE code_tache = '".$codeTache."'";    
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        $agents = $agents."-".$row["code_service"];
    }
    return $agents;
}
function getCitaroSQL($pdoVehicule)
{
    $sql = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'CITARO\'';  
    $req = $pdoVehicule->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(this.id)" onclick="testt(this.id)" style="width: 695px, position: relative; background-color: beige">'.$row["parc_keolis"].'</div>';
    }
}
function getCitySQL($pdoVehicule)
{
    $sql = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'CITY 21\'';  
    $req = $pdoVehicule->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$row["parc_keolis"].'\')" style="width: 695px, position: relative; background-color: honeydew">'.$row["parc_keolis"].'</div>';
    }
}
function getCrosswaySQL($pdoVehicule)
{
    $sql = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'CROSSWAY LE\'';
    $req = $pdoVehicule->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$row["parc_keolis"].'\')" style="width: 695px, position: relative; background-color: lavender">'.$row["parc_keolis"].'</div>';
    }
}
function getGXSQL($pdoVehicule)
{
    $sql = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'GX 127C\'';   
    $req = $pdoVehicule->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$row["parc_keolis"].'\')" style="width: 695px, position: relative; background-color: lemonchiffon">'.$row["parc_keolis"].'</div>';
    }
}
function getSetraSQL($pdoVehicule)
{
    $sql = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'SETRA 415 NF\'';  
    $req = $pdoVehicule->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$row["parc_keolis"].'\')" style="width: 695px, position: relative; background-color: lightgrey">'.$row["parc_keolis"].'</div>';
    }
}
?> 