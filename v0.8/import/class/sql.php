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
function getServiceSQLCount($pdoAffectation, $codeTache,$periode, $JourDeAffectation)
{
    $agent = "";
    $jourlowcase = strtolower($JourDeAffectation);
    $sql = "SELECT count(DISTINCT code_service) FROM \"public\".\"base\" WHERE code_tache = '".$codeTache."' AND periode = '".$periode."' AND \"" . $jourlowcase ."\" = 'O'";    
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        $count = $row["count"];
    }
    if($count >= 3){
        $agent = getAgent($pdoAffectation, $codeTache,$periode, $JourDeAffectation);
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
function getAgent($pdoAffectation, $codeTache, $periode, $JourDeAffectation)
{
    $agents=0;
    $jourlowcase = strtolower($JourDeAffectation);
    $sql = "SELECT DISTINCT code_service,type_tache FROM \"public\".\"base\" WHERE code_tache = '".$codeTache."' AND periode = '".$periode."' AND \"" . $jourlowcase ."\" = 'O' ORDER BY type_tache ASC";    
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        if ($agents == 0){
            $agents = $row["code_service"];
        }else{
            $agents = $agents."-".$row["code_service"];
        }
    }
    return $agents;
}
function getCitaroSQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."vehicules" WHERE "TYPE" LIKE \'%CITARO%\' ORDER BY "NUM_PARC"';  
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["NUM_PARC"].'" class="redips-drag ui-widget-content bus" onmouseout="testdrop(this.id)" onclick="testt(this.id)" style="width: 695px, position: relative; background-color: beige">'.$row["NUM_PARC"].'</div>';
    }
}
function getCitySQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."vehicules" WHERE "public".vehicules."TYPE" LIKE \'%CITY 21%\' OR "public".vehicules."TYPE" LIKE \'%SPRINTER%\'';  
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["NUM_PARC"].'" class="redips-drag ui-widget-content bus" onmouseout="testdrop(this.id)" style="width: 695px, position: relative; background-color: honeydew">'.$row["NUM_PARC"].'</div>';
    }
}
function getCrosswaySQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."vehicules" WHERE "TYPE" LIKE \'%CROSSWAY%\' ORDER BY "NUM_PARC"';  
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["NUM_PARC"].'" class="redips-drag ui-widget-content bus" onmouseout="testdrop(this.id)" style="width: 695px, position: relative; background-color: lavender">'.$row["NUM_PARC"].'</div>';
    }
}
function getGXSQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."vehicules" WHERE "TYPE" LIKE \'%GX%\' ORDER BY "NUM_PARC"';  
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["NUM_PARC"].'" class="redips-drag ui-widget-content bus" onmouseout="testdrop(this.id)" style="width: 695px, position: relative; background-color: lemonchiffon">'.$row["NUM_PARC"].'</div>';
    }
}
function getSetraSQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."vehicules" WHERE "TYPE" LIKE \'%415%\' ORDER BY "NUM_PARC"';  
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["NUM_PARC"].'" class="redips-drag ui-widget-content bus" onmouseout="testdrop(this.id)" style="width: 695px, position: relative; background-color: lightgrey">'.$row["NUM_PARC"].'</div>';
    }
}
?> 