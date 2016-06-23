<?php 
$pdoAffectation = new PDO("pgsql:dbname=affectation;host=127.0.0.1;user=postgres;password=postgres"); 

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
    $agents = "";
    $jourlowcase = strtolower($JourDeAffectation);
    $sql = "SELECT DISTINCT code_service,arret_debut_heure FROM \"public\".\"base\" WHERE code_tache = '".$codeTache."' AND periode = '".$periode."' AND \"" . $jourlowcase ."\" = 'O' ORDER BY arret_debut_heure ASC";    
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
            $agents = $agents.".".$row["code_service"];
    }
    return $agents;
}
function getCitaroSQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."vehicules" WHERE "TYPE" LIKE \'%CITARO%\' ORDER BY "NUM_PARC"';  
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["NUM_PARC"].'" class="redips-drag ui-widget-content bus citaro" onmouseout="testdrop(this.id)" style="width: 695px, position: relative; background-color: beige">'.$row["NUM_PARC"].'</div>';
    }
}
function getCitySQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."vehicules" WHERE "public".vehicules."TYPE" LIKE \'%CITY 21%\' OR "public".vehicules."TYPE" LIKE \'%SPRINTER%\'';  
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["NUM_PARC"].'" class="redips-drag ui-widget-content bus city" onmouseout="testdrop(this.id)" style="width: 695px, position: relative; background-color: honeydew">'.$row["NUM_PARC"].'</div>';
    }
}
function getCrosswaySQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."vehicules" WHERE "TYPE" LIKE \'%CROSSWAY%\' ORDER BY "NUM_PARC"';  
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["NUM_PARC"].'" class="redips-drag ui-widget-content bus crossway" onmouseout="testdrop(this.id)" style="width: 695px, position: relative; background-color: lavender">'.$row["NUM_PARC"].'</div>';
    }
}
function getGXSQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."vehicules" WHERE "TYPE" LIKE \'%GX%\' ORDER BY "NUM_PARC"';  
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["NUM_PARC"].'" class="redips-drag ui-widget-content bus gx" onmouseout="testdrop(this.id)" style="width: 695px, position: relative; background-color: lemonchiffon">'.$row["NUM_PARC"].'</div>';
    }
}
function getSetraSQL($pdoAffectation)
{
    $sql = 'SELECT * FROM "public"."vehicules" WHERE "TYPE" LIKE \'%415%\' ORDER BY "NUM_PARC"';  
    $req = $pdoAffectation->query($sql);
    while ($row = $req->fetch()) {
        echo '<div id="'.$row["NUM_PARC"].'" class="redips-drag ui-widget-content bus setra" onmouseout="testdrop(this.id)" style="width: 695px, position: relative; background-color: lightgrey">'.$row["NUM_PARC"].'</div>';
    }
}
function CentralPark($pdoAffectation, $v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23,$v24,$v25,$v26,$v27,$v28,$v29,$v30,$v31,$v32,$v33,$v34,$v35,$v36,$v37,$v38,$v39,$v40,$v41,$v42,$v43,$v44,$v45,$v46,$v47,$v48,$v49,$v50,$v51,$v52,$v53,$v54,$v55,$v56,$v57,$v58,$v59,$v60,$v61,$v62,$v63,$v64,$v65,$v66,$v67,$v68,$v69,$v70,$v71,$v72,$v73,$v74)
{
    $sql = "INSERT INTO vehicules VALUES ('".$v1."','".$v2."','".$v3."','".$v4."','".$v5."','".$v6."','".$v7."','".$v8."','".$v9."','".$v10."','".$v11."','".$v12."','".$v13."','".$v14."','".$v15."','".$v16."','".$v17."','".$v18."','".$v19."','".$v20."','".$v21."','".$v22."','".$v23."','".$v24."','".$v25."','".$v26."','".$v27."','".$v28."','".$v29."','".$v30."','".$v31."','".$v32."','".$v33."','".$v34."','".$v35."','".$v36."','".$v37."','".$v38."','".$v39."','".$v40."','".$v41."','".$v42."','".$v43."','".$v44."','".$v45."','".$v46."','".$v47."','".$v48."','".$v49."','".$v50."','".$v51."','".$v52."','".$v53."','".$v54."','".$v55."','".$v56."','".$v57."','".$v58."','".$v59."','".$v60."','".$v61."','".$v62."','".$v63."','".$v64."','".$v65."','".$v66."','".$v67."','".$v68."','".$v69."','".$v70."','".$v71."','".$v72."','".$v73."','".$v74."')";  
    $req = $pdoAffectation->query($sql);
}
function CentralParkPurge($pdoAffectation)
{
    $sql = "TRUNCATE vehicules";  
    $req = $pdoAffectation->query($sql);
}
?> 