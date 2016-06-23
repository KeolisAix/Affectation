<?php
$i=0;
require("../config.php");
$connectVehi = pg_connect($host." ".$dbnamevehicule." ".$userpg." ".$pswpg);
$connectAff = pg_connect($host." ".$dbnameAff." ".$userpg." ".$pswpg);
$a =0;$b =0;$c =0;$d =0;$e =0;$f =0;$g =0;$h =0;$i =0;$j =0;$k =0;$l =0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<link rel="stylesheet" href="../style.css" type="text/css"/>
		<script type="text/javascript" src="../../header.js"></script>
		<script type="text/javascript" src="../../redips-drag-min.js"></script>
        <!-- -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="../bootstrap.min.js"></script>
        <script src="../script.js"></script>
        <!-- -->
        <title>Affectation V0.3 - 26/02/16</title>
	</head>
	<body onload="REDIPS.drag.init()">
		<center>
<div class="modal">
  <p class="oneline">
  <img src="http://gifs.hurgon.fr/images/transports/camions/camion_065.gif" style="margin-top : 10%" /><br>
    Veuillez patienter pendant le chargement de la grille.
</div>
<script>
    var w = $(window).width() / 2 - $('.modal').outerWidth() / 2,
        h = $(window).height() / 2 - $('.modal').outerHeight() / 2;
    $('.modal').css({
        top: h,
        left: w
    });
    $(window).resize(function () {
        var w = $(window).width() / 2 - $('.modal').outerWidth() / 2,
            h = $(window).height() / 2 - $('.modal').outerHeight() / 2;
        $('.modal').css({
            top: h,
            left: w
        });
    });
   $('.modal').fadeToggle();
</script>
			<!-- tables inside this DIV could contain drag-able content  -->
			<div id="redips-drag">
				<table id="contenue">
					<colgroup>
                    <col width='100' />
                    <?php
while ($i != 73) {
    echo "<col width='20'/>";
    $i++;
}
?>
					</colgroup>
					<tbody>
                        <th class="redips-mark">Service</th>
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
                        <th class="redips-mark">23h</th>
