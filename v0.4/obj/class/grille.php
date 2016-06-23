<?php
class Grille
{
    private $_NbdeQuartHeure = 75; // de 5h -> 23h (inclus) il y'a 74 quart d'heure
    private $_nbfonctionnement;
    public function __construct()
    {
    $this->setGrilleHeure($this->_NbdeQuartHeure);
    }
    public function setGrilleHeure($_NbdeQuartHeure)
    {
    $i = 0;
    $j = 0;
        echo'<div id="redips-drag">';
	    echo'<table id="contenue">';
	    echo'<colgroup>';
        echo"<col width='100' />";
    while ($i != $_NbdeQuartHeure){if($i == 0){echo "<col width='0'/>";}else{echo "<col width='20'/>";}$i++;}
    echo '</colgroup><tbody>
                        <th class="redips-mark">Service</th>
                        <th style="font-size: 1px;height:1px">H</th>
                        <th class="redips-mark">5h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">6h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">7h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">8h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">9h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">10h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">11h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">12h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">13h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">14h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">15h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">16h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">17h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">18h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">19h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">20</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">21</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">22h</th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark"></th>
                        <th class="redips-mark">23h</th>';
    }
    public function setGrilleService($_NumService, $HD, $HF, $HDC1, $HFC1, $Voiture, $Voiture2)
    {
        $DebutGrille = $this->dateDiff('05:00', $HD,0);
        for ($i = 0; $i <= $DebutGrille; $i++) {
            if($i == 0){
                echo '<td id="_'.$_NumService.'" class="redips-mark" style="font-size: 1px;height:1px" ></td>';
            }else
            {
                echo '<td class="redips-mark" ></td>';
            }

        }
        if($HDC1 == 0){ // Si pas de coupé
            $Nbdequartfonctionnement = $this->dateDiff($HD, $HF,0);
            for ($i = 1; $i <= $Nbdequartfonctionnement; $i++) {
                echo '<td class="fonctionnement" title="<center>Service : Voiture</center><br>Voiture : <b>'.$Voiture.'</b><br>Heure de début : <b>'.$HD.'</b><br>Heure de Fin : <b>'.$HF.'</b>" style="background-color: #00ace6"></td>';
            }
            $NbdequartApres = $this->dateDiff($HF, '23:00',0);
            for ($i = 1; $i <= $NbdequartApres; $i++) {
                echo '<td  class="redips-mark"></td>';
            }
          echo "<script>document.getElementById('_".$_NumService."').innerHTML = ".$Nbdequartfonctionnement."</script>";
        }
        if($HDC1 != 0){ // Si coupé
            $Nbdequartfonctionnement = $this->dateDiff($HD, $HF,2);
            for ($i = 1; $i <= $Nbdequartfonctionnement; $i++) {
                echo '<td class="fonctionnement" title="<center>Service : Voiture</center><br>Voiture : <b>'.$Voiture.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HD.'</b><br>Heure de Fin : <b>'.$HF.'</b>" style="background-color: #00ace6"></td>';
            }
            $NbdequartCoupe = $this->dateDiff($HF, $HDC1,0);
            for ($i = 1; $i <= $NbdequartCoupe; $i++) {
                echo '<td  class="redips-mark"></td>';
            }
            $NbdequartfonctionnementCoupé = $this->dateDiff($HDC1, $HFC1,0);
            for ($i = 1; $i <= $NbdequartfonctionnementCoupé; $i++) {
                if($i == 1 ){
                    echo '<td class="fonctionnement coupe" title="<center>Service : Voiture</center><br>Voiture : <b>'.$Voiture2.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HDC1.'</b><br>Heure de Fin : <b>'.$HFC1.'</b>" id="_coupe'.$_NumService.'" style="background-color: #00ace6"></td>';
                }else{
                    echo '<td class="fonctionnement coupe" title="<center>Service : Voiture</center><br>Voiture : <b>'.$Voiture2.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HDC1.'</b><br>Heure de Fin : <b>'.$HFC1.'</b>" id="_coupe'.$_NumService.'" style="background-color: #00ace6"></td>';
                }
            }
            $NbdequartApres = $this->dateDiff($HFC1, '23:00',0);
            for ($i = 1; $i <= $NbdequartApres; $i++) {
                echo '<td  class="redips-mark"></td>';
            }
                echo "<script>document.getElementById('_".$_NumService."').innerHTML = \"".$Nbdequartfonctionnement."-".$NbdequartfonctionnementCoupé."\"</script>";
                //echo"document.getElementById('_".$_NumService."').innerHTML = \"".$Nbdequartfonctionnement."-".$NbdequartfonctionnementCoupé."\"; 
        }
            for ($i = $this->_nbfonctionnement; $i < 73; $i++) {
                echo '<td  class="redips-mark"></td>';
            }

            $this->_nbfonctionnement = 0;   
    }
    private function dateDiff($date1, $date2, $decal) {
        $dateun = new DateTime('2016-02-19 '.$date1);
        $datedeux = new DateTime('2016-02-19 '.$date2);
        $recupminute = 0;
        $enleveCell = 0;
        $tmp=$datedeux->diff($dateun);
        $h = $tmp->h;
        $m = $tmp->i;
        if ($m >= 1 && $m < 15) {
            $recupminute = $recupminute + 1;
        }        
        if ($m >= 15 && $m < 30) {
            $recupminute = $recupminute + 1;
        }
        if ($m >= 30 && $m < 45) {
            $recupminute = $recupminute + 2;
        }
        if ($m >= 45 && $m <= 59) {
            $recupminute = $recupminute + 3;
        }
        $recupminute = $recupminute + ((int)$h * 4);
        $this->_nbfonctionnement = $this->_nbfonctionnement + $recupminute + $decal;
        //echo $this->_nbfonctionnement."-";
        if($this->_nbfonctionnement > 73){
            for ($i = 73; $i < $this->_nbfonctionnement; $i++) {
               $enleveCell = $enleveCell+1;
            }
        }
        return $recupminute  + $decal - $enleveCell;
    }
}
?>