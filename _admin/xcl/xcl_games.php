<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");

set_time_limit(0);

date_default_timezone_set('America/New_York');
$mysqli = new mysqli('localhost', 'username', 'password', 'xcl');

// include '../api.xwis.co.uk/inc/scrape.php';
include '../../api.xwis.co.uk/inc/scrape.php';

$game = @$_GET['game'];
if (empty($game)) $game = 'ra2';

$html = scrape('http://xwis.net/'. $game .'/games/');
// $html = file_get_contents('../xwis.org/assets/img/xwis/xwis.html');

preg_match_all('/\.\.\/games\/(\d+)\//', $html, $games);

if (!empty($games) && isset($games[1])) {
	foreach(array_reverse($games[1]) as $gameId) {
		$json = @json_decode(file_get_contents('http://api.xwis.co.uk/game.php?game='. $game .'&gid='. $gameId));
		if (!empty($json) && !isset($json->status) && isset($json->gameId)) {
			if ((int)$json->gameId < 1) continue;
			$query = sprintf('SELECT gid FROM xcl_games WHERE ws_gid = %d', $json->gameId);
			if ($result = $mysqli->query($query)) {
				if ($result->num_rows > 0) continue;
			}

			$lid = 1;
			switch($json->tourney) {
				case 'clan':
					switch($game) {
						case 'ts': $lid = 7; break;
						case 'ra2': $lid = 8; break;
						case 'yr': $lid = 9; break;
					}
				break;

				case 'player':
					switch($game) {
						case 'ts': $lid = 1; break;
						case 'ra2': $lid = 3; break;
						case 'yr': $lid = 5; break;
					}
				break;

				default:
					switch($game) {
						case 'ts': $lid = 2; break;
						case 'ra2': $lid = 4; break;
						case 'yr': $lid = 6; break;
					}
			}

			$crates = ($json->crates == "true" ? 1 : 0);
			$oosy = ($json->syncfail == "true" ? 1 : 0);
			$mid = map($json->map, $lid);
			$dura = $json->dura;

			$q = sprintf('INSERT INTO xcl_games (lid, mid, dura, ws_gid, xcl_gid, afps, crat, oosy, mtime)
						VALUES (%d, %d, %d, %d, %d, %d, %d, %d, %d)',
						$lid, $mid, $dura, $json->gameId, $json->gid, $json->fps, $crates, $oosy, $json->timestamp);

			$mysqli->query($q);
			$gid = $mysqli->insert_id;
			$xcl_clans = array();
			if ((int)$gid > 0) {
				foreach((array)$json->players as $name => $player) {
					if (!empty($player)) {
						if (!isset($player->name)) continue 2;
						$pid = player($player->name, $lid);
						if ((int)$pid > 0) {
							$stats = $player->stats;
							$cmp = ($player->resolution == 'W' ? 1 : 0);
							$cty = country($player->country);

							$cid = 0;
							if ($player->clan != 'none' && $player->clan != '') $cid = clan($player->clan, $lid, $pid);
							if (!isset($xcl_clans[$player->resolution])) $xcl_clans[$player->resolution] = array($cid, $player->points_exchanged);

							$col = 0;
							if (isset($player->color)) $col = $player->color;

							$q = sprintf('INSERT INTO xcl_games_players (gid, pid, cmp, col, cty, pc, cid, inb, unb, plb, blb, inl, unl, pll, bll, ink, unk, plk, blk, blc, ipa, sid)
										VALUES (%d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d)',
										$gid, $pid, $cmp, $col, $cty, $player->points_exchanged, $cid,
										$stats->infantry->bought,
										$stats->units->bought,
										$stats->planes->bought,
										$stats->buildings->bought,
										$stats->infantry->left,
										$stats->units->left,
										$stats->planes->left,
										$stats->buildings->left,
										$stats->infantry->killed,
										$stats->units->killed,
										$stats->planes->killed,
										$stats->buildings->killed,
										$stats->buildings->captured,
										0, 0);
							$mysqli->query($q);

							// only update players ladder if not clan match - syke... can't do this. doesn't update teh pl4y3r in clan lids
							//if (!in_array($lid, array(7,8,9))) {
								$points = sprintf('win_count = win_count + 1, points = points + %d', $player->points_exchanged);
								if ($cmp < 1) $points = sprintf('loss_count = loss_count + 1, points = points - %d', $player->points_exchanged);
								$q = sprintf('UPDATE xcl_players SET games_count = games_count + 1, mtime = %d, oos_count = oos_count + %d, %s WHERE pid = %d', $json->timestamp, $oosy, $points, $pid);
								$mysqli->query($q);
							//}
							//die(sprintf('<pre>%s</pre>', print_r($player, 1)));
						}
					}
				}

				// update clan ladder if we have clan results
				if (!empty($xcl_clans) && in_array($lid, array(7,8,9)) && count($xcl_clans) == 2) {
					foreach($xcl_clans as $resolution => $results) {
						$points = sprintf('win_count = win_count + 1, points = points + %d', $results[1]);
						if ($resolution != 'W') $points = sprintf('loss_count = loss_count + 1, points = points - %d', $results[1]);
						$q = sprintf('UPDATE xcl_clans_ladder SET games_count = games_count + 1, mtime = %d, oos_count = oos_count + %d, %s WHERE cid = %d', $json->timestamp, $oosy, $points, $results[0]);
						$mysqli->query($q);
					}
				}

				// screenshots
				if (isset($json->screenshots)) {
					foreach($json->screenshots as $k => $v) {
						$q = sprintf('INSERT IGNORE INTO xcl_screenshots (gid, ssid) VALUES (%d, %d)', $gid, $v->id);
						$mysqli->query($q);
					}
				}

			}
		}
		
		//printf('<pre>%s</pre>', print_r($q, 1));
		//break;
	}
}

