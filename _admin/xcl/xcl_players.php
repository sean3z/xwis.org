<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

date_default_timezone_set('America/New_York');
$mysqli = new mysqli('localhost', 'username', 'password', 'xcl');

$lid = 5;
$game = 'yr';

$json = @json_decode(file_get_contents('http://api.xwis.co.uk/ladder.php?game='. $game));
if (!empty($json)) {
	foreach((array)$json as $rank => $node) {
		$query = sprintf('SELECT pid FROM xcl_players WHERE name = "%s" AND lid = %d', $node->nick, $lid);
		if ($result = $mysqli->query($query)) {
			if ($result->num_rows < 1) {
				$q = sprintf('INSERT INTO xcl_players (name, win_count, loss_count, games_count, points, countries, lid, mtime) 
						VALUES ("%s", %d, %d, %d, %d, %d, %d, %d)', 
						$node->nick, $node->wins, $node->losses, $node->total_games, $node->points, $node->factions, $lid, time());

				$mysqli->query($q);
			} else {
				while($row = $result->fetch_object()) {
					$pid = $row->pid;

					$q = sprintf('UPDATE xcl_players SET win_count = %d, loss_count = %d, games_count = %d, points = %d, countries = %d, mtime = %d
								WHERE pid = %d AND lid = %d',
								$node->wins, $node->losses, $node->total_games, $node->points, $node->factions, time(), $pid, $lid);
					$mysqli->query($q);
					break;
				}
			}
		}
	}
}

$mysqli->close();
