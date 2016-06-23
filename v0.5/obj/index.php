<?php
Require_Once("class/voiture.php");
Require_Once("class/arret.php");
Require_Once("class/sql.php");
Require_Once("class/grille.php");
///////////////////////////
$precedentA=0; // Numéro code_tache
$precedentV=0; // Numéro Voiture Précédant
$precedentS=0; // code_service
$precedentH=0; // Debut_Heure
$codeTS = 0;
///////////////////////////
?>
<html>
    <head>
    <title>Affectation - v0.5</title>
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
       <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
		<script type="text/javascript" src="./js/redips-drag-min.js"></script>
        <script type="text/javascript" src="../../header.js"></script>
        <script type="text/javascript" src="./js/script.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
        $(function () {
    $(document).tooltip({
        items: "[title]",
        content: function () {
            var element = $(this);
            if (element.is("[title]")) {
                return element.attr("title");
            }
        }
    });
});
function RemoveCell(codetache) {

    var count = $("tr[class*='" + codetache + "']").length;
    for (var i = 1; i < count; i++) {
        $("tr[class*='" + codetache + "']")[i].remove();
    }
}
        </script>
    </head>
</html>
	<body onload="REDIPS.drag.init()">
<?php
$grille = new Grille();
$getServiceSQL = getServiceSQL($pdoAffectation);
while($row = $getServiceSQL->fetch()) {

    $codeTS = $row['code_tache'].$row['code_service'];
        if($precedentA == $row['code_tache']){
            if($precedentH != $row['arret_debut_heure']){
                    $agents = getAgent($pdoAffectation, $row['code_tache']);
                    $getServiceSQLCount = getServiceSQLCount($pdoAffectation, $row['code_tache']);

                    $tabVoiture[$precedentA.$precedentV]->addCoupe((string)$row['arret_debut_heure'],(string)$row['arret_fin_heure'],(string)$row['code_service']);

                    echo '<tr onMouseOut="javascript:this.style.background=\'#ffffff\'" onMouseOver="javascript:this.style.background=\'#F5F5F5\'" id="'.$precedentA.$precedentV.'" class="'.$precedentA.$precedentV.$row['code_service'].'"><td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["code_tache"] . '<br>' .  $tabVoiture[$precedentA.$precedentV]->_HeureDebut . '-' . $tabVoiture[$precedentA.$precedentV]->_HeureFin . '<br>' . $tabVoiture[$precedentA.$precedentV]->_HeureDebutCoupe1 . '-' . $tabVoiture[$precedentA.$precedentV]->_HeureFinCoupe1 . '<br>Ligne : ' . $row["ligne"] . '</td>';      
                    echo "<script>document.getElementById(".$row['code_tache'].").remove();</script>";
                    echo "<script>removeElementsByClass(".$precedentA.$precedentV.$precedentS.")</script>";
                    $precedentS = $row['code_service'];
                    $precedentH = $row['arret_debut_heure'];
                    $precedentS = $row['code_service'];
                    $precedentH = $row['arret_debut_heure'];
                        if($getServiceSQLCount < 3){
                            $grille->setGrilleService($agents,$tabVoiture[$precedentA.$precedentV]->_HeureDebut,$tabVoiture[$precedentA.$precedentV]->_HeureFin,$tabVoiture[$precedentA.$precedentV]->_HeureDebutCoupe1,$tabVoiture[$precedentA.$precedentV]->_HeureFinCoupe1, $tabVoiture[$precedentA.$precedentV]->_HeureDebutCoupe2,$tabVoiture[$precedentA.$precedentV]->_HeureFinCoupe2, $precedentV,$tabVoiture[$precedentA.$precedentV]->_NumVoiture1, $row['code_service']);
                        //echo "<br>".$agents.",".$tabVoiture[$precedentA.$precedentV]->_HeureDebut.",".$tabVoiture[$precedentA.$precedentV]->_HeureFin.",".$tabVoiture[$precedentA.$precedentV]->_HeureDebutCoupe1.",".$tabVoiture[$precedentA.$precedentV]->_HeureFinCoupe1.",".$tabVoiture[$precedentA.$precedentV]->_HeureDebutCoupe2.",".$tabVoiture[$precedentA.$precedentV]->_HeureFinCoupe2.",". $precedentV.",".$tabVoiture[$precedentA.$precedentV]->_NumVoiture1.",".$row['code_service'];
                        }else{
                           $grille->setGrilleService($agents,$tabVoiture[$precedentA.$precedentV]->_HeureDebut,$tabVoiture[$precedentA.$precedentV]->_HeureFin,$tabVoiture[$precedentA.$precedentV]->_HeureDebutCoupe1,$tabVoiture[$precedentA.$precedentV]->_HeureFinCoupe1, 0, 0, $row['code_service'],0,0);
                        }
                }                         
                    else{

                         $getServiceDoubleName = getServiceDoubleName($pdoAffectation, $row['code_tache'], $row['arret_debut_heure']);
                             if($getServiceDoubleName != null){
                                                echo "<script>removeElementsByClass(".$precedentA.$precedentV.$precedentS.")</script>";
                                                //echo $precedentA.$precedentV.$precedentS;
                                $tabVoiture[$precedentA.$precedentV]->_ServiceDouble = $getServiceDoubleName;

                            }
                        }   
        }else{
            $tabVoiture[$row['code_tache'].$row['code_service']] = new Voiture((int)$row['code_tache'],(string)$row['arret_debut_heure'],(string)$row["arret_fin_heure"]);  
            echo '<tr onMouseOut="javascript:this.style.background=\'#ffffff\'" onMouseOver="javascript:this.style.background=\'#F5F5F5\'" id="'.$row["code_tache"].'" class="'.$row["code_tache"].'"><td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["code_tache"] . '<br>' . $row["arret_debut_heure"] . '-' . $row["arret_fin_heure"] . '<br>Ligne : ' . $row["ligne"] . '</td>';
                $grille->setGrilleService($row['code_tache'].$row['code_service'],$tabVoiture[$row['code_tache'].$row['code_service']]->_HeureDebut,$tabVoiture[$row['code_tache'].$row['code_service']]->_HeureFin,0,0,0,0,$row['code_service'],0,0);    
                $precedentA = $row["code_tache"];
                $precedentV = $row["code_service"];
                $precedentH = $row['arret_debut_heure'];
    }

    }
$getServiceSQL->closeCursor();
?>
	</tbody>
</table>
<div class="dontmove" id="cadretable" style="background-color: white">
<table id="tableCitaro">
	<tbody>
		<tr>
            <td>
                <?php
                    $getCitaroSQL = getCitaroSQL($pdoVehicule);
                ?>                      
        </td>						
        </tr>
	</tbody>
</table>
<table id="tableCity">
    <tbody>
        <tr>
            <td>
                <?php
                    $getCitySQL = getCitySQL($pdoVehicule);
                ?>                      
        </td>
        </tr>
    </tbody>
</table>
<table id="tableCrossway">
    <tbody>
        <tr>
            <td>
                <?php
                    $getCrosswaySQL = getCrosswaySQL($pdoVehicule);
                ?>                      
        </td>
        </tr>
    </tbody>
</table>
<table id="tableGX">
    <tbody>
        <tr>
            <td>
                <?php
                    $getGXSQL = getGXSQL($pdoVehicule);
                ?>                      
        </td>
        </tr>
    </tbody>
</table>
<table id="tableSetra">
    <tbody>
        <tr>
            <td>
                <?php
                    $getSetraSQL = getSetraSQL($pdoVehicule);
                ?>                      
        </td>
            </tr>
        </tbody>
    </table>
</div>
</div>