function map($name, $lid) {
	global $mysqli;
	$mid = 0;
	$query = sprintf('SELECT mid FROM xcl_maps WHERE name = "%s" AND lid = %d', $name, $lid);
	if ($result = $mysqli->query($query)) {
		if ($result->num_rows < 1) {
			$q = sprintf('INSERT INTO xcl_maps (name, lid) VALUES ("%s", %d)', $name, $lid);
			$mysqli->query($q);
			$mid = $mysqli->insert_id;
		} else {
			while($row = $result->fetch_object()) {
				$mid = $row->mid;
			}
		}
	} 
	$result->close();

	return (int)$mid;
}

function player($name, $lid) {
	global $mysqli;
	$pid = 0;
	$query = sprintf('SELECT pid FROM xcl_players WHERE name = "%s" AND lid = %d', $name, $lid);
	if ($result = $mysqli->query($query)) {
		if ($result->num_rows < 1) {
			$q = sprintf('INSERT INTO xcl_players (name, lid, mtime) VALUES ("%s", %d, %d)', $name, $lid, time());
			$mysqli->query($q);
			$pid = $mysqli->insert_id;
		} else {
			while($row = $result->fetch_object()) {
				$pid = $row->pid;
			}
		}
	} 
	$result->close();

	return (int)$pid;
}

function country($name) {
	global $mysqli;
	$fid = 0;
	$query = sprintf('SELECT fid FROM xcl_countries WHERE name = "%s"', $name);
	if ($result = $mysqli->query($query)) {
		if ($result->num_rows < 1) {
			$q = sprintf('INSERT INTO xcl_countries (name) VALUES ("%s")', $name);
			$mysqli->query($q);
			$fid = $mysqli->insert_id;
		} else {
			while($row = $result->fetch_object()) {
				$fid = $row->fid;
			}
		}
	} 
	$result->close();

	return (int)$fid;
}

function clan($name, $lid, $pid) {
	global $mysqli;
	$cid = 0;
	$query = sprintf('SELECT cid FROM xcl_clans WHERE name = "%s" AND lid = %d', $name, $lid);
	if ($result = $mysqli->query($query)) {
		if ($result->num_rows < 1) {
			$q = sprintf('INSERT INTO xcl_clans (name, lid, mtime) VALUES ("%s", %d, %d)', $name, $lid, time());
			$mysqli->query($q);
			$cid = $mysqli->insert_id;

			$q = sprintf('INSERT INTO xcl_clans_ladder (cid) VALUES (%d)', $cid);
			$mysqli->query($q);
		} else {
			while($row = $result->fetch_object()) {
				$cid = $row->cid;
			}
		}

		if ((int)$cid > 0) {
			$query = sprintf('INSERT IGNORE INTO xcl_clans_players (cid, pid) VALUES (%d, %d)', $cid, $pid);
			$mysqli->query($query);
		}
	} 
	$result->close();

	return (int)$cid;
}

function duration($str_time) {
	$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
	sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
	return $hours * 3600 + $minutes * 60 + $seconds;
}

$mysqli->close();

/*
UPDATE xcl_players p,
(SELECT DISTINCT p.pid, 
(SELECT COUNT(cmp) FROM xcl_games_players WHERE pid = p.pid AND cmp > 0) as win_count,
(SELECT COUNT(cmp) FROM xcl_games_players WHERE pid = p.pid AND cmp < 1) as loss_count,
(SELECT COUNT(cmp) FROM xcl_games_players WHERE pid = p.pid) as games_count,
(SELECT COUNT(gid) FROM xcl_games WHERE oosy > 0 AND gid IN(SELECT gid FROM xcl_games_players WHERE pid = p.pid)) as oos_count,
(SELECT SUM(pc) FROM xcl_games_players WHERE pid = p.pid AND cmp > 0) - (SELECT SUM(pc) FROM xcl_games_players WHERE pid = p.pid AND cmp < 1) as points
FROM `xcl_players` p) s
SET p.win_count = s.win_count,
p.loss_count = s.loss_count,
p.games_count = s.games_count,
p.oos_count = s.oos_count,
p.points = s.points
WHERE p.pid = s.pid;
*/