<?php
$select = 'SELECT * FROM "public".v_voiture LIMIT 5';
$Services = pg_query($connectAff, $select) or die('Error in query procedural --> ' . pg_last_error());
$total = pg_num_rows($Services);
if ($total) {
$i = 0;
    while ($row = pg_fetch_array($Services)) {
        echo '<tr id="'.$row["num_voiture"].'">';
        echo '<td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["num_voiture"] . '<br>' . $row["min"] . '-' . $row["max"] . '</td>';
if($row["min"] < "06:00"){
    if($row["min"] == "05:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "05:00" && $row["min"] <= "05:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "05:15" && $row["min"] <= "05:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "05:30" && $row["min"] <= "06:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "06:00" && $row["min"] < "07:00"){
    while($a <> 4){
        echo '<td  class="redips-mark"></td>';
        $a = $a + 1;
    }
    $a = 0;
    if($row["min"] == "06:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "06:00" && $row["min"] <= "06:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "06:15" && $row["min"] <= "06:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "06:30" && $row["min"] <= "07:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "07:00" && $row["min"] < "08:00"){
    while($b <> 8){
        echo '<td  class="redips-mark"></td>';
        $b = $b + 1;
    }    
    if($row["min"] == "07:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "07:00" && $row["min"] <= "07:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "07:15" && $row["min"] <= "07:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "07:30" && $row["min"] <= "08:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "08:00" && $row["min"] < "09:00"){
    while($c <> 12){
        echo '<td  class="redips-mark"></td>';
        $c = $c + 1;
    }
    if($row["min"] == "08:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "08:00" && $row["min"] <= "08:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "08:15" && $row["min"] <= "08:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "08:30" && $row["min"] <= "09:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "09:00" && $row["min"] < "10:00"){
    while($d <> 16){
        echo '<td  class="redips-mark"></td>';
        $d = $d + 1;
    }
    if($row["min"] == "09:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "09:00" && $row["min"] <= "09:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "09:15" && $row["min"] <= "09:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "09:30" && $row["min"] <= "10:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "10:00" && $row["min"] < "11:00"){
    while($e <> 20){
        echo '<td  class="redips-mark"></td>';
        $e = $e + 1;
    }
    if($row["min"] == "10:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "10:00" && $row["min"] <= "10:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "10:15" && $row["min"] <= "10:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "10:30" && $row["min"] <= "11:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "11:00" && $row["min"] < "12:00"){
    while($f <> 24){
        echo '<td  class="redips-mark"></td>';
        $f = $f + 1;
    }
    if($row["min"] == "11:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "11:00" && $row["min"] <= "11:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "11:15" && $row["min"] <= "11:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "11:30" && $row["min"] <= "12:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "12:00" && $row["min"] < "13:00"){
    while($g <> 28){
        echo '<td  class="redips-mark"></td>';
        $g = $g + 1;
    }
    if($row["min"] == "12:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "12:00" && $row["min"] <= "12:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "12:15" && $row["min"] <= "12:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "12:30" && $row["min"] <= "13:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "13:00" && $row["min"] < "14:00"){
    while($h <> 32){
        echo '<td  class="redips-mark"></td>';
        $h = $h + 1;
    }
    if($row["min"] == "13:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "13:00" && $row["min"] <= "13:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "13:15" && $row["min"] <= "13:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "13:30" && $row["min"] <= "14:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "14:00" && $row["min"] < "15:00"){
    while($i <> 36){
        echo '<td  class="redips-mark"></td>';
        $i = $i + 1;
    }
    if($row["min"] == "14:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "14:00" && $row["min"] <= "14:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "14:15" && $row["min"] <= "14:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "14:30" && $row["min"] <= "15:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "15:00" && $row["min"] < "16:00"){
    while($j <> 40){
        echo '<td  class="redips-mark"></td>';
        $j = $j + 1;
    }
    if($row["min"] == "15:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "15:00" && $row["min"] <= "15:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "15:15" && $row["min"] <= "15:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "15:30" && $row["min"] <= "16:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "16:00" && $row["min"] < "17:00"){
    while($k <> 44){
        echo '<td  class="redips-mark"></td>';
        $k = $k + 1;
    }
    if($row["min"] == "16:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "16:00" && $row["min"] <= "16:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "16:15" && $row["min"] <= "16:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "16:30" && $row["min"] <= "17:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
if($row["min"] >= "17:00" && $row["min"] < "18:00"){
    while($l <> 48){
        echo '<td  class="redips-mark"></td>';
        $l = $l + 1;
    }
    if($row["min"] == "17:00"){
        echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "17:00" && $row["min"] <= "17:15"){
        echo '<td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "17:15" && $row["min"] <= "17:30"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    if($row["min"] > "17:30" && $row["min"] <= "18:00"){
        echo '<td  class="redips-mark"></td><td  class="redips-mark"></td><td  class="redips-mark"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
    else{
        //echo '<td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td><td class="fonctionnement" style="background-color: #00ace6"></td>';
    }
}
echo '
<script>
diffquart = dateDiff("'.$row["min"].':00","'.$row["max"].':00");
console.log(\'dateDiff("'.$row["min"].':00","'.$row["max"].':00")\');
console.log(diffquart);
    for (var j = 0; j < diffquart; j++) {
        document.getElementById('.$row["num_voiture"].').innerHTML = document.getElementById('.$row["num_voiture"].').innerHTML + "<td style=\"background-color: #00ace6\"></td>" 
}
AddCell('.$row["num_voiture"].');
</script>
';
    }
}
?>
					</tbody>
				</table>
                <div class="dontmove" id="cadretable" style="background-color: white">
                <table id="tableCitaro">
					<tbody>
						<tr>
                            <td>
                                <?php
$selectVehi = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'CITARO\'';
$ServicesVehi = pg_query($connectVehi, $selectVehi) or die('Error in query procedural --> ' . pg_last_error());
$totalVehi = pg_num_rows($ServicesVehi);
if ($totalVehi) {
    while ($rowvehi = pg_fetch_array($ServicesVehi)) {
        echo '<div id="'.$rowvehi["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$rowvehi["parc_keolis"].'\')" style="width: 695px, position: relative">'.$rowvehi["parc_keolis"].'</div>';
    }
}
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
$selectVehi = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'CITY 21\'';
$ServicesVehi = pg_query($connectVehi, $selectVehi) or die('Error in query procedural --> ' . pg_last_error());
$totalVehi = pg_num_rows($ServicesVehi);
if ($totalVehi) {
    while ($rowvehi = pg_fetch_array($ServicesVehi)) {
        echo '<div id="'.$rowvehi["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$rowvehi["parc_keolis"].'\')" style="width: 695px, position: relative">'.$rowvehi["parc_keolis"].'</div>';
    }
}
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
$selectVehi = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'CROSSWAY LE\'';
$ServicesVehi = pg_query($connectVehi, $selectVehi) or die('Error in query procedural --> ' . pg_last_error());
$totalVehi = pg_num_rows($ServicesVehi);
if ($totalVehi) {
    while ($rowvehi = pg_fetch_array($ServicesVehi)) {
        echo '<div id="'.$rowvehi["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$rowvehi["parc_keolis"].'\')" style="width: 695px, position: relative">'.$rowvehi["parc_keolis"].'</div>';
    }
}
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
$selectVehi = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'GX 127C\'';
$ServicesVehi = pg_query($connectVehi, $selectVehi) or die('Error in query procedural --> ' . pg_last_error());
$totalVehi = pg_num_rows($ServicesVehi);
if ($totalVehi) {
    while ($rowvehi = pg_fetch_array($ServicesVehi)) {
        echo '<div id="'.$rowvehi["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$rowvehi["parc_keolis"].'\')" style="width: 695px, position: relative">'.$rowvehi["parc_keolis"].'</div>';
    }
}
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
$selectVehi = 'SELECT vehicules.vehicule.parc_keolis, vehicules.vehicule.modele  FROM vehicules.vehicule WHERE vehicules.vehicule.modele = \'SETRA 415 NF\'';
$ServicesVehi = pg_query($connectVehi, $selectVehi) or die('Error in query procedural --> ' . pg_last_error());
$totalVehi = pg_num_rows($ServicesVehi);
if ($totalVehi) {
    while ($rowvehi = pg_fetch_array($ServicesVehi)) {
        echo '<div id="'.$rowvehi["parc_keolis"].'" class="redips-drag ui-widget-content" onmouseout="testdrop(\''.$rowvehi["parc_keolis"].'\')" style="width: 695px, position: relative">'.$rowvehi["parc_keolis"].'</div>';
    }
}
                                ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
			</div>
		</center>
        <div id='controls'>
            <label><input type="checkbox" id="citaroON" value="citaroON" checked="checked" onclick="HideMe('Citaro')" />Citaro</label><br />
            <label><input type="checkbox" id="cityON" value="cityON" checked="checked" onclick="HideMe('City')" />City 21</label><br />
            <label><input type="checkbox" id="crosswayON" value="crosswayON" checked="checked" onclick="HideMe('Crossway')" />Crossway LE</label><br />
            <label><input type="checkbox" id="gxON" value="gxON" checked="checked" onclick="HideMe('GX')" />GX217</label><br />
            <label><input type="checkbox" id="setraON" value="setraON" checked="checked" onclick="HideMe('Setra')" />Setra</label><br />
            <label><input type="button" id="save" value="Enregistrer" onclick="mySaveContent(contenue)" /></label><br />
        </div>
        <script>
$('#controls').draggable();
   $('.modal').fadeToggle();

   window.onscroll = function() {
                    var haut = (document.body.clientHeight);
                    if (haut > 900) {
                        var scroll = (document.documentElement.scrollTop ||
                                document.body.scrollTop);
                                console.log(scroll);
                        if (scroll > 0 && scroll < 4750) {
                            document.getElementById('cadretable').style.position = 'absolute';
                            document.getElementById('cadretable').style.top = scroll+400 + 'px';
                        } else if (scroll > 4750 || scroll === 4500) {
                            document.getElementById('cadretable').style.position = 'initial';
                        }
                    }
                }
</script>
	</body>
</html>

<?php
if(@$_GET['save']== 1){

?>
<script>
var chaine2 = "";
var chaineOrigine = window.location.search.split("?save=1&")
var chaineEncoded = chaineOrigine[1]
var chaine = atob(chaineEncoded)
var chainesplit = chaine.split("p[]=")
var chaineslice = chainesplit.slice(1)
chaineslice.forEach(function(entry, index) {
    chaine2 = entry.split("_")
    chaine2[2] = chaine2[2].split("&")[0]
    document.getElementById(chaine2[0]).remove();
    document.getElementById('contenue').rows[chaine2[1]].cells[chaine2[2]].innerHTML = "<div id="+chaine2[0]+" class=\"redips-drag ui-widget-content\" style=\"border-style: solid; cursor: move;\">"+chaine2[0]+"</div>";
    testdrop(chaine2[0]);
})
</script>
<?php
}
?>
