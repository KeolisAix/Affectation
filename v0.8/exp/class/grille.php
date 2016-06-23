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
	    echo'<table id="contenue" style="float:left">';
	    echo'<colgroup>';
        echo"<col width='100' />";
    while ($i != $_NbdeQuartHeure){if($i == 0){echo "<col width='0'/>";}else{echo "<col width='20'/>";}$i++;}
    echo '</colgroup><tbody>
                        <th class="redips-mark">Tâche</th>
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
    public function setGrilleService($_NumService, $HD, $HF, $HDC1, $HFC1, $HDC2, $HFC2, $Voiture, $Voiture1, $Voiture2, $Heure_Service, $Ligne, $LigneCoupe, $LigneCoupe2)
    {
        @$HDS = explode(":", $HD);
        @$HDR = $HDS[0].':'.$HDS[1];
        @$HDC1S = explode(":", $HDC1);
        @$HDC1R = $HDC1S[0].':'.$HDC1S[1];
        @$HDC2S = explode(":", $HDC2);
        @$HDC2R = $HDC2S[0].':'.$HDC2S[1];
        ////
        @$HFS = explode(":", $HF);
        @$HFR = $HFS[0].':'.$HFS[1];
        @$HFC1S = explode(":", $HFC1);
        @$HFC1R = $HFC1S[0].':'.$HFC1S[1];
        @$HFC2S = explode(":", $HFC2);
        @$HFC2R = $HFC2S[0].':'.$HFC2S[1];
        $Moinsdecalage =0;
        ////
        $DebutGrille = $this->dateDiff('05:00:00', $HD,0);
        for ($i = 0; $i <= $DebutGrille; $i++) {
            if($i == 0){
                //echo '<td id="_'.$_NumService.'" class="redips-mark" style="font-size: 1px;height:1px" ></td>';
                echo '<td id="_'.$_NumService.'" class="redips-mark debut" style="font-size: 1px;height:1px ></td>';
            }elseif($i == $DebutGrille)
            {
                echo '<td class="redips-mark debut" >'.$HDR.'</td>';
            }else{
                echo '<td class="redips-mark debut" ></td>';
            }

        }
        if($HDC1 == 0 && $HDC2 == 0){ // Si pas de coupé
        //echo "PASDECOUPE";
            $Nbdequartfonctionnement = $this->dateDiff($HD, $HF,0);
            for ($i = 1; $i <= $Nbdequartfonctionnement; $i++) {
                echo '<td class="fonctionnement" title="<center>Service : Agent</center><br>Agent : <b>'.$Voiture.'</b><br>Ligne : <b>'.$Ligne.'</b><br>Heure de début : <b>'.$HD.'</b><br>Heure de Fin : <b>'.$HF.'</b>"></td>';
            }
            $NbdequartApres = $this->dateDiff($HF, '23:00:00',0);
            for ($i = 1; $i <= $NbdequartApres; $i++) {
                if($i == 1){
                    echo '<td  class="redips-mark fin">'.$HFR.'</td>';                
                }else{
                    echo '<td  class="redips-mark fin"></td>';
                }
            }
          echo "<script>document.getElementById('_".$_NumService."').innerHTML = ".$Nbdequartfonctionnement."</script>";
        }
        if($HDC1 != 0 && $HDC2 == 0){ // Si coupé
        //echo "COUPE1";
            $Nbdequartfonctionnement = $this->dateDiff($HD, $HF,2);
            for ($i = 1; $i <= $Nbdequartfonctionnement; $i++) {
                echo '<td class="fonctionnement" title="<center>Service : Agent</center><br>Agent : <b>'.$Voiture.'</b><br>Ligne : <b>'.$Ligne.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HD.'</b><br>Heure de Fin : <b>'.$HF.'</b>"></td>';
            }
            $NbdequartCoupe = $this->dateDiff($HF, $HDC1,0);
            for ($i = 1; $i <= $NbdequartCoupe; $i++) {
                if($i == 1){
                    echo '<td  class="redips-mark entre">'.$HFR.'</td>';                
                }elseif($i == $NbdequartCoupe){
                    echo '<td  class="redips-mark entre">'.$HDC1R.'</td>';     
                }else{
                    echo '<td  class="redips-mark entre"></td>';
                }
            }
            $NbdequartfonctionnementCoupé = $this->dateDiff($HDC1, $HFC1,0);
            for ($i = 1; $i <= $NbdequartfonctionnementCoupé; $i++) {
                if($i == 1 ){
                    echo '<td class="fonctionnement coupe" title="<center>Service : Agent</center><br>Agent : <b>'.$Voiture1.'</b><br>Ligne : <b>'.$LigneCoupe.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HDC1.'</b><br>Heure de Fin : <b>'.$HFC1.'</b>" id="_coupe'.$_NumService.'"></td>';
                }else{
                    echo '<td class="fonctionnement coupe" title="<center>Service : Agent</center><br>Agent : <b>'.$Voiture1.'</b><br>Ligne : <b>'.$LigneCoupe.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HDC1.'</b><br>Heure de Fin : <b>'.$HFC1.'</b>" id="_coupe'.$_NumService.'"></td>';
                }
            }
            $NbdequartApres = $this->dateDiff($HFC1, '23:00:00',0);
            for ($i = 1; $i <= $NbdequartApres; $i++) {
                if($i == 1){
                    echo '<td  class="redips-mark fin">'.$HFC1R.'</td>';                
                }else{
                    echo '<td  class="redips-mark fin"></td>';
                }
            }
                echo "<script>document.getElementById('_".$_NumService."').innerHTML = \"".$Nbdequartfonctionnement."-".$NbdequartfonctionnementCoupé."\"</script>";
        }
            if($HDC2 != 0){ // Si coupé 2
            //echo "COUPE2";
            $Nbdequartfonctionnement = $this->dateDiff($HD, $HF,2);
            for ($i = 1; $i <= $Nbdequartfonctionnement; $i++) {
                echo '<td class="fonctionnement" title="<center>Service : Agent</center><br>Agent : <b>'.$Voiture.'</b><br>Ligne : <b>'.$Ligne.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HD.'</b><br>Heure de Fin : <b>'.$HF.'</b>"></td>';
            }
            $NbdequartCoupe = $this->dateDiff($HF, $HDC1,0);
            for ($i = 1; $i <= $NbdequartCoupe; $i++) {
                if($i == 1){
                    echo '<td  class="redips-mark entre">'.$HFR.'</td>';                
                }elseif($i == $NbdequartCoupe){
                    echo '<td  class="redips-mark entre">'.$HDC1R.'</td>';     
                }else{
                    echo '<td  class="redips-mark entre"></td>';
                }
            }
            $NbdequartfonctionnementCoupé = $this->dateDiff($HDC1, $HFC1,0);
            for ($i = 1; $i <= $NbdequartfonctionnementCoupé; $i++) {
                if($i == 1 ){
                    echo '<td class="fonctionnement coupe" title="<center>Service : Agent</center><br>Agent : <b>'.$Voiture1.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HDC1.'</b><br>Ligne : <b>'.$LigneCoupe.'</b><br>Heure de Fin : <b>'.$HFC1.'</b>" id="_coupe'.$_NumService.'"></td>';
                }else{
                    echo '<td class="fonctionnement coupe" title="<center>Service : Agent</center><br>Agent : <b>'.$Voiture1.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HDC1.'</b><br>Ligne : <b>'.$LigneCoupe.'</b><br>Heure de Fin : <b>'.$HFC1.'</b>" id="_coupe'.$_NumService.'"></td>';
                }
            }
            $NbdequartCoupe = $this->dateDiff($HFC1, $HDC2,0);
            for ($i = 1; $i <= $NbdequartCoupe; $i++) {
                if($i == 1 && $NbdequartCoupe <> 1){
                    echo '<td  class="redips-mark entre deux">'.$HFC1R.'</td>';                
                }elseif($i == 1 && $NbdequartCoupe == 1){
                    echo '<td  class="redips-mark entre deux" style="vertical-align: text-top">'.$HFC1R.'</td><td  class="redips-mark entre deux">'.$HDC2R.'</td>';
                    $Moinsdecalage = 1;
                }elseif($i == $NbdequartCoupe){
                    echo '<td  class="redips-mark entre deux">'.$HDC2R.'</td>';     
                }else{
                    echo '<td  class="redips-mark entre deux"></td>';
                }
            }
            $NbdequartfonctionnementCoupédeux = $this->dateDiff($HDC2, $HFC2,0);
            for ($i = 1; $i <= $NbdequartfonctionnementCoupédeux; $i++) {
                if($i == 1 ){
                    echo '<td class="fonctionnement coupe deux" title="<center>Service : Agent</center><br>Agent : <b>'.$Voiture2.'</b><br>Ligne : <b>'.$LigneCoupe2.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HDC2.'</b><br>Heure de Fin : <b>'.$HFC2.'</b>" id="_coupe'.$_NumService.'"></td>';
                }else{
                    echo '<td class="fonctionnement coupe deux" title="<center>Service : Agent</center><br>Agent : <b>'.$Voiture2.'</b><br>Ligne : <b>'.$LigneCoupe2.'</b><br>Coupé : <b>Oui</b><br>Heure de début : <b>'.$HDC2.'</b><br>Heure de Fin : <b>'.$HFC2.'</b>" id="_coupe'.$_NumService.'"></td>';
                }
            }
                        $NbdequartApres = $this->dateDiff($HFC2, '23:00:00',0);
            for ($i = 1; $i <= $NbdequartApres - $Moinsdecalage; $i++) {
                if($i == 1){
                    echo '<td  class="redips-mark fin">'.$HFC2R.'</td>';                
                }else{
                    echo '<td  class="redips-mark fin"></td>';
                }
            }
                echo "<script>document.getElementById('_".$_NumService."').innerHTML = \"".$Nbdequartfonctionnement."-".$NbdequartfonctionnementCoupé."-".$NbdequartfonctionnementCoupédeux."\"</script>";
        }
            for ($i = $this->_nbfonctionnement; $i < 73; $i++) {
                echo '<td  class="redips-mark fin"></td>';
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
        if($this->_nbfonctionnement > 73){
            for ($i = 73; $i < $this->_nbfonctionnement; $i++) {
               $enleveCell = $enleveCell+1;
            }
        }
        return $recupminute  + $decal - $enleveCell;
    }
}
?>