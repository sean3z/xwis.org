<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

date_default_timezone_set('America/New_York');

$ws_gid = @(int)trim($_POST['ws_gid']);
if ($ws_gid < 1) $ws_gid = @(int)trim($_GET['ws_gid']);
?>
<style type="text/css">
	* { 
		font-size: 12px;
		font-family: Arial;
	}

	table td {
		border: 1px solid black;
		text-align: right;
		padding: 3px;
	}

	th {
		background-color: rgb(221, 221, 221);
	}
</style>
<form action="" method="post">
	<input type="text" name="ws_gid" value="<?php echo $ws_gid; ?>"><input type="submit" value="Search" /><br />
</form>
<?php
if ($ws_gid > 0) {
	$mysqli = new mysqli('localhost', 'username', 'password', 'xcl');
	$query = sprintf('SELECT g.*, m.name as map FROM xcl_games g INNER JOIN xcl_maps m USING(mid) WHERE g.ws_gid = %d', $ws_gid);
	if ($result = $mysqli->query($query)) {
		if ($result->num_rows > 0) {
			echo '<table>
				<tr><th>Scenario<th>Duration<th>Date<th>FPS<th>WS GID<th>XCL GID<th>C<th>S<th>T
				</tr>';
			while($row = $result->fetch_object()) {
				$tourney = 'FFG';
				switch($row->lid) {
					case 1:
					case 3:
					case 5:
						$tourney = 'P';
					break;

					case 7:
					case 8:
					case 9:
						$tourney = 'C';
				}
				echo '<tr>
					<td>', $row->map ,'</td>
					<td>', date('i:s', $row->dura) ,'</td>
					<td>', date('M d Y H:i', $row->mtime) ,'</td>
					<td>', $row->afps ,'</td>
					<td>', $row->ws_gid ,'</td>
					<td>', $row->xcl_gid ,'</td>
					<td>', $row->crat ,'</td>
					<td>', $row->oosy ,'</td>
					<td>', $tourney ,'</td>
				</tr>';
			}
			echo '</table><br />';
			$query = sprintf('CALL GameByWS_GID(%d)', $ws_gid);
			if ($result = $mysqli->query($query)) {
				if ($result->num_rows > 0) {
					echo '<table>';
					$stats = '';
					while($row = $result->fetch_object()) {
						echo '<tr><td>', $row->name, '<td>',  $row->Country,'<td>', $row->Resolution ,'<td>', ($row->cmp > 0 ? '+' : '-') . $row->PointsChanged;

						$stats .= '<tr><th>'. $row->name .'<th>killed<th>bought<th>left<th>captured
							<tr><td>units<td>'. $row->UnitsKilled.'<td>'. $row->UnitsBuilt. '<td>'. $row->UnitsLeft .'
							<tr><td>buildings<td>'. $row->BuildingsKilled.'<td>'. $row->BuildingsBuilt. '<td>'. $row->BuildingsLeft .'<td>'. $row->BuildingsCaptured.'
							<tr><td>infantry<td>'. $row->InfantryKilled.'<td>'. $row->InfantryBuilt. '<td>'. $row->InfantryLeft .'
							<tr><td>planes<td>'. $row->PlanesKilled.'<td>'. $row->PlanesBuilt. '<td>'. $row->PlanesLeft;
					}
					echo '</table><br /><table>'. $stats .'</table>';
				} 
			}
		} else {
			echo 'Game not found.';
		}
	}


	$mysqli->close();
}



