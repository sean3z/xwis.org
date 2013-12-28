<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

date_default_timezone_set('America/New_York');

$lid = 1;
$game = 'ts';
$title = 'Tiberian Sun';
$mode = 'competitive';
if (!empty($_GET['game'])) $game = $_GET['game'];
if (!empty($_GET['mode'])) $mode = $_GET['mode'];
switch($game) {
	case 'yr': 
		$lid = 5; 
		if ($mode == 'clan') $lid = 9;
		else if ($mode == 'casual') $lid = 6;
		$title = 'Yuri\'s Revenge'; 
	break;

	case 'ra2': 
		$lid = 3; 
		if ($mode == 'clan') $lid = 8;
		else if ($mode == 'casual') $lid = 4;
		$title = 'Red Alert 2'; 
	break;

	default: 
		$lid = 1; 
		if ($mode == 'clan') $lid = 7;
		else if ($mode == 'casual') $lid = 2;
		$game = 'ts';
}
$mysqli = new mysqli('localhost', 'username', 'password', 'xcl');

?><!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo $title,' ', ucfirst($mode); ?> Leaderboard | Command &amp; Conquer Multiplayer Online</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" href="assets/css/foundation.min.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/dark.css" />
		<script src="assets/js/vendor/modernizr.js"></script>
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
			.hero ul li:hover,
			.hero ul li.active {
				background: rgba(0,0,0,0.15);
			}
			.hero ul li a { color: #fff; text-transform: uppercase; font-size: 0.80em; }
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
								<li style="padding: 12.5px;" <?php if ($mode == 'competitive') echo 'class="active"'; ?>>
									<a href="ladder.php?game=<?php echo $game; ?>" style="font-weight: bold;">Competitive</a>
								</li>
								<li style="padding: 12.5px;" <?php if ($mode == 'casual') echo 'class="active"'; ?>>
									<a href="ladder.php?game=<?php echo $game; ?>&mode=casual" style="font-weight: bold;">Casual</a>
								</li>
								<li style="padding: 12.5px;" <?php if ($mode == 'clan') echo 'class="active"'; ?>>
									<a href="ladder.php?game=<?php echo $game; ?>&mode=clan" style="font-weight: bold;">Clan</a>
								</li>
								<li style="padding: 12.5px;">
									<a href="hof.php?game=<?php echo $game; ?>" style="font-weight: bold;">HOF</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div style="padding-top: 30px;">
				<div class="row">
					<div class="large-12 column">
						<ul class="breadcrumbs">
							<li><a href="/">Home</a></li>
							<li><a href="#">Ladders</a></li>
							<li class="unavailable"><a href="#"><?php echo $mode; ?></a></li>
							<li class="current"><a href="#"><?php echo $title; ?></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div style="">
				<div class="row">
					<div class="large-12 column">
						
							<h4><?php echo ucfirst($mode); ?> Leaderboard</h4>
								<?php
									$time = time();
									$i = 0;
									$query = sprintf('SELECT p.* FROM xcl_players p WHERE p.lid = %d AND p.points > 0 AND p.games_count > 4 ORDER BY p.points DESC LIMIT 100', $lid);
									if ($mode == 'clan') {
										$query = sprintf('SELECT l.*, c.name from xcl_clans_ladder l INNER JOIN xcl_clans c USING(cid) WHERE c.lid = %d AND l.points > 0 AND l.games_count > 4 ORDER BY l.points DESC LIMIT 100', $lid);
									}

									if ($result = $mysqli->query($query)) {
										if ($result->num_rows > 0) {
											//<tr>',($result->num_rows > 24 ? '<th style="width: 69px;"></th>' : ''),'<th style="width: 20px;">Rank</th><th>Player</th><th>Points</th><th>Wins</th><th>Losses</th><th>Games</th><th>Ratio</th><th>Last Activity</th><th>Last 5 Games</th></tr>
											echo '<table style="width: 100%;">
													<thead>
														<tr><th style="width: 20px;">Rank</th><th>Player</th><th>Points</th><th>Wins</th><th>Losses</th><th>Games</th><th>Ratio</th><th>Last Activity</th><th>Last 5 Games</th></tr>
													</thead>';
											while ($row = $result->fetch_object()) {

												$stats = '';
												$cty = array();
												if ($mode == 'clan') {
													$q = sprintf('SELECT gid, cmp, cty FROM xcl_games_players WHERE cid = %d ORDER BY gid DESC LIMIT 5', $row->cid);
												} else {
													$q = sprintf('SELECT gid, cmp, cty FROM xcl_games_players WHERE pid = %d ORDER BY gid DESC LIMIT 5', $row->pid);
												}
												if ($r = $mysqli->query($q)) {
													while($rr = $r->fetch_object()) {
														@$cty[$rr->cty] += 1;
														$stats .= '<a href="game.php?game='. $game .'&gid='. $rr->gid.'"><span class="label '. ($rr->cmp > 0 ? 'success' : 'alert') .'"></span></a> ';
													}
												}

												$fid = (int)array_search(max($cty), $cty);
												// default the factionId if it's not found
												if ($fid < 1) {
													$fid = 3;
													if ($game == 'ts') $fid = 1;
												}
												$i++;
												echo '<tr>';
												/*
												if ($i == 1 && $result->num_rows > 24) {
													echo '<td rowspan="25" valign="top">
	<div style="background: url(assets/img/emblems/banner-wide.png) no-repeat -69px 0; width: 69px; height: 151px; padding-top:12px; text-align: center;">
	<span style="background: url(assets/img/emblems/grandmaster.png) no-repeat -100px -150px; width: 45px; height: 50px; display: inline-block;">
	</span>
	<span style="text-shadow: #fbcb66 0 0 10px; display: block; margin-top: 16px; color: #fff;">
		Top<br />
		<strong style="font-size: 30px; line-height: 100%;">25</strong>
	</span>
	</div></td>';
												} else if ($i == 26) {
													echo '<td rowspan="25" valign="top">
	<div style="background: url(assets/img/emblems/banner-wide.png) no-repeat 0 0; width: 69px; height: 151px; padding-top:12px; text-align: center;">
	<span style="background: url(assets/img/emblems/grandmaster.png) no-repeat -100px -100px; width: 45px; height: 50px; display: inline-block;">
	</span>
	<span style="text-shadow: #C1FFFF 0 0 10px; display: block; margin-top: 16px; color: #fff;">
		Top<br />
		<strong style="font-size: 30px; line-height: 100%;">50</strong>
	</span>
	</div></td>';
												} else if ($i == 51) {
													echo '<td rowspan="50" valign="top">
	<div style="background: url(assets/img/emblems/banner-wide.png) no-repeat 0 0; width: 69px; height: 151px; padding-top:12px; text-align: center;">
	<span style="background: url(assets/img/emblems/grandmaster.png) no-repeat -100px -50px; width: 45px; height: 50px; display: inline-block;">
	</span>
	<span style="text-shadow: #C1FFFF 0 0 10px; display: block; margin-top: 16px; color: #fff;">
		Top<br />
		<strong style="font-size: 30px; line-height: 100%;">100</strong>
	</span>
	</div></td>'; 
												} */
												$link = 'player.php?game='. $game .'&player='. $row->name;
												if ($mode == 'clan') {
													$link = 'clan.php?game='. $game .'&clan='. $row->name;
												}
												echo '	<td class="text-center">', $i,'</td>
														<td><img src="assets/img/faction/icons/', $fid ,'.png" style="height: 15px;" /> <a href="', $link,'">', $row->name ,'</a></td>
														<td class="text-right">', $row->points ,'</td>
														<td class="text-right">', $row->win_count ,'</td>
														<td class="text-right">', $row->loss_count ,'</td>
														<td class="text-right">', $row->games_count ,'</td>
														<td class="text-right">', round($row->win_count * 100 / $row->games_count) ,'%</td>
														<td class="text-right">', duration($time - $row->mtime, 1) ,'</td>
														<td class="text-center">', $stats ,'</td>
													</tr>';
											}
										} else {
											echo 'No games yet!';
										}
									}
								?>
							</table>
							<!-- <a href="#" class="button expand">Load More</a> -->
					
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
	
		<script src="assets/js/vendor/jquery.js"></script>
		<script src="assets/js/foundation.min.js"></script>
		<script>
			$(document).foundation();
			/*
			$(window).scroll(function(e){
			  parallax();
			});

			function parallax(){
				var scrolled = $(window).scrollTop();
				$('.hero').css('background-position','center ' + -(scrolled*0.35)+'px');
			}*/
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