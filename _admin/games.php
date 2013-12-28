<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
set_time_limit(0);

date_default_timezone_set('America/New_York');
$mysqli = new mysqli('localhost', 'username', 'password', 'xcl');

$lid ='3,4,8';
if (isset($_GET['lid'])) $lid = $_GET['lid'];
$query = sprintf('SELECT g.*, m.name as map FROM xcl_games g INNER JOIN xcl_maps m USING(mid) WHERE g.lid IN (%s) ORDER BY g.xcl_gid DESC LIMIT 100', $lid);
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
<?php
echo '<table><th>GID<th>XCL GID<th>Scenario<th>FPS<th>Duration<th>C<th>S<th>T<th>Date';
if ($result = $mysqli->query($query)) {
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
				<td><a href="game.php?gid=', $row->gid, '">', $row->gid, '</a></td>
				<td>', $row->xcl_gid, '</td>
				<td>', $row->map, '</td>
				<td>', $row->afps, '</td>
				<td>', date('i:s', $row->dura), '</td>
				<td>', $row->crat, '</td>
				<td>', $row->oosy, '</td>
				<td>', $tourney ,'</td>
				<td>', date('M d Y H:i', $row->mtime), '</td>
			</tr>';
	}
}
echo '</table>';

$mysqli->close();