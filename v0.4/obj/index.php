<?php
Require_Once("class/voiture.php");
Require_Once("class/arret.php");
Require_Once("class/sql.php");
Require_Once("class/grille.php");
///////////////////////////
$precedentA=0; // Numéro Agent Précédant
$precedentV=0; // Numéro Voiture Précédant
///////////////////////////
?>
<html>
    <head>
        <link rel="stylesheet" href="../style.css" type="text/css"/>
       <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
		<script type="text/javascript" src="./js/redips-drag-min.js"></script>
        <script type="text/javascript" src="./js/script.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
  $(function() {
    $( document ).tooltip({
      items: "[title]",
      content: function() {
        var element = $( this );
        if ( element.is( "[title]" ) ) {
          return element.attr( "title" );
        }
      }
    });
  });
        </script>
    </head>
</html>
	<body onload="REDIPS.drag.init()">
<?php
$grille = new Grille(); 
$getServiceSQL = getServiceSQL($pdoAffectation);
while($row = $getServiceSQL->fetch()) { 
    if($precedentA == $row['num_agent']){
        $tabVoiture[$precedentA.$precedentV]->addCoupe((string)$row['min'],(string)$row['max']);
        echo '<tr onMouseOut="javascript:this.style.background=\'#ffffff\'" onMouseOver="javascript:this.style.background=\'#F5F5F5\'" id="'.$precedentA.$precedentV.'"><td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["num_agent"] . '<br>' .  $tabVoiture[$precedentA.$precedentV]->_HeureDebut . '-' . $tabVoiture[$precedentA.$precedentV]->_HeureFin . '<br>' . $tabVoiture[$precedentA.$precedentV]->_HeureDebutCoupe1 . '-' . $tabVoiture[$precedentA.$precedentV]->_HeureFinCoupe1 . '<br>Ligne : ' . $row["ligne"] . '</td>';      
        echo "<script>document.getElementById(".$row['num_agent'].").remove();</script>";
        $grille->setGrilleService($precedentA.$precedentV,$tabVoiture[$precedentA.$precedentV]->_HeureDebut,$tabVoiture[$precedentA.$precedentV]->_HeureFin,$tabVoiture[$precedentA.$precedentV]->_HeureDebutCoupe1,$tabVoiture[$precedentA.$precedentV]->_HeureFinCoupe1, $precedentV, $row['num_voiture']);
    }else{
        $tabVoiture[$row['num_agent'].$row['num_voiture']] = new Voiture((int)$row['num_agent'],(string)$row['min'],(string)$row['max']);  
        echo '<tr onMouseOut="javascript:this.style.background=\'#ffffff\'" onMouseOver="javascript:this.style.background=\'#F5F5F5\'" id="'.$row["num_agent"].'"><td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["num_agent"] . '<br>' . $row["min"] . '-' . $row["max"] . '<br>Ligne : ' . $row["ligne"] . '</td>';
            $grille->setGrilleService($row['num_agent'].$row['num_voiture'],$tabVoiture[$row['num_agent'].$row['num_voiture']]->_HeureDebut,$tabVoiture[$row['num_agent'].$row['num_voiture']]->_HeureFin,0,0,$row['num_voiture'],0);    
}

    $precedentA = $row["num_agent"];
    $precedentV = $row["num_voiture"];
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