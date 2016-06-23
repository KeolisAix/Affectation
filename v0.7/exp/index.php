<?php
Require_Once("class/voiture.php");
Require_Once("class/sql.php");
Require_Once("class/grille.php");
///////////////////////////
$precedentA    = 0; // Numéro code_tache
$precedentV    = 0; // Numéro Voiture Précédant
$precedentS    = 0; // code_service
$precedentH    = 0; // Debut_Heure
$codeTS        = 0;
$Heure_Service = 0;
$DateDeAffectation = $_GET["date"];
$JourDeAffectation = $_GET["day"];
$NumSemaine = 0;
$periode = $_GET["periode"];
///////////////////////////
?>
<html>
    <head>
    <title>Affectation - v0.7 - Exploitation - <?php echo $DateDeAffectation; ?></title>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="css/style_print.css" type="text/css" media="print"/>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css" />
        <link rel="stylesheet" href="css/jquery-ui.css" />
		<script type="text/javascript" src="./js/redips-drag-min.js"></script>
        <script type="text/javascript" src="../../header.js"></script>
        <script type="text/javascript" src="./js/script.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="https://github.com/niklasvh/html2canvas/releases/download/0.5.0-alpha1/html2canvas.js"></script>
        <script type="text/javascript" src="https://github.com/niklasvh/html2canvas/releases/download/0.5.0-alpha1/html2canvas.svg.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
            var DateDeAffectation = "<?php echo $DateDeAffectation; ?>"
            Tooltip(false)
        </script>
    </head>
</html>
	<body onload="REDIPS.drag.init()">
    <div id="pageMessages">

