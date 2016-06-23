<?php
$i=0;
$connect = pg_connect("host=192.168.207.22 dbname=vehicules user=postgres password=postgres");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="../header.js"></script>
		<script type="text/javascript" src="../redips-drag-min.js"></script>
		<title>Affectation V0.1 - 26/01/16</title>
	</head>
	<body onload="REDIPS.drag.init()">
		<center>
			<!-- tables inside this DIV could contain drag-able content  -->
			<div id="redips-drag">
				<table>
					<colgroup>
										<?php
while ($i != 70) {
    echo "<col width='100'/>";
    $i++;
}
?>
					</colgroup>
					<tbody>
                        <th>BUS</th>
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
$select = 'SELECT parc_keolis FROM vehicules.vehicule ORDER BY parc_keolis';
$vehicules = pg_query($connect, $select) or die('Error in query procedural --> ' . pg_last_error());
$total = pg_num_rows($vehicules);
if ($total) {
$i = 0;
    while ($row = pg_fetch_array($vehicules)) {
        echo '<tr>';
        echo '<td class="redips-mark" style="font-style: italic;text-align: center;font-weight: bold;">' . $row["parc_keolis"] . '</td>';
        while ($i != 69) {
            echo "<td></td>";
            $i++;
        }
        $i = 0;
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
							<td><div class="redips-drag" style="width: 695px">Service 201 (1h30)</div></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><div class="redips-drag" style="width: 895px">Service 404 (2h)</div></td>
							<td><div class="redips-drag">Hello World!</div></td>
							<td></td>
						</tr>
						<tr>
							<td><div class="redips-drag" style="width: 595px">Service 010 (1h15)</div></td>
							<td><div class="redips-drag">Hello World!</div></td>
							<td><div class="redips-drag">Hello World!</div></td>
						</tr>
					</tbody>
				</table>
			</div>
		</center>
	</body>
</html>