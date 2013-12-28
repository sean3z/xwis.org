<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

date_default_timezone_set('America/New_York');
$mysqli = new mysqli('localhost', 'username', 'password', 'xcl');

$game = 'ts';
$title = 'Tiberian Sun';
$clan = '';
$lid = 7;
if (!empty($_GET['game'])) $game = $_GET['game'];
if (!empty($_GET['clan'])) $clan = $_GET['clan'];

$clan = $mysqli->escape_string($clan);

if ($game == 'ra2') {
	$lid = 8;
	$title = 'Red Alert 2';
} else if ($game == 'yr') {
	$lid = 9;
	$title = 'Yuri\'s Revenge';
}

?><!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo $title; ?> clan <?php echo $clan; ?> | Command &amp; Conquer Multiplayer Online</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" href="assets/css/foundation.min.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/dark.css" />
		<script src="assets/js/vendor/modernizr.js"></script>
		<script src="assets/js/vendor/jquery.js"></script>
		<script src="assets/js/highcharts.js"></script>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
		<style type="text/css">
			.row { max-width: 80rem; }
			footer { 
				background: #333;
				padding: 25px;
				color: white; 
				font-size: 0.875em;
				margin-top: 45px;
			}
			body, h1, h2, h3, h4, h5, h6, p, span, div, td, th, a, li {
				font-family: 'Open Sans', sans-serif !important;
			}
			.hero ul li:hover {
				background: rgba(0,0,0,0.15);
			}
			.hero ul li a { color: #fff; text-transform: uppercase; font-size: 0.80em; }
			.bg { 
				background-position: center top;
				background-repeat: no-repeat;
				background-size: cover;
				height: 170px;
				padding: 0 15px 0 15px;
				position: relative;
				z-index: 2; 
			}
			.number {
				float: right;
				text-align: right;
				border-right: 1px solid rgba(255,255,255,.5);
				font-size: 14px;
				padding: 0 21px;
			}
			.info_members .number:first-child {
				border-right: 0;
			}
			.info_members .number span:first-child {
				display: block;
				font-size: 34px;
				font-weight: 100;
				line-height: 1;
			}
		</style>
	</head>
	<body>
		
		<nav class="top-bar" data-topbar role="navigation">
			<ul class="title-area">
				<li class="name">
					<h1><a href="/"><img src="assets/img/logo.png" /></a></h1>
				</li>
			</ul>
			<section class="top-bar-section">
				<ul class="right">
					<li class="divider"></li>
					<li class="has-dropdown not-click">
						<a href="#">Game Ladders</a>
						<ul class="dropdown">
							<li><a href="ladder.php?game=ts&mode=casual">Tiberian Sun</a></li>
							<li><a href="ladder.php?game=ra2">Red Alert 2</a></li>
							<li><a href="ladder.php?game=yr&mode=casual">Yuri's Revenge</a></li>
						</ul>
					</li>
					<li class="divider"></li>
					<li><a href="support.html"><i class="fa fa-support fa-lg"></i> Support</a></li>
					<li class="divider"></li>
					<li><a href="downloads.html"><i class="fa fa-download fa-lg"></i> Downloads</a></li>
					<li class="divider"></li>
					<li><a href="http://xwis.net/forums/"><i class="fa fa-comment-o fa-lg"></i> Community</a></li>
					<li class="divider"></li>
					<li class="has-form">
						<a href="play.php" class="small button">Play now</a>
					</li>
				</ul>
			</section>
		</nav>

		<section role="main">
			<?php
				$bg = 3; if ($game == 'ra2') $bg = 2; else if ($game == 'yr') $bg = 4;
			?>
			<div class="hero hide-for-small" style="background: url(assets/img/hero/<?php echo $bg; ?>.jpg) no-repeat center center; height: 150px;">
				<div style="background: rgba(51,51,51,0.5) !important; height: 45px;"> 
					<div class="row">
						<div class="large-8 column">
							<img src="assets/img/emblems/<?php echo $game; ?>.png" style="height: 125px; margin-top: 12px; position: absolute;" />
						</div>
						<div class="large-4 column">
							<ul class="inline-list right">
								<li style="padding: 12.5px;"><a href="ladder.php?game=<?php echo $game; ?>" style="font-weight: bold;">Competitive</a></li>
								<li style="padding: 12.5px;"><a href="ladder.php?game=<?php echo $game; ?>&mode=casual" style="font-weight: bold;">Casual</a></li>
								<li style="padding: 12.5px;"><a href="ladder.php?game=<?php echo $game; ?>&mode=clan" style="font-weight: bold;">Clan</a></li>
								<li style="padding: 12.5px;"><a href="hof.php?game=<?php echo $game; ?>" style="font-weight: bold;">HOF</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div style="padding: 30px 0 0 0;">
				<div class="row">
					<div class="large-12 column">
						<ul class="breadcrumbs">
							<li><a href="/">Home</a></li>
							<li><a href="ladder.php?game=<?php echo $game; ?>"><?php echo $title; ?></a></li>
							<li class="unavailable"><a href="#">Clans</a></li>
							<li class="current"><a href="#"><?php echo $clan; ?></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div>
				<div class="row">
					<div class="large-12 column">
						<?php
						$cid = 0;
						$q = sprintf('SELECT * FROM xcl_clans c INNER JOIN xcl_clans_ladder l USING(cid) WHERE c.lid = %d and c.name = "%s"', $lid, $clan);
						if ($result = $mysqli->query($q)) {
							if ($result->num_rows < 1) {
								die('<h1>Clan not found</h1>');
							} else {
								$stats = new stdClass();
								while($row = $result->fetch_object()) $stats = $row;

								if (isset($stats->cid)) $cid = $stats->cid;

								if ($cid > 0) {
									// grab players
									$players = array();
									$q = sprintf('SELECT p.pid, l.* FROM xcl_clans_players p INNER JOIN xcl_players l USING(pid) WHERE p.cid = %d', $cid);
									if ($r = $mysqli->query($q)) {
										if ($r->num_rows > 0) {
											while($rr = $r->fetch_object()) $players[] = $rr;
										}
									}
								}

								// printf('<pre>%s</pre>', print_r($stats, 1));
								// printf('<pre>%s</pre>', print_r($players, 1));
							}
						}
						?>
						<div class="bg" style="background-image: url(assets/img/banners/group_top_banner.jpg);
background-image: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0,0,0,0.3) 100%), url(assets/img/banners/group_top_banner.jpg);
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.3))), url(assets/img/banners/group_top_banner.jpg);
background-image: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.3) 100%), url(assets/img/banners/group_top_banner.jpg);
background-image: -o-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.3) 100%), url(assets/img/banners/group_top_banner.jpg);
background-iamge: -ms-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.3) 100%), url(assets/img/banners/group_top_banner.jpg);
background-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.3) 100%), url(assets/img/banners/group_top_banner.jpg);">
							<div class="info_members" style="float: right;position: relative;width: 50%;height: 100%;min-width: 400px;">
								<div class="numbers" style="position: absolute;bottom: 18px;right: 0;color: #fff;">
									<div class="number">
										<span><?php echo ($stats->points < 0 ? 0 : $stats->points); ?></span>
										<span>Points</span>
									</div>
									<div class="number">
										<span><?php echo $stats->win_count; ?></span>
										<span>Wins</span>
									</div>
									<div class="number members">
										<span><?php echo count($players); ?></span>
										<span>Members</span>
									</div>
								</div>
							</div>

							<div style="float: left;width: 50%;height: 100%;min-width: 50%;">
								<div style="position: absolute;bottom: 15px;left: 15px;">
									<a href="/en/Clan/151350" style="width: 91px;height: 91px;display: inline-block;vertical-align: middle;margin-right: 15px;">
                   						<img id="groupAvatar" src="assets/img/avatars/028.png" alt="Group Avatar" data-value="70028" data-newvalue="" data-avatarpath="http://static01.bungie.net/img/profile/avatars/group/028.png?cv=998160813&amp;av=2215962399">
                					</a>
                					<div style="display: inline-block;vertical-align: middle;height: 91px;color: #fff;text-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);margin-bottom: 7px;">
                						<h2 style="color:#fff;margin-bottom:0"><?php echo $clan; ?></h2>
                						<p style="font-weight:200;font-size:1.3rem">"Our base is under attack!"</p>
                					</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="padding: 30px 0 0 0;">
					<div class="large-8 column">
					<?php
						$time = time();
						$query = sprintf('SELECT DISTINCT p.gid, g.mtime, p.cmp, p.pc, m.name as map FROM xcl_games_players p INNER JOIN xcl_games g USING(gid) INNER JOIN xcl_maps m USING(mid) WHERE p.cid = %d AND g.lid = %d ORDER BY p.gid DESC LIMIT 20', $cid, $lid);
						if ($result = $mysqli->query($query)) {
							if ($result->num_rows > 0) {
								echo '<h4>Match History</h4><table style="width: 100%;"><tr><th>Scenario</th><th>Type</th><th>Outcome</th><th class="hide-for-small">Date</th></tr>';
								while($row = $result->fetch_object()) {
									echo '<tr>
											<td><a href="game.php?game=', $game,'&gid=', $row->gid,'">', $row->map ,'</a></td>
											<td>Clan</td>
											<td>', ($row->cmp > 0 ? 'Win' : 'Loss') ,' ', ($row->pc > 0 ? '(<span style="color:'. ($row->cmp > 0 ? 'green' : 'red') .'">'. ($row->cmp > 0 ? '+' : '-') . $row->pc .'</span>)' : '' ) ,'</td>
											<td class="hide-for-small">', duration($time - $row->mtime, 1) ,'</td>
										</tr>';
								}
								echo '</table>';
							} else {
								echo '<p>No match history yet!</p>';
							}
						}
						?>
					</div>

					<div class="large-4 column">
						<h5>Contributors</h5>
						<table style="width:100%;margin-bottom:0;">
							<tr><th>Member<th>Wins<th>Losses<th>Points</tr>
							<?php
							foreach($players as $k => $player) {
								echo '<tr>
										<td><a href="player.php?game=', $game,'&player=', $player->name,'">', $player->name,'</a></td>
										<td>', $player->win_count,'</td>
										<td>', $player->loss_count,'</td>
										<td>', ($player->points < 1 ? 0 : $player->points),'</td>
									</tr>';
								//printf('<pre>%s</pre>', print_r($players, 1));
							}
							?>
						</table>
						<?php
						if ($cid > 0) {
							$query = sprintf('SELECT * FROM xcl_hof WHERE cid = %d ORDER BY rank ASC', $cid);
							if ($r = $mysqli->query($query)) {
								if ($r->num_rows > 0) {
									echo '<div style="background-color:#444;padding: 10px;margin-top: 15px;"><h5>Hall of Fame <small style="color:#d5d5d5;">(', $r->num_rows,'x)</small></h5><p style="margin-bottom:0;">';
									while($row = $r->fetch_object()) {
										if (@++$i > 5) break;
										$icon = 'runnerup.gif';
										if ($row->rank == 1) {
											$icon = 'gold.png';
										} else if ($row->rank == 2) {
											$icon = 'silver.png';
										} else if ($row->rank == 3) {
											$icon = 'bronze.png';
										}

										$date = strtotime($row->year .'-'. $row->month .'-01');
										echo '<img src="assets/img/ranks/hof/',$icon,'" style="height:15px;" /> Rank ', $row->rank ,' - ', date('F Y', $date) ,'<br />';
									}
									echo '</p><a class="right" style="font-size:80%;" href="hof.php?game=',$game,'">View all entires</a><div style="clear:both;"></div></div>';
								}
							}
						} ?>
					</div>
				</div>

				<div class="row">
					<div class="large-12 column">
						Are you the founder? <a href="#">Login now</a> to update this page! 
					</div>
				</div>
			</div>
		</section>


		<footer>
			<div class="row">
				<div class="large-2 column">
					<a href="support.html">Support FAQ</a><br />
					<a href="http://xwis.net/forums/">Community Forums</a><br />
					<a href="downloads.html">Game Downloads</a><br />
				</div>
				<div class="large-2 column">
					<a href="play.php">Getting Started</a><br />
					<a href="http://xwis.net/ga">XWIS Game Account</a><br />
					<a href="contact.html">Contact Us</a><br />
				</div>
				<div class="large-2 column">
					<a href="ladder.php?game=ts&mode=casual">Tiberian Sun Ladder</a><br />
					<a href="ladder.php?game=ra2">Red Alert 2 Ladder</a><br />
					<a href="ladder.php?game=yr&mode=casual">Yuri's Revenge Ladder</a><br />
				</div>
				<div class="large-6 column" style="text-align: right;">
					<i class="fa fa-facebook-square fa-2x"></i> <i class="fa fa-twitter-square fa-2x"></i><br />
					&copy; 2014 XWIS
				</div>
			</div>
		</footer>
	
		<script src="assets/js/foundation.min.js"></script>
		<script>
			$(document).foundation();
		</script>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-28566414-4', 'auto');
  ga('send', 'pageview');

</script>
	</body>
</html>
<?php
$mysqli->close();

function duration($seconds, $max_periods) {
    $periods = array('year' => 31536000, 'month' => 2419200, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1);
    $i = 1;
    foreach ( $periods as $period => $period_seconds ) {
        $period_duration = floor($seconds / $period_seconds);
        $seconds = $seconds % $period_seconds;
        if ( $period_duration == 0 ) continue;
        $duration[] = $period_duration .' '. $period . ($period_duration > 1 ? 's' : '');
        $i++;
        if ( $i > $max_periods ) break;
    }
    if (is_null($duration)) return 'just now';
    return implode(' ', $duration) .' ago';
}