<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");

set_time_limit(0);

date_default_timezone_set('America/New_York');
$mysqli = new mysqli('localhost', 'username', 'password', 'xcl');

include '../../api.xwis.co.uk/inc/scrape.php';

$game = @$_GET['game'];
if (empty($game)) $game = 'ra2';

$html = scrape('http://xwis.net/'. $game .'/hall-of-fame/');
preg_match_all('/<table align=center>(.*?)<\/table><\/table>/', $html, $dates);

// printf('<pre>%s</pre>', print_r($dates, 1));

foreach($dates[0] as $date) {
	preg_match('/<th colspan=99>(.*?)</', $date, $d);
	//printf('<pre>%s</pre>', print_r($d, 1));
	// $d[1]; //date

	preg_match_all('/<table>(.*?)<\/table>/', $date, $hof);
	//printf('<pre>%s</pre>', print_r($hof, 1));
	$stats = array();
	foreach($hof[0] as $table) {
		preg_match_all('/<td align=right>(?P<rank>\d{1,2})<td><a href="\.\.\/(?P<type>players|clans)\/(?P<player>[\w-\.\*\!@]{2,9})\/">/', $table, $players);
		// printf('<pre>%s</pre>', print_r($players, 1));
		foreach($players['rank'] as $k => $v) $stats[] = (object)array('rank' => $v, 'type' => $players['type'][$k], 'player' => $players['player'][$k]);
	}
	echo '<h1>', $d[1],'</h1>';
	//printf('<pre>%s</pre>', print_r($stats, 1));
	foreach($stats as $stat) {
		$lid = lid($stat->type);
		if ($stat->type == 'players') {
			$pid = player($stat->player, $lid);
			$q = sprintf('INSERT INTO xcl_hof (rank, pid, lid, date) VALUES (%d, %d, %d, "%s")', 
						$stat->rank, $pid, $lid, $d[1]);
			$mysqli->query($q);
		} else {
			$cid = clan($stat->player, $lid);
			$q = sprintf('INSERT INTO xcl_hof (rank, cid, lid, date) VALUES (%d, %d, %d, "%s")', 
						$stat->rank, $cid, $lid, $d[1]);
			$mysqli->query($q);
		}
	}
}

function lid($type) {
	global $game;
	$lid = 0;
	if ($type == 'players') {
		if ($game == 'ts') $lid = 1;
		else if ($game == 'ra2') $lid = 3;
		else $lid = 5;
	} else {
		if ($game == 'ts') $lid = 7;
		else if ($game == 'ra2') $lid = 8;
		else $lid = 9;
	}
	return $lid;
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

function clan($name, $lid) {
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
	} 
	$result->close();

	return (int)$cid;
}

$mysqli->close();