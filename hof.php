<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

date_default_timezone_set('America/New_York');
$mysqli = new mysqli('localhost', 'username', 'password', 'xcl');

$game = 'ts';
$title = 'Tiberian Sun';
if (!empty($_GET['game'])) $game = $_GET['game'];

$lids = '1,2,7';
if ($game == 'ra2') {
	$lids = '3,4,8';
	$title = 'Red Alert 2';
} else if ($game == 'yr') {
	$lids = '5,6,9';
	$title = 'Yuri\'s Revenge';
}

?><!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo $title; ?> Hall of Fame | Command &amp; Conquer Multiplayer Online</title>
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
			.hero ul li:hover,
			.hero ul li.active {
				background: rgba(0,0,0,0.15);
			}
			.hero ul li a { color: #fff; text-transform: uppercase; font-size: 0.80em; }
			.oosy { padding: 5px; text-transform: uppercase; background-color: rgba(255, 0, 0, 0.3); color: white; font-size: 1.3em; text-shadow: 1px 0px #bdbdbd; }
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
								<li style="padding: 12.5px;" class="active"><a href="hof.php?game=<?php echo $game; ?>" style="font-weight: bold;">HOF</a></li>
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
							<li class="current"><a href="#">Hall of Fame</a></li>
						</ul>
					</div>
				</div>
			</div>

			<div>
				<div class="row">
					<div class="large-12 column">
						<h4>Hall of Fame</h4>
						<?php
							$query = sprintf('SELECT * FROM xcl_hof WHERE lid IN (%s) ORDER BY year DESC', $lids);
							if ($result = $mysqli->query($query)) {
								while($row = $result->fetch_object()) $hof[] = $row;
								//printf('<pre>%s</pre>', print_r($hof, 1));
							}
						?>
						<p>Coming soon!</p>
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