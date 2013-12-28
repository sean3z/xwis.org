<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

date_default_timezone_set('America/New_York');
$mysqli = new mysqli('localhost', 'username', 'password', 'xcl');

$game = 'ts';
$title = 'Tiberian Sun';
$gid = 0;
$xcl_gid = 0;
if (!empty($_GET['game'])) $game = $_GET['game'];
if (!empty($_GET['gid'])) $gid = $_GET['gid'];

if ($game == 'ra2') {
	$title = 'Red Alert 2';
} else if ($game == 'yr') {
	$title = 'Yuri\'s Revenge';
}

?><!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo $title; ?> game <?php echo $gid; ?> | Command &amp; Conquer Multiplayer Online</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" href="assets/css/foundation.min.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/jquery.rondell.min.css" />
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
			.oosy { padding: 5px; text-transform: uppercase; background-color: rgba(255, 0, 0, 0.3); color: white; font-size: 1.3em; text-shadow: 1px 0px #bdbdbd; }
			a.link:hover {
				color: #222;
			}
			a.link {
				color: #c6c6c6;
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
							<li class="unavailable"><a href="#">Game</a></li>
							<li class="current"><a href="#">Game ID: <?php echo $gid; ?></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div>
				
					
				<?php 
					if ($gid < 1) die('<h2>Game not found</h2>');
					$query = sprintf('SELECT g.*, m.name as map FROM xcl_games g INNER JOIN xcl_maps m USING(mid) WHERE g.gid = %d', $gid);
					if ($result = $mysqli->query($query)) {
						if ($result->num_rows < 1) {
							die('<div class="row"><div class="large-8 column"><h2>Game not found</h2></div></div>');
						} else {	
							$match = new stdClass();
							while($row = $result->fetch_object()) $match = $row;

							if ($match->oosy > 0) echo '<div class="row" style="margin-bottom: 15px;"><div class="large-12 column"><div class="oosy">Game Out of Sync</div></div></div>';
							$xcl_gid = $match->xcl_gid;
							echo '<div class="row"><div class="large-8 column"><h4>Game ID: ', $gid ,'</h4>';
							

							$stats = array();
							$resolutions = array();
							$query = sprintf('CALL GameByWS_GID(%d)', $match->ws_gid);
							$players = 0;
							if ($r = $mysqli->query($query)) {
								while($rr = $r->fetch_object()) {
									$players++;
									$resolutions[$rr->Resolution][] = $rr;
									$stats[] = $rr;
								}
								$r->free();
								$mysqli->next_result();
							}
						}
					}
				?>
						
							<?php 
							if (!empty($resolutions)) {
								// printf('<pre>%s</pre>', print_r($resolutions, 1)); 
								if (!isset($resolutions['Won']) || !isset($resolutions['Won'][0])) {
									$resolutions['Won'][] = mockPlayer();
								}

								if (!isset($resolutions['Lost']) || !isset($resolutions['Lost'][0])) {
									$resolutions['Lost'][] = mockPlayer();
								}

								$teamA = 'Team A';
								if (count($resolutions['Won']) == 1) $teamA = '<a href="player.php?game='.$game.'&player='.$resolutions['Won'][0]->name.'" class="link">'. $resolutions['Won'][0]->name .'</a>';
								if (count($resolutions['Won']) > 0 && !empty($resolutions['Won'][0]->clan))  {
									$teamA = '<a href="clan.php?game='. $game.'&clan='. $resolutions['Won'][0]->clan.'" class="link">Clan '. $resolutions['Won'][0]->clan .'</a>';
								}

								$teamB = 'Team B';
								if (count($resolutions['Lost']) == 1) $teamB = '<a href="player.php?game='.$game.'&player='.$resolutions['Lost'][0]->name.'" class="link">'. $resolutions['Lost'][0]->name .'</a>';
								if (count($resolutions['Lost']) > 0 && !empty($resolutions['Lost'][0]->clan))  {
									$teamB = '<a href="clan.php?game='. $game.'&clan='. $resolutions['Lost'][0]->clan.'" class="link">Clan '. $resolutions['Lost'][0]->clan .'</a>';
								}

								$showTitle = true;
								if (count($resolutions['Won']) == 1 && count($resolutions['Lost']) == 1) {
									$showTitle = false;
								}

								if (in_array($match->lid, array(7,8,9))) $showTitle = true;

								echo '<table style="width:100%;"><tr>';
								echo '<td style="font-size:110%;line-height:normal;vertical-align:top;">';
								if ($showTitle) echo '<div style="text-transform: uppercase;font-size: 70%;">', $teamA,'</div>';
								foreach($resolutions['Won'] as $k => $player) {
									echo '<div>
											<span style="width:5px;background:', color($player->col),';">&nbsp;</span>
											<img src="assets/img/faction/icons/', $player->cty,'.png">
											<a href="player.php?game=',$game,'&player=',$player->name,'" class="link">', $player->name ,'</a> 
											', ($player->PointsChanged > 0 ? '<small>(<span style="color:green;">+'. $player->PointsChanged .'</span>)</small>' : '') ,'
										</div>';
								}
								echo '<div style="text-transform: uppercase;font-size: 70%;">WINNER</div>';
								echo '</td>
										<td class="text-center" style="background: rgba(31, 30, 30, 0.5);">
											<div style="font-size:100%;text-transform: uppercase;">defeated</div>
										</div>
										<td class="text-right" style="font-size:110%;line-height:normal;vertical-align:top;">';

								if ($showTitle) echo '<div style="text-transform: uppercase;font-size: 70%;">', $teamB,'</div>';
								foreach($resolutions['Lost'] as $k => $player) {
									echo '<div>
											', ($player->PointsChanged > 0 ? '<small>(<span style="color:red;">-'. $player->PointsChanged .'</span>)</small>' : '') ,'
											<a href="player.php?game=',$game,'&player=',$player->name,'" class="link">', $player->name ,'</a>
											<img src="assets/img/faction/icons/', $player->cty,'.png">
											<span style="width:5px;background:', color($player->col),';">&nbsp;</span>
										</div>';
								}
								echo '<div style="text-transform: uppercase;font-size: 70%;">LOSER</div>';
								echo '</td></tr></table>';

							}
							
							?>
				
						<div style="margin-top: 30px;">
						<?php 
							if (!empty($resolutions)) {
								echo '<h4>';
								if (count($resolutions['Won']) > 1 || count($resolutions['Lost']) > 1) echo 'Group ';
								echo 'Performance</h4>';

								$win_counts = array();
								foreach($resolutions['Won'] as $k => $player) {
									foreach($player as $obj => $value) {
										@$win_counts[$obj] += $value;
									}
								}
								//printf('<pre>%s</pre>', print_r($win_counts, 1));

								$loss_counts = array();
								foreach($resolutions['Lost'] as $k => $player) {
									foreach($player as $obj => $value) {
										@$loss_counts[$obj] += $value;
									}
								}
								//printf('<pre>%s</pre>', print_r($loss_counts, 1));
							}
						?>
						<table style="width:100%;">
							<tr><th><?php echo $teamA; ?><th><th class="text-right"><?php echo $teamB; ?></tr>
							<tr>
								<td><?php echo $win_counts['BuildingsBuilt']; ?>
								<td class="text-center">Construction
								<td class="text-right"><?php echo $loss_counts['BuildingsBuilt']; ?>
							</tr>

							<tr>
								<td><?php echo $win_counts['InfantryBuilt'] + $win_counts['UnitsBuilt'] + $win_counts['PlanesBuilt']; ?>
								<td class="text-center">Production
								<td class="text-right"><?php echo $loss_counts['InfantryBuilt'] + $loss_counts['UnitsBuilt'] + $loss_counts['PlanesBuilt']; ?>
							</tr>

							<tr>
								<td><?php echo $win_counts['InfantryKilled'] + $win_counts['UnitsKilled'] + $win_counts['PlanesKilled'] + $win_counts['BuildingsKilled']; ?>
								<td class="text-center">Destruction
								<td class="text-right"><?php echo $loss_counts['InfantryKilled'] + $loss_counts['UnitsKilled'] + $loss_counts['PlanesKilled'] + $loss_counts['BuildingsKilled']; ?>
							</tr>

							<tr>
								<td><?php echo $win_counts['InfantryLeft'] + $win_counts['UnitsLeft'] + $win_counts['PlanesLeft'] + $win_counts['BuildingsLeft']; ?>
								<td class="text-center">Remains
								<td class="text-right"><?php echo $loss_counts['InfantryLeft'] + $loss_counts['UnitsLeft'] + $loss_counts['PlanesLeft'] + $loss_counts['BuildingsLeft']; ?>
							</tr>

							<tr>
								<td><?php echo ceil(($win_counts['InfantryLeft'] + $win_counts['UnitsLeft'] + $win_counts['PlanesLeft'] + $win_counts['BuildingsLeft'] + $win_counts['InfantryLeft'] + $win_counts['UnitsLeft'] + $win_counts['PlanesLeft'] + $win_counts['BuildingsLeft'] + $win_counts['InfantryBuilt'] + $win_counts['UnitsBuilt'] + $win_counts['PlanesBuilt'] + $win_counts['BuildingsBuilt'])/12) * 100; ?>
								<td class="text-center">Economy
								<td class="text-right"><?php echo ceil(($loss_counts['InfantryLeft'] + $loss_counts['UnitsLeft'] + $loss_counts['PlanesLeft'] + $loss_counts['BuildingsLeft'] + $loss_counts['InfantryKilled'] + $loss_counts['UnitsKilled'] + $loss_counts['PlanesKilled'] + $loss_counts['BuildingsKilled'] + $loss_counts['InfantryBuilt'] + $loss_counts['UnitsBuilt'] + $loss_counts['PlanesBuilt'] + $loss_counts['BuildingsBuilt'])/12) * 100; ?>
							</tr>
							
						</table>
						</div>

						<div style="margin-top: 30px;">
							<?php
								if (!empty($stats)) {
									 include_once 'inc/game/competitive.phtml';
									/*
									if (in_array($game->lid, array(1,3,5))) include_once 'inc/game/competitive.phtml';
									else if (in_array($game->lid, array(2,4,6))) include_once 'inc/game/casual.phtml';
									else if (in_array($game->lid, array(7,8,9)))  include_once 'inc/game/clan.phtml';
									*/
								}
							?>
						</div>

					</div>
					<div class="large-4 column">
						<h4>Match Details</h4>
						<table style="width: 100%;margin-bottom:0;">
						<?php
							$type = 'Competitive';
							if (in_array($match->lid, array(2,4,6))) { $type = 'Casual'; }
							else if (in_array($match->lid, array(7,8,9))) { $type = 'Clan'; }

							echo '	<tr><td>Game Type:</td><td>', $type,'</td></tr>
									<tr><td>Duration:</td><td>', gmdate('H:i:s', $match->dura),'</td></tr>
									<tr><td>Crates:</td><td>', ($match->crat > 0 ? 'On' : 'Off'),'</td></tr>
									<tr><td>Out of Sync:</td><td>', ($match->oosy > 0 ? 'Yes' : 'No'),'</td></tr>
									<tr><td>Average FPS:</td><td>', $match->afps,'</td></tr>
									<tr><td>Map:</td><td>', $match->map,'</td></tr>
									<tr><td>Date:</td><td>', date('F j, Y g:i a', $match->mtime),' EST</td></tr>';

							//printf('<pre>%s</pre>', print_r($match, 1));
						?>
						</table>
						<span class="right" style="font-size:80%;"><a href="http://xwis.net/<?php echo $game; ?>/games/<?php echo $xcl_gid; ?>/" target="_blank">View original on XWIS</a></span>
						<div class="clear:both;" style="margin-bottom: 20px;"></div>
						<?php
							$q = sprintf('SELECT * FROM xcl_screenshots WHERE gid = %d', $gid);
							if ($r = $mysqli->query($q)) {
								if ($r->num_rows > 0) {
									echo '<h4>Screenshots</h4>
									<div class="rondell">';
									while($row = $r->fetch_object()) {
										echo '<img src="http://xwis.net/', $game,'/screenshots/', $row->ssid,'/">';
									}
									echo '</div>';
								}
							}
						?>
					</div>
				</div>

				<div class="row">
					<div class="large-8 column">
						<div style="margin-top: 30px;">
							<h4>Comments</h4>
							   <div id="disqus_thread"></div>
							    <script type="text/javascript">
							        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
							        var disqus_shortname = 'xwis'; // required: replace example with your forum shortname
							        var disqus_identifier = 'gid<?php echo $gid; ?>'; //a unique identifier for each page where Disqus is present

							        /* * * DON'T EDIT BELOW THIS LINE * * */
							        (function() {
							            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
							            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
							            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
							        })();
							    </script>
							    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
							    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
						</div>
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
		<script src="assets/js/jquery.rondell.min.js"></script>
		<script>
			$(document).foundation();
			$('.rondell').rondell({
				visibleItems: 0,
				lightbox: {
					enabled: true,
					displayReferencedImages: true,
				},
				size: {
					width: 396
				},
				center: {
					left: 200,
					top: 100
				},
				autoRotation: {
					enabled: true,
					direction: 1,
					once: false
				}
			});
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

function color($col) {
	$c = 'rgb(221, 221, 221)';
	switch($col) {
		case 1: $c = '#dee308'; break;
		case 2: $c = '#ff1818'; break;
		case 3: $c = '#2975e7'; break;
		case 4: $c = '#39d329'; break;
		case 5: $c = '#ffa218'; break;
		case 6: $c = '#31d7e7'; break;
		case 7: $c = '#9428bd'; break;
		case 8: $c = '#ff9aef'; break;
	}

	return $c;
}

function mockPlayer() {
	return (object)array(
		'name' => 'Unknown', 
		'clan' => '',
		'PointsChanged' => 0,
		'cty' => 1,
		'col' => 0,
		'InfantryBuilt' => 0,
		'UnitsBuilt' => 0,
		'PlanesBuilt' => 0,
		'BuildingsBuilt' => 0,
		'InfantryLeft' => 0,
		'UnitsLeft' => 0,
		'PlanesLeft' => 0,
		'BuildingsLeft' => 0,
		'InfantryKilled' => 0,
		'UnitsKilled' => 0,
		'PlanesKilled' => 0,
		'BuildingsKilled' => 0,
		'BuildingsCaptured' => 0
	);
}