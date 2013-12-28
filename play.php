<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

date_default_timezone_set('America/New_York');

?><!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>XWIS Play | Command &amp; Conquer Multiplayer Online</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" href="assets/css/foundation.min.css" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/css/dark.css" />
		<script src="assets/js/vendor/modernizr.js"></script>
        <script src="assets/js/vendor/jquery.js"></script>
        <script src="assets/js/highcharts.js"></script>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet" type="text/css">
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
			.hero ul li:hover {
				background: rgba(0,0,0,0.15);
			}
			.hero ul li a { color: #fff; text-transform: uppercase; font-size: 0.80em; }
            .cnc {
                color: #dfdfdf; 
                font-size: 3em; 
                font-weight: 700; 
                font-family: 'Ubuntu', sans-serif;
                white-space: nowrap; 
                text-shadow: 3px 3px rgba(0, 0, 0, 0.5);
                text-transform: uppercase;
            }

            #dsq-combo-recent h3,
            #dsq-combo-tabs,
            #dsq-combo-widget #dsq-combo-content div#dsq-combo-logo,
            #dsq-combo-widget #dsq-combo-content .dsq-widget-meta a:first-child {
                display: none !important;
            }

            #dsq-combo-widget.grey #dsq-combo-content .dsq-combo-box {
                background: transparent !important;
            }
            #dsq-combo-widget #dsq-combo-content .dsq-combo-avatar {
                height: 30px !important;
                width: 30px !important;
            }

            #dsq-combo-widget #dsq-combo-content ul, #dsq-combo-widget #dsq-combo-content li, #dsq-combo-widget #dsq-combo-content ol, #dsq-combo-widget #dsq-combo-content div, #dsq-combo-widget #dsq-combo-content p, #dsq-combo-widget #dsq-combo-content a, #dsq-combo-widget #dsq-combo-content cite, #dsq-combo-widget #dsq-combo-content img {
                font-size: 14px !important;
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
            <div class="hero hide-for-small" style="background: url(assets/img/hero/<?php echo rand(1,3); ?>.jpg) no-repeat center center; height: 150px;">
                <div class="row">
                    <div class="large-6 column" style="width: 55%;">
                        <h1 class="cnc">JOIN THE FIGHT</h1>
                        <p style="color: #dfdfdf; white-space: nowrap; text-shadow: 2px 2px #000;">
                            Command the battlefield and participate in the most exciting Real-Time Strategy encounters<br />Do you have what it takes?
                        </p>
                    </div>
                </div>
            </div>

			<div class="row" style="margin-top: 30px;">
				<div class="large-8 column">
                    <?php include_once 'inc/game/totalgraph.phtml'; ?>
				</div>

                <div class="large-4 column">
                    <h5>Recent Comments</h5>
                    <script type="text/javascript" src="http://xwis.disqus.com/combination_widget.js?num_items=5&hide_mods=0&default_tab=recent&excerpt_length=70"></script>
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