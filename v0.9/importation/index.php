<?php
Require_Once("../config/class/voiture.php");
Require_Once("../config/class/sql.php");
Require_Once("../config/class/grille.php");
///////////////////////////
$precedentA    = 0; // Numéro code_tache
$precedentV    = 0; // Numéro Voiture Précédant
$precedentS    = 0; // code_service
$precedentH    = 0; // Debut_Heure
$codeTS        = 0;
$Heure_Service = 0;
$NumSemaine = 0;
$tabVoiture = [];
$tabvehiculeAsupp = [];
///////////////////////////
?>
<html>
    <head>
    <title>Affectation - v0.9 - Importation</title>
        <link rel="stylesheet" href="../config/css/style_import.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="../config/css/style_import_print.css" type="text/css" media="print"/>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css" />
        <link rel="stylesheet" href="../config/css/jquery-ui.css" />
		<script type="text/javascript" src="../config/js/redips-drag-min.js"></script>
        <script type="text/javascript" src="../config/js/header.js"></script>
        <script type="text/javascript" src="../config/js/importation.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		         
        <script>
            Tooltip(false)
        </script>
    </head>
</html>
	<body onload="REDIPS.drag.init()">
    <div id="pageMessages">

</div>
<input class="HideOnPrint" type="text" id="FiltreParLigne" onchange="FiltrageParLigne(this.value)" placeholder="Numéro de Ligne"></input>
<?php
        $lines = file('upload/ImportAffectation.csv');
        /*On parcourt le tableau $lines et on affiche le contenu de chaque ligne précédée de son numéro*/
            $grille        = new Grille();        
    foreach ($lines as $lineNumber => $lineContent)
        {
        if($lineNumber == 0){ //|| $lineNumber != 1){

            }else{
                $split = explode(";", $lineContent);
                $splitLigneEtTache = explode("/ Ligne :", $split[0]);
                $row['code_tache'] = $splitLigneEtTache[0];
                $row['code_service'] = "T".$splitLigneEtTache[0];
                $row['ligne'] = $splitLigneEtTache[1];
                $Ligne = $row['ligne'];
                $row['arret_debut_heure'] = $split[2];
                $row['arret_fin_heure'] = $split[4];
                $row['heure_service'] = 0;
                $agents             = $row['code_tache'] . $row['code_service'];
                $getServiceSQLCount = $split[5];
                $tabVoiture[$row['code_tache'] . $row['code_service']] = new Voiture((int) $row['code_tache'], (string) $row['arret_debut_heure'], (string) $row["arret_fin_heure"],(string) $row["ligne"]);
                echo '<tr onMouseOut="javascript:this.style.background=\'#ffffff\'" onMouseOver="javascript:this.style.background=\'#F5F5F5\'" id="' . $row["code_tache"] . $row["code_service"] . '" class="' . $row["code_tache"] . $row["code_service"] . $row['code_service'] . '"><td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["code_tache"] . '/ Ligne : '.$row["ligne"] . '</td>';
                $precedentS    = $row['code_service'];
                $precedentH    = $row['arret_debut_heure'];
                $precedentS    = $row['code_service'];
                $precedentH    = $row['arret_debut_heure'];
                $Heure_Service = $row['heure_service'];
                $precedentA    = $row["code_tache"];
                $precedentV    = $row["code_service"];
                if ($getServiceSQLCount != null || $getServiceSQLCount != "") {
                    $tabVoiture[$row["code_tache"] . $row["code_service"]]->addCoupe($split[5], $split[7], 0,$splitLigneEtTache[1]);
                    $grille->setGrilleService($agents, $tabVoiture[$precedentA . $precedentV]->_HeureDebut, $tabVoiture[$precedentA . $precedentV]->_HeureFin, $tabVoiture[$precedentA . $precedentV]->_HeureDebutCoupe1, $tabVoiture[$precedentA . $precedentV]->_HeureFinCoupe1, $tabVoiture[$precedentA . $precedentV]->_HeureDebutCoupe2, $tabVoiture[$precedentA . $precedentV]->_HeureFinCoupe2, $precedentV, $tabVoiture[$precedentA . $precedentV]->_NumVoiture1, $agents, $Heure_Service,$tabVoiture[$precedentA . $precedentV]->_Ligne,$tabVoiture[$precedentA . $precedentV]->_LigneCoupe,$tabVoiture[$precedentA . $precedentV]->_LigneCoupe2);
                } else {
                    $grille->setGrilleService($agents, $tabVoiture[$precedentA . $precedentV]->_HeureDebut, $tabVoiture[$precedentA . $precedentV]->_HeureFin, $tabVoiture[$precedentA . $precedentV]->_HeureDebutCoupe1, $tabVoiture[$precedentA . $precedentV]->_HeureFinCoupe1, 0, 0, $agents, 0, 0, $Heure_Service,$tabVoiture[$precedentA . $precedentV]->_Ligne, $tabVoiture[$precedentA . $precedentV]->_LigneCoupe,$tabVoiture[$precedentA . $precedentV]->_LigneCoupe2);
                }
                $tabvehiculeAsupp[$lineNumber] = $split[3];
                echo "<script>document.getElementById('". $row["code_tache"] . $row["code_service"] . "').getElementsByClassName('fonctionnement')[0].innerHTML = '<div id=\'". $split[3]."i\' class=\'redips-drag ui-widget-content\' onmouseout=\'testdrop(\"". $split[3]."i\")\'  style=\'width: 695px, position: relative; background-color: white\'>". $split[3]."</div>'</script>";
                echo "<script>testdrop('". $split[3]."i')</script>";
            }
       }