</div>
<?php
$grille        = new Grille();
$getServiceSQL = getServiceSQL($pdoAffectation, $periode, $JourDeAffectation);
while ($row = $getServiceSQL->fetch()) {
    
    $codeTS = $row['code_tache'] . $row['code_service'];
    $Ligne = $row['ligne'];
    if ($precedentA == $row['code_tache']) {
        if ($precedentH != $row['arret_debut_heure']) {
            $agents             = getAgent($pdoAffectation, $row['code_tache']);
            $getServiceSQLCount = getServiceSQLCount($pdoAffectation, $row['code_tache']);
            $tabVoiture[$precedentA . $precedentV]->addCoupe((string) $row['arret_debut_heure'], (string) $row['arret_fin_heure'], (string) $row['code_service']);
            //echo '<tr onMouseOut="javascript:this.style.background=\'#ffffff\'" onMouseOver="javascript:this.style.background=\'#F5F5F5\'" id="' . $precedentA . $precedentV . '" class="' . $precedentA . $precedentV . $row['code_service'] . '"><td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["code_tache"] . '<br>' . $tabVoiture[$precedentA . $precedentV]->_HeureDebut . '-' . $tabVoiture[$precedentA . $precedentV]->_HeureFin . '<br>' . $tabVoiture[$precedentA . $precedentV]->_HeureDebutCoupe1 . '-' . $tabVoiture[$precedentA . $precedentV]->_HeureFinCoupe1 . '<br>Ligne : ' . $row["ligne"] . '</td>';
            echo '<tr onMouseOut="javascript:this.style.background=\'#ffffff\'" onMouseOver="javascript:this.style.background=\'#F5F5F5\'" id="' . $precedentA . $precedentV . '" class="' . $precedentA . $precedentV . $row['code_service'] . '"><td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["code_tache"] . '/ Ligne : ' . $row["ligne"] . '</td>';
            
            echo "<script>document.getElementById(" . $row['code_tache'] . ").remove();</script>";
            echo "<script>removeElementsByClass(" . $precedentA . $precedentV . $precedentS . ")</script>";
            $precedentS    = $row['code_service'];
            $precedentH    = $row['arret_debut_heure'];
            $precedentS    = $row['code_service'];
            $precedentH    = $row['arret_debut_heure'];
            $Heure_Service = $row['heure_service'];
            if ($getServiceSQLCount < 3) {
                $grille->setGrilleService($agents, $tabVoiture[$precedentA . $precedentV]->_HeureDebut, $tabVoiture[$precedentA . $precedentV]->_HeureFin, $tabVoiture[$precedentA . $precedentV]->_HeureDebutCoupe1, $tabVoiture[$precedentA . $precedentV]->_HeureFinCoupe1, $tabVoiture[$precedentA . $precedentV]->_HeureDebutCoupe2, $tabVoiture[$precedentA . $precedentV]->_HeureFinCoupe2, $precedentV, $tabVoiture[$precedentA . $precedentV]->_NumVoiture1, $row['code_service'], $Heure_Service,$Ligne);
                //echo "<br>".$agents.",".$tabVoiture[$precedentA.$precedentV]->_HeureDebut.",".$tabVoiture[$precedentA.$precedentV]->_HeureFin.",".$tabVoiture[$precedentA.$precedentV]->_HeureDebutCoupe1.",".$tabVoiture[$precedentA.$precedentV]->_HeureFinCoupe1.",".$tabVoiture[$precedentA.$precedentV]->_HeureDebutCoupe2.",".$tabVoiture[$precedentA.$precedentV]->_HeureFinCoupe2.",". $precedentV.",".$tabVoiture[$precedentA.$precedentV]->_NumVoiture1.",".$row['code_service'];
            } else {
                $grille->setGrilleService($agents, $tabVoiture[$precedentA . $precedentV]->_HeureDebut, $tabVoiture[$precedentA . $precedentV]->_HeureFin, $tabVoiture[$precedentA . $precedentV]->_HeureDebutCoupe1, $tabVoiture[$precedentA . $precedentV]->_HeureFinCoupe1, 0, 0, $row['code_service'], 0, 0, $Heure_Service,$Ligne);
            }
        } else {
            
            $getServiceDoubleName = getServiceDoubleName($pdoAffectation, $row['code_tache'], $row['arret_debut_heure']);
            if ($getServiceDoubleName != null) {
                echo "<script>removeElementsByClass(" . $precedentA . $precedentV . $precedentS . ")</script>";
                $tabVoiture[$precedentA . $precedentV]->_ServiceDouble = $getServiceDoubleName;
                
            }
        }
    } else {
        $tabVoiture[$row['code_tache'] . $row['code_service']] = new Voiture((int) $row['code_tache'], (string) $row['arret_debut_heure'], (string) $row["arret_fin_heure"]);
        //echo '<tr onMouseOut="javascript:this.style.background=\'#ffffff\'" onMouseOver="javascript:this.style.background=\'#F5F5F5\'" id="' . $row["code_tache"] . '" class="' . $row["code_tache"] . '"><td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["code_tache"] . '<br>' . $row["arret_debut_heure"] . '-' . $row["arret_fin_heure"] . '<br>Ligne : ' . $row["ligne"] . '</td>';
        echo '<tr onMouseOut="javascript:this.style.background=\'#ffffff\'" onMouseOver="javascript:this.style.background=\'#F5F5F5\'" id="' . $row["code_tache"] . '" class="' . $row["code_tache"] . '"><td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["code_tache"] . '/ Ligne : ' . $row["ligne"] . '</td>';
        $grille->setGrilleService($row['code_tache'] . $row['code_service'], $tabVoiture[$row['code_tache'] . $row['code_service']]->_HeureDebut, $tabVoiture[$row['code_tache'] . $row['code_service']]->_HeureFin, 0, 0, 0, 0, $row['code_service'], 0, 0, $Heure_Service,$Ligne);
        $precedentA    = $row["code_tache"];
        $precedentV    = $row["code_service"];
        $precedentH    = $row['arret_debut_heure'];
        $Heure_Service = $row['heure_service'];
    }
    
}
$getServiceSQL->closeCursor();
?>
	</tbody>
