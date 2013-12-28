<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>XWIS | Command &amp; Conquer Multiplayer Online</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" href="assets/css/foundation.min.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
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
			body, h2, h3, h4, h5, h6, p, span, div, td, th, a, li {
				font-family: 'Open Sans', sans-serif !important;
			}
			.boxart { height: 190px; }
			@font-face {
				font-family: 'cnc';
				src: url('assets/fonts/cnc.eot');
				src: url('assets/fonts/cnc.ttf') format('truetype'),
					url('assets/fonts/cnc.svg') format('svg');
			}
			.cnc {
				color: #dfdfdf; 
				font-size: 3em; 
				font-family: 'cnc'; 
				padding-top: 180px; 
				font-weight: 200; 
				white-space: nowrap; 
				text-shadow: 3px 3px rgba(0, 0, 0, 0.5);
				text-transform: uppercase;
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
			<div class="hero hide-for-small" style="background: url(assets/img/hero/<?php echo rand(1,4); ?>.jpg) no-repeat center center; height: 500px;">
				<div class="row">
					<div class="large-6 column" style="width: 55%;">
						<h1 class="cnc">Command &amp; Conquer</h1>
						<p style="color: #dfdfdf; white-space: nowrap; text-shadow: 2px 2px #000;">
							Extensive online multiplayer powered by <strong>XWIS</strong> and officially sponsored by EA.<br />Keeping C&amp;C Classics alive.
						</p>
					</div>
				</div>
			</div>

			<div class="hero show-for-small" style="background: #efefef; color: #fff; padding: 40px;">
				<div class="row">
					<div class="small-12">
						C&amp;C Multiplayer
					</div>
				</div>
			</div>

			<div class="row" style="text-align: center; padding: 30px;">
				<div class="large-3 columns">
					<h3>Competitive</h3>
					<p><i class="fa fa-gamepad fa-2x"></i></p>
					<p style="font-size: 0.875em;">Compete against the most talented players from around the world in an effort to rule supreme. Participate in tournaments and competitions!</p>
					<!-- <p><a href="/" class="tiny button">Learn More</a></p> -->
				</div>
				<div class="large-3 columns">
					<h3 >Ladders</h3>
					<p><i class="fa fa-bar-chart-o fa-2x"></i></p>
					<p style="font-size: 0.875em;">Track your progress in real-time as you defeat enemies from across the globe! Progress to show your foes which Commander is most dominate.</p>
					<!-- <p><a href="/" class="tiny button">Learn More</a></p> -->
				</div>
				<div class="large-3 columns">
					<h3 >Community</h3>
					<p><i class="fa fa-comment-o fa-2x"></i></p>
					<p style="font-size: 0.875em;">Community powered. Visit the XWIS forums for the latest news and announcements, comprehensive strategies and multi-tier support.</p>
					<!-- <p><a href="/" class="tiny button">Learn More</a></p> -->
				</div>
				<div class="large-3 columns">
					<h3 >EA Sponsored</h3>
					<p><img src="assets/img/ealogo.png" style="height: 32px;" /></p>
					<p style="font-size: 0.875em;">Since 2005, XWIS has been officially sponsored by EA and is now the permanent home for most Westwood Studios online multiplayer games.</p>
					<!-- <p><a href="/" class="tiny button">Learn More</a></p> -->
				</div>
			</div>

			<div class="hide-for-small" style="background: #f6f6f6; padding: 30px; text-align: center;">
				<div class="row">
					<div class="large-12 column large-centered">
						<h4>Supported Games</h4>
						<ul class="inline-list">
							<li><img class="boxart"src="assets/img/boxart/td.jpg" /></li>
							<li><img class="boxart"src="assets/img/boxart/ra.jpg" /></li>
							<li><a href="ladder.php?game=ts"><img class="boxart"src="assets/img/boxart/ts.jpg" /></a></li>
							<li><a href="ladder.php?game=ra2"><img class="boxart"src="assets/img/boxart/ra2.jpg" /></a></li>
							<li><img class="boxart"src="assets/img/boxart/rg.jpg" /></li>
							<li class="show-for-large-up"><img class="boxart"src="assets/img/boxart/d2000.jpg" /></li>
							<li class="show-for-xlarge-up"><img class="boxart" src="assets/img/boxart/ebfd.jpg" /></li>
							<li class="show-for-xlarge-up"><img class="boxart"src="assets/img/boxart/nox.jpg" /></li>
						</ul>
					</div>
				</div>
			</div>

			<div style="padding: 30px; text-align: center;">
				<div class="row">
					<div class="large-6 column large-centered">
						<h6 style="text-transform: uppercase; font-size: 0.75em;">News and Announcements</h6>
						<p><h5><a href="http://xwis.net/forums/index.php/topic/180828-august-2014-hall-of-fame/">August 2014 Hall of Fame</a></h5><span style="font-size: 0.875em;">Posted By Olaf on 23 September 2014 - 08:42 AM</span></p>
						<p style="font-size: 0.875em;">The August 2014 Hall of Fame has now been finalized and badges have been awarded. Prize winners should PM ZigZag to indicate what title from the EA Origin catalog they'd like to have.  Don't forget to like/share our Facebook page and posts:</p>
					</div>
				</div>
			</div>

			<div style="background: #efefef; padding: 30px; display: none;">
				<div class="row">
					<div class="large-12 column">
						XWIS.net Tweets
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