?>
	</tbody>
</table>
<div class="FollowScreen" id="cadretable" style="background-color: white">
<input class="HideOnPrint" type="text" id="FiltreParVehicule" onchange="FiltrageParVehicule(this.value)" placeholder="Numéro de Bus"></input>
<table id="tableCitaro">
	<tbody>
		<tr>
            <td class="reset" id="HelloCitaro" onmouseover="RangementDesBus(this.id)">
                <?php
echo '<div class="vehicule" style="background-color: beige" id="000Citaro">CITARO<input class="HideOnPrint" type="checkbox" id="checkcitaro" onchange="hide(this.id,\'HelloCitaro\')"></div>';
$getCitaroSQL = getCitaroSQL($pdoAffectation);
?>                      
        </td>						
        </tr>
	</tbody>
</table>
<table id="tableCity">
    <tbody>
        <tr>
            <td class="reset" id="HelloCity">
                <?php
echo '<div class="vehicule" style="background-color: honeydew" id="000City">MINI<input class="HideOnPrint" type="checkbox" id="checkcity" onchange="hide(this.id,\'HelloCity\')"></div>';
$getCitySQL = getCitySQL($pdoAffectation);
?>                      
        </td>
        </tr>
    </tbody>
</table>

<table id="tableCrossway">
    <tbody>
        <tr>
            <td class="reset" id="HelloCrossway">
                <?php
echo '<div class="vehicule" style="background-color: lavender" id="000Cross">CROSSWAY<input class="HideOnPrint" type="checkbox" id="checkcrossway" onchange="hide(this.id,\'HelloCrossway\')"></div>';
$getCrosswaySQL = getCrosswaySQL($pdoAffectation);
?>                      
        </td>
        </tr>
    </tbody>
</table>
<table id="tableGX">
    <tbody>
        <tr>
            <td class="reset" id="HelloGX">
                <?php
echo '<div class="vehicule" style="background-color: lemonchiffon" id="000GX">GX<input class="HideOnPrint" type="checkbox" id="checkgx" onchange="hide(this.id,\'HelloGX\')"></div>';
$getGXSQL = getGXSQL($pdoAffectation);
?>                      
        </td>
        </tr>
    </tbody>
</table>
<table id="tableSetra">
    <tbody>
        <tr>
            <td class="reset" id="HelloSetra">
                <?php
echo '<div class="vehicule" style="background-color: lightgrey" id="000Setra">SETRA<input class="HideOnPrint" type="checkbox" id="checksetra" onchange="hide(this.id,\'HelloSetra\')"></div>';
$getSetraSQL = getSetraSQL($pdoAffectation);
?>                      
        </td>
            </tr>
        </tbody>
    </table>
<table id="tableLavage">
    <tbody>
        <tr>
            <td class="reset" id="HelloLavage">
                <div class="vehicule" style="background-color: rgb(255, 205, 205);">Lavage<input type="checkbox" id="checklavage" onchange="hide(this.id,\'HelloLavage\')"></div>                 
        </td>
            </tr>
        </tbody>
    </table>
<table id="tableImmo">
    <tbody>
        <tr>
            <td class="reset" id="HelloImmo">
                <div class="vehicule" style="background-color: chocolate">Immobilisation<input type="checkbox" id="checkImmo" onchange="hide(this.id,\'HelloImmo\')"></div>                 
        </td>
            </tr>
        </tbody>
    </table>
</div>
</div>
<?php
//print_r($tabvehiculeAsupp);
foreach ($tabvehiculeAsupp as $vehiculeAsupp => $valuesupp){

    echo "<script>try{document.getElementById(".$valuesupp.").remove()}catch(e){document.getElementById(\"0".$valuesupp."\").remove()}</script>";
}
?>