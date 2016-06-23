<?php
$i=0;
require("config.php");
$connectVehi = pg_connect($host." ".$dbnamevehicule." ".$userpg." ".$pswpg);
$connectAff = pg_connect($host." ".$dbnameAff." ".$userpg." ".$pswpg);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="../header.js"></script>
		<script type="text/javascript" src="../redips-drag-min.js"></script>
        <!-- -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
  $(function() {
    $( "#resizable" ).resizable({
      grid: 50
    });
  });
    </script>
        <!-- -->
        <title>Affectation V0.2 - 04/02/16</title>
	</head>
	<body onload="REDIPS.drag.init()">
		<center>
			<!-- tables inside this DIV could contain drag-able content  -->
			<div id="redips-drag">
				<table>
					<colgroup>
                    <col width='100' />
                    <?php
while ($i != 69) {
    echo "<col width='25'/>";
    $i++;
}
?>
					</colgroup>
					<tbody>
                        <th>Service</th>
                        <th>5h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>6h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>7h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>8h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>9h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>10h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>11h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>12h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>13h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>14h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>15h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>16h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>17h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>18h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>19h</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>20</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>21</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>22h</th>
<?php
$select = 'SELECT "public".v_voiture.num_voiture, "public".v_voiture."min", "public".v_voiture."max" FROM "public".v_voiture ';
$Services = pg_query($connectAff, $select) or die('Error in query procedural --> ' . pg_last_error());
$total = pg_num_rows($Services);
if ($total) {
$i = 0;
    while ($row = pg_fetch_array($Services)) {
        echo '<tr>';
        echo '<td  class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["num_voiture"] . '<br>' . $row["min"] . '-' . $row["max"] . '</td>';
            echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
    }
}
?>
					</tbody>
				</table>
                <table>
					<colgroup>
						<col width="100"/>
						<col width="100"/>
						<col width="100"/>
					</colgroup>
					<tbody>
						<tr>
                            <td>

<?php
$selectVehi = 'SELECT vehicules.vehicule.parc_keolis FROM vehicules.vehicule';
$ServicesVehi = pg_query($connectVehi, $selectVehi) or die('Error in query procedural --> ' . pg_last_error());
$totalVehi = pg_num_rows($ServicesVehi);
if ($totalVehi) {
    while ($rowvehi = pg_fetch_array($ServicesVehi)) {
        echo '<div id="resizable" class="redips-drag ui-widget-content" style="width: 695px, position: relative">'.$rowvehi["parc_keolis"].'</div>';
    }
}
?>							</td>
                            <td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</center>
	</body>
</html>