</table>
<div class="FollowScreen" id="cadretable" style="background-color: white">
<table id="tableCitaro" style="width : 15%">
	<tbody>
		<tr>
            <td class="reset" id="HelloCitaro">
                <?php
echo '<div class="vehicule" style="background-color: beige">CITARO<input type="checkbox" id="checkcitaro" onchange="hide(this.id,\'HelloCitaro\')"></div>';
$getCitaroSQL = getCitaroSQL($pdoVehicule);
?>                      
        </td>						
        </tr>
	</tbody>
</table>
<table id="tableCity" style="width : 15%">
    <tbody>
        <tr>
            <td class="reset" id="HelloCity">
                <?php
echo '<div class="vehicule" style="background-color: honeydew">CITY<input type="checkbox" id="checkcity" onchange="hide(this.id,\'HelloCity\')"></div>';
$getCitySQL = getCitySQL($pdoVehicule);
?>                      
        </td>
        </tr>
    </tbody>
</table>

<table id="tableCrossway" style="width : 15%">
    <tbody>
        <tr>
            <td class="reset" id="HelloCrossway">
                <?php
echo '<div class="vehicule" style="background-color: lavender">CROSSWAY<input type="checkbox" id="checkcrossway" onchange="hide(this.id,\'HelloCrossway\')"></div>';
$getCrosswaySQL = getCrosswaySQL($pdoVehicule);
?>                      
        </td>
        </tr>
    </tbody>
</table>
<table id="tableGX" style="width : 15%">
    <tbody>
        <tr>
            <td class="reset" id="HelloGX">
                <?php
echo '<div class="vehicule" style="background-color: lemonchiffon">GX<input type="checkbox" id="checkgx" onchange="hide(this.id,\'HelloGX\')"></div>';
$getGXSQL = getGXSQL($pdoVehicule);
?>                      
        </td>
        </tr>
    </tbody>
</table>
<table id="tableSetra" style="width : 15%">
    <tbody>
        <tr>
            <td class="reset" id="HelloSetra">
                <?php
echo '<div class="vehicule" style="background-color: lightgrey">SETRA<input type="checkbox" id="checksetra" onchange="hide(this.id,\'HelloSetra\')"></div>';
$getSetraSQL = getSetraSQL($pdoVehicule);
?>                      
        </td>
            </tr>
        </tbody>
    </table>
<table id="tableLavage" style="width : 15%">
    <tbody>
        <tr>
            <td class="reset" id="HelloLavage">
                <div class="vehicule" style="background-color: rgb(255, 205, 205);">Lavage<input type="checkbox" id="checklavage" onchange="hide(this.id,\'HelloLavage\')"></div>                 
        </td>
            </tr>
        </tbody>
    </table>
</div>
</div>
<?php
if(@$_GET['save']== 1){

?>
<script>
var chaine2 = "";
var chaineOrigine = window.location.search.split("?save=1&")[1].split("&day")[0]
var chaineEncoded = chaineOrigine
var chaine = atob(chaineEncoded)
var chainesplit = chaine.split("p[]=")
var chaineslice = chainesplit.slice(1)
console.log(chaineslice)
chaineslice.forEach(function(entry, index) {
    chaine2 = entry.split("_")
    chaine2[2] = chaine2[2].split("&")[0]
    var element =  document.getElementById(chaine2[0])
    if (typeof(element) != 'undefined' && element != null)
    {
          document.getElementById(chaine2[0]).remove();
    }
    document.getElementById('contenue').rows[chaine2[1]].cells[chaine2[2]].innerHTML = "<div id="+chaine2[0]+" class=\"redips-drag ui-widget-content\" onmouseout=\"testdrop('"+chaine2[0]+"')\"  style=\"width: 695px, position: relative; background-color: white\">"+chaine2[0].split("c0")[0].split("c1")[0]+"</div>";
    testdrop(chaine2[0]);
})

</script>
<?php
}
?>