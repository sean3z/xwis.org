<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

date_default_timezone_set('America/New_York');
$mysqli = new mysqli('localhost', 'username', 'password', 'xcl');

$player = '';
$game = 'ts';
$title = 'Tiberian Sun';
if (!empty($_GET['game'])) $game = $_GET['game'];
if (!empty($_GET['player'])) $player = $_GET['player'];

$player = $mysqli->escape_string($player);

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
        <title><?php echo $title; ?> player <?php echo $player; ?> | Command &amp; Conquer Multiplayer Online</title>
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
            .hero ul li:hover {
                background: rgba(0,0,0,0.15);
            }
            .hero ul li a { color: #fff; text-transform: uppercase; font-size: 0.80em; }
            .panel { border: 0; background: transparent; }
            .accordion .accordion-navigation>.content, .accordion dd>.content {
                padding: 0;
            }

            .accordion .accordion-navigation>a, .accordion dd>a {
                padding: 5px;
                color: #efefef;
                font-weight: bold;
                background: #373737;
            }
            .accordion .accordion-navigation a,
            .accordion .accordion-navigation>a:hover, .accordion dd>a:hover,
            .accordion .accordion-navigation.active>a, .accordion dd.active>a {
                background: #252525;
            }

            .accordion .accordion-navigation>.content.active, .accordion dd>.content.active {
                background: none!important;
            }

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
                            <li class="unavailable"><a href="#">Player</a></li>
                            <li class="current"><a href="#"><?php echo $player; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div>
                <?php
                    if (empty($player)) {
                        die('<div class="row"><div class="large-12 column"><h2>Player not found.</h2></div></div>');
                    } else {
                        $pids = array();
                        $query = sprintf('SELECT * FROM xcl_players WHERE lid IN (%s) AND name = "%s"', $lids, $player);
                        if ($result = $mysqli->query($query)) {
                            if ($result->num_rows < 1) {
                                die('<div class="row"><div class="large-12 column"><h2>Player not found.</h2></div></div>');
                            } else {
                                $class = new stdClass();
                                $ladder = array('competitive' => $class, 'casual' => $class, 'clan' => $class);
                                while($row = $result->fetch_object()) {
                                    $pids[] = $row->pid;
                                    if (in_array($row->lid, array(1,3,5))) { $ladder['competitive'] = $row; }
                                    else if (in_array($row->lid, array(2,4,6))) { $ladder['casual'] = $row; }
                                    else if (in_array($row->lid, array(7,8,9))) { $ladder['clan'] = $row; }
                                }
                            }
                        }

                        ?>
                        <div class="row">
                            <div class="large-8 column">
                                <h3><?php
                                $f = new stdClass();
                                $f->wins = (int)@$ladder['competitive']->win_count + (int)@$ladder['casual']->win_count + (int)@$ladder['clan']->win_count;
                                $f->losses = (int)@$ladder['competitive']->loss_count + (int)@$ladder['casual']->loss_count + (int)@$ladder['clan']->loss_count;
                                $f->xp = experience($f);
                                if ($f->xp > 1600000) $f->xp = 1600000;
                                $f->rank = getRank($f->xp);

                                // get clan name if in clan
                                $clan = '';
                                if (!empty($ladder['clan']) && isset($ladder['clan']->pid)) {
                                    $query = sprintf('SELECT c.name FROM xcl_clans_players p INNER JOIN xcl_clans c USING(cid) WHERE p.pid = %d', $ladder['clan']->pid);
                                    if ($r = $mysqli->query($query)) {
                                        if ($r->num_rows > 0) $clan = $r->fetch_object()->name;
                                    }
                                }

                                echo $player;
                                if (!empty($clan)) echo ' [<a href="clan.php?game=',$game,'&clan=',$clan,'" class="link">', $clan,'</a>]';
                                ?></h3>
                            </div>
                            <div class="large-4 column">
                                <ul class="inline-list right" style="margin-top: 8px;">
                                    <!-- <li><a href="#"><i class="fa fa-envelope-o"></i> Contact</a></li>
                                    <li><a href="#"><i class="fa fa-crosshairs"></i> Challenge</a></li> -->
                                    <li><a href="#" data-reveal-id="crw"><i class="fa fa-exclamation-triangle"></i> Report</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="large-8 column">
                                <div class="panel" style="padding: 10px 0 10px 0;">
                                <?php
                                // printf('<pre>%s</pre>', print_r($ladder, 1));
                                echo '
                                        <table style="border: none; width: 100%;">
                                        <tr>
                                            <td style="border: none; padding: 0; width: 64px;"><img src="assets/img/ranks/small/r', $f->rank['rank'] ,'.png" /></td>
                                            <td  style="border: none; padding-right: 20px;">
                                                <span style="text-transform: uppercase; color: #fff; font-size: 80%;">', $f->rank['name'],'</span><br />
                                                <div class="progress" style="margin-bottom: 0; border: 0; background-color: #fff;">
                                                    <span class="meter" style="width: ', floor(($f->xp / $f->rank['next']) * 100),'%"></span>
                                                </div>
                                                <span style="color: red; text-transform: uppercase; font-size: 80%; font-weight: bold;">offline</span>
                                                <span class="right" style="text-transform: uppercase; color: #999; font-size: 80%;">Experience <span style="color: #fff;">', number_format($f->xp) ,'</span> / ', (isset($f->rank['next'])) ? number_format($f->rank['next']) : number_format($f->xp) ,'</span>
                                            </td>
                                        </tr>
                                        </table>
                                    </div>';
                                
                                include 'inc/twitch.php';

                                $time = time();
                                $query = sprintf('SELECT p.gid, p.cty, g.lid, g.mtime, p.cmp, p.pc, m.name as map FROM xcl_games_players p INNER JOIN xcl_games g USING(gid) INNER JOIN xcl_maps m USING(mid) WHERE p.pid IN (%s) ORDER BY p.gid DESC LIMIT 20', implode(',', $pids));
                                if ($result = $mysqli->query($query)) {
                                    if ($result->num_rows > 0) {
                                        echo '<div style="margin-top: 30px;"><h4>Match History</h4><table style="width: 100%;"><tr><th>Scenario</th><th>Type</th><th>Outcome</th><th class="hide-for-small">Date</th></tr>';
                                        while($row = $result->fetch_object()) {
                                            $type = 'Competitive';
                                            if (in_array($row->lid, array(2,4,6))) { $type = 'Casual'; }
                                            else if (in_array($row->lid, array(7,8,9))) { $type = 'Clan'; }
                                            echo '<tr>
                                                    <td><img src="assets/img/faction/icons/', $row->cty ,'.png" style="height: 15px;" /> <a href="game.php?game=', $game,'&gid=', $row->gid,'">', $row->map ,'</a></td>
                                                    <td>', $type ,'</td>
                                                    <td>', ($row->cmp > 0 ? 'Win' : 'Loss') ,' ', ($row->pc > 0 ? '(<span style="color:'. ($row->cmp > 0 ? 'green' : 'red') .'">'. ($row->cmp > 0 ? '+' : '-') . $row->pc .'</span>)' : '' ) ,'</td>
                                                    <td class="hide-for-small">', duration($time - $row->mtime, 1) ,'</td>
                                                </tr>';
                                        }
                                        echo '</table></div>';
                                    }
                                }

                                // $query = sprintf('SELECT * FROM xcl_games_players WHERE lid IN (%s) AND pid IN ($pids)', $lids, $pids);
                                ?>
                                <div>
                                    <h4>Comments</h4>
                                       <div id="disqus_thread"></div>
                                        <script type="text/javascript">
                                            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                                            var disqus_shortname = 'xwis'; // required: replace example with your forum shortname
                                            var disqus_identifier = 'pids<?php echo implode('.', $pids); ?>'; //a unique identifier for each page where Disqus is present

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
                                <?php
                            }
                        ?>
                    </div>
                    <div class="large-4 column">
                        <dl class="accordion" data-accordion>
                            <dd class="accordion-navigation" class="active">
                                <a href="#careerstats">Career Statistics</a>
                                <div id="careerstats" class="content active">
                                    <table style="width: 100%; border: none; padding: 0;margin-bottom: 0;">
                                    <?php
                                        echo '<tr><td>Total Wins:</td><td class="text-right">', ((int)@$ladder['competitive']->win_count + (int)@$ladder['casual']->win_count + (int)@$ladder['clan']->win_count),'</td></tr>';
                                        echo '<tr><td>Total Losses:</td><td class="text-right">', ((int)@$ladder['competitive']->loss_count + (int)@$ladder['casual']->loss_count + (int)@$ladder['clan']->loss_count),'</td></tr>';
                                        echo '<tr><td>Total Games:</td><td class="text-right">', ((int)@$ladder['competitive']->games_count + (int)@$ladder['casual']->games_count + (int)@$ladder['clan']->games_count),'</td></tr>';
                                        echo '<tr><td>Total Points:</td><td class="text-right">', max((int)@$ladder['competitive']->points + (int)@$ladder['casual']->points + (int)@$ladder['clan']->points, 0),'</td></tr>';
                                    ?>
                                    </table>
                                </div>
                            </dd>
                        <?php
                            if (!empty($ladder['clan']) && isset($ladder['clan']->points)) {
                                echo '<dd class="accordion-navigation"><a href="#clanstats">Clan Statistics <small style="font-weight:100;color:#6f6f6f;">(click to view)</small></a><div class="content" id="clanstats">
                                <table style="width: 100%; border: none; padding: 0;margin-bottom: 0;">
                                <tr><td>Total Wins:</td><td class="text-right">', (int)@$ladder['clan']->win_count,'</td></tr>
                                <tr><td>Total Losses:</td><td class="text-right">', (int)@$ladder['clan']->loss_count,'</td></tr>
                                <tr><td>Total Games:</td><td class="text-right">', (int)@$ladder['clan']->games_count,'</td></tr>
                                <tr><td>Points Earned:</td><td class="text-right">', ((int)@$ladder['clan']->points > 0 ? @$ladder['clan']->points : 0),'</td></tr>
                                </table></div></dd>';
                            }

                            if (!empty($ladder['casual']) && isset($ladder['casual']->points)) {
                                echo '<dd class="accordion-navigation"><a href="#casualstats">Casual Statistics <small style="font-weight:100;color:#6f6f6f;">(click to view)</small></a><div class="content" id="casualstats">
                                <table style="width: 100%; border: none; padding: 0;margin-bottom: 0;">
                                <tr><td>Total Wins:</td><td class="text-right">', (int)@$ladder['casual']->win_count,'</td></tr>
                                <tr><td>Total Losses:</td><td class="text-right">', (int)@$ladder['casual']->loss_count,'</td></tr>
                                <tr><td>Total Games:</td><td class="text-right">', (int)@$ladder['casual']->games_count,'</td></tr>
                                <tr><td>Total Points:</td><td class="text-right">', ((int)@$ladder['casual']->points > 0 ? @$ladder['casual']->points : 0),'</td></tr>
                                </table></div></dd>';
                            }

                            if (!empty($ladder['competitive']) && isset($ladder['competitive']->points)) {
                                echo '<dd class="accordion-navigation"><a href="#compstats">Competitive Statistics <small style="font-weight:100;color:#6f6f6f;">(click to view)</small></a><div class="content" id="compstats">
                                <table style="width: 100%; border: none; padding: 0;margin-bottom: 0;">
                                <tr><td>Total Wins:</td><td class="text-right">', (int)@$ladder['competitive']->win_count,'</td></tr>
                                <tr><td>Total Losses:</td><td class="text-right">', (int)@$ladder['competitive']->loss_count,'</td></tr>
                                <tr><td>Total Games:</td><td class="text-right">', (int)@$ladder['competitive']->games_count,'</td></tr>
                                <tr><td>Total Points:</td><td class="text-right">', ((int)@$ladder['competitive']->points > 0 ? @$ladder['competitive']->points : 0),'</td></tr>
                                </table></div></dd>';
                            }
                        ?>
                        </dl>
                        <!-- <h5>Achievements</h5>
                        <h5>Screenshots</h5> -->
                        <div style="width:100%; margin-top:15px;">
                            <h5>Statistics per Faction</h5>
                            <table style="width:100%;margin-bottom:0;">
                                <tr><th>Faction<th>Wins<th>Losses<th>Total</tr>
                            <?php
                            // TODO: need wins and losses per map
                                $q = sprintf('SELECT g.cty, c.name,
                                            (SELECT count(*) FROM xcl_games_players WHERE pid IN (%s) AND cty = g.cty AND cmp > 0) as wins,
                                            (SELECT count(*) FROM xcl_games_players WHERE pid IN (%1$s) AND cty = g.cty AND cmp < 1) as losses
                                            FROM xcl_games_players g
                                            INNER JOIN xcl_countries c ON c.fid = g.cty
                                            WHERE g.pid IN (%1$s)
                                            GROUP BY cty
                                            ORDER BY wins DESC', implode(',', $pids));

                                if ($result = $mysqli->query($q)) {
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_object()) {
                                            echo '<tr>
                                                    <td><img src="assets/img/faction/icons/', $row->cty ,'.png" style="height: 15px;" /> ', $row->name, '</td>
                                                    <td class="text-right">', $row->wins ,'</td>
                                                    <td class="text-right">', $row->losses,'</td>
                                                    <td class="text-right">', ($row->wins + $row->losses),'</td>
                                                </tr>';
                                        }
                                    }
                                }
                            ?>
                            </table>
                        </div>

                        <?php
                        // check for hof
                        if (!empty($ladder['competitive']) && isset($ladder['competitive']->pid)) {
                            $query = sprintf('SELECT * FROM xcl_hof WHERE pid = %d ORDER BY rank ASC', $ladder['competitive']->pid);
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
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div id="crw" class="reveal-modal tiny" data-reveal>
                <iframe src="http://xwis.co.uk/crw/" frameborder="0" style="width:400px;height:600px;" /></iframe>
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

function experience($player) {
  $recon = ( ( isset($player->recon) ) ? $player->recon: 0);
  return round(($player->wins * ($player->wins + $player->losses) * 2.7) - ($recon * 1.8));
}

function getRank($xp) {
  if ($xp <= 7999) {
    $rank['name'] = 'Private First Class';
    $rank['rank'] = 1;
    $rank['next'] = 8000;
    $rank['begin'] = 1;
  }
  else if ($xp >= 8000 && $xp <= 17999) {
    $rank['name'] = 'Private First Class 1 Star';
    $rank['rank'] = 2;
    $rank['next'] = 18000;
    $rank['begin'] = 8000;
  }
  else if ($xp >= 18000 && $xp <= 28999) {
    $rank['name'] = 'Private First Class 2 Stars';
    $rank['rank'] = 3;
    $rank['next'] = 29000;
    $rank['begin'] = 18000;
  }
  else if ($xp >= 29000 && $xp <= 40999) {
    $rank['name'] = 'Private First Class 3 Stars';
    $rank['rank'] = 4;
    $rank['next'] = 41000;
    $rank['begin'] = 29000;
  }
  else if ($xp >= 41000 && $xp <= 53999) {
    $rank['name'] = 'Lance Corporal';
    $rank['rank'] = 5;
    $rank['next'] = 54000;
    $rank['begin'] = 41000;
  }
  else if ($xp >= 54000 && $xp <= 66999) {
    $rank['name'] = 'Lance Corporal 1 Star';
    $rank['rank'] = 6;
    $rank['next'] = 67000;
    $rank['begin'] = 54000;
  }
  else if ($xp >= 67000 && $xp <= 80999) {
    $rank['name'] = 'Lance Corporal 2 Stars';
    $rank['rank'] = 7;
    $rank['next'] = 96000;
    $rank['begin'] = 67000;
  }
  else if ($xp >= 81000 && $xp <= 95999) {
    $rank['name'] = 'Lance Corporal 3 Stars';
    $rank['rank'] = 8;
    $rank['next'] = 96000;
    $rank['begin'] = 81000;
  }
  else if ($xp >= 96000 && $xp <= 110999) {
    $rank['name'] = 'Corporal';
    $rank['rank'] = 9;
    $rank['next'] = 111000;
    $rank['begin'] = 96000;
  }
  else if ($xp >= 111000 && $xp <= 129999) {
    $rank['name'] = 'Corporal 1 Star';
    $rank['rank'] = 10;
    $rank['next'] = 130000;
    $rank['begin'] = 111000;
  }
  else if ($xp >= 130000 && $xp <= 149999) {
    $rank['name'] = 'Corporal 2 Stars';
    $rank['rank'] = 11;
    $rank['next'] = 150000;
    $rank['begin'] = 130000;
  }
  else if ($xp >= 150000 && $xp <= 169999) {
    $rank['name'] = 'Corporal 3 Stars';
    $rank['rank'] = 12;
    $rank['next'] = 170000;
    $rank['begin'] = 150000;
  }
  else if ($xp >= 170000 && $xp <= 189999) {
    $rank['name'] = 'Sergeant';
    $rank['rank'] = 13;
    $rank['next'] = 190000;
    $rank['begin'] = 170000;
  }
  else if ($xp >= 190000 && $xp <= 219999) {
    $rank['name'] = 'Sergeant 1 Star';
    $rank['rank'] = 14;
    $rank['next'] = 220000;
    $rank['begin'] = 190000;
  }
  else if ($xp >= 220000 && $xp <= 249999) {
    $rank['name'] = 'Sergeant 2 Stars';
    $rank['rank'] = 15;
    $rank['next'] = 250000;
    $rank['begin'] = 220000;
  }
  else if ($xp >= 250000 && $xp <= 279999) {
    $rank['name'] = 'Sergeant 3 Stars';
    $rank['rank'] = 16;
    $rank['next'] = 280000;
    $rank['begin'] = 250000;
  }
  else if ($xp >= 280000 && $xp <= 309999) {
    $rank['name'] = 'Staff Sergeant';
    $rank['rank'] = 17;
    $rank['next'] = 310000;
    $rank['begin'] = 280000;
  }
  else if ($xp >= 310000 && $xp <= 339999) {
    $rank['name'] = 'Staff Sergeant 1 Star';
    $rank['rank'] = 18;
    $rank['next'] = 340000;
    $rank['begin'] = 310000;
  }
  else if ($xp >= 340000 && $xp <= 369999) {
    $rank['name'] = 'Staff Sergeant 2 Stars';
    $rank['rank'] = 19;
    $rank['next'] = 370000;
    $rank['begin'] = 340000;
  }
  else if ($xp >= 370000 && $xp <= 399999) {
    $rank['name'] = 'Gunnery Sergeant';
    $rank['rank'] = 20;
    $rank['next'] = 400000;
    $rank['begin'] = 370000;
  }
  else if ($xp >= 400000 && $xp <= 429999) {
    $rank['name'] = 'Gunnery Sergeant 1 Star';
    $rank['rank'] = 21;
    $rank['next'] = 430000;
    $rank['begin'] = 400000;
  }
  else if ($xp >= 430000 && $xp <= 469999) {
    $rank['name'] = 'Gunnery Sergeant 2 Star';
    $rank['rank'] = 22;
    $rank['next'] = 470000;
    $rank['begin'] = 430000;
  }
  else if ($xp >= 470000 && $xp <= 509999) {
    $rank['name'] = 'Master Sergeant';
    $rank['rank'] = 23;
    $rank['next'] = 510000;
    $rank['begin'] = 470000;
  }
  else if ($xp >= 510000 && $xp <= 549999) {
    $rank['name'] = 'Master Sergeant 1 Star';
    $rank['rank'] = 24;
    $rank['next'] = 550000;
    $rank['begin'] = 510000;
  }
  else if ($xp >= 550000 && $xp <= 589999) {
    $rank['name'] = 'Master Sergeant 2 Stars';
    $rank['rank'] = 25;
    $rank['next'] = 590000;
    $rank['begin'] = 550000;
  }
  else if ($xp >= 590000 && $xp <= 629999) {
    $rank['name'] = 'First Sergeant';
    $rank['rank'] = 26;
    $rank['next'] = 630000;
    $rank['begin'] = 590000;
  }
  else if ($xp >= 630000 && $xp <= 669999) {
    $rank['name'] = 'First Sergeant 1 Star';
    $rank['rank'] = 27;
    $rank['next'] = 670000;
    $rank['begin'] = 630000;
  }
  else if ($xp >= 670000 && $xp <= 709999) {
    $rank['name'] = 'First Sergeant 2 Stars';
    $rank['rank'] = 28;
    $rank['next'] = 710000;
    $rank['begin'] = 670000;
  }
  else if ($xp >= 710000 && $xp <= 759999) {
    $rank['name'] = 'Master Gunnery Sergeant';
    $rank['rank'] = 29;
    $rank['next'] = 760000;
    $rank['begin'] = 710000;
  }
  else if ($xp >= 760000 && $xp <= 809999) {
    $rank['name'] = 'Master Gunnery Sergeant 1 Star';
    $rank['rank'] = 30;
    $rank['next'] = 810000;
    $rank['begin'] = 760000;
  }
  else if ($xp >= 810000 && $xp <= 859999) {
    $rank['name'] = 'Master Gunnery Sergeant 2 Stars';
    $rank['rank'] = 31;
    $rank['next'] = 860000;
    $rank['begin'] = 810000;
  }
  else if ($xp >= 860000 && $xp <= 909999) {
    $rank['name'] = 'Sergeant Major';
    $rank['rank'] = 32;
    $rank['next'] = 910000;
    $rank['begin'] = 860000;
  }
  else if ($xp >= 910000 && $xp <= 959999) {
    $rank['name'] = 'Sergeant Major 1 Star';
    $rank['rank'] = 33;
    $rank['next'] = 960000;
    $rank['begin'] = 910000;
  }
  else if ($xp >= 960000 && $xp <= 1009999) {
    $rank['name'] = 'Sergeant Major 2 Star';
    $rank['rank'] = 34;
    $rank['next'] = 1010000;
    $rank['begin'] = 960000;
  }
  else if ($xp >= 1010000 && $xp <= 1059999) {
    $rank['name'] = 'Warrant Officer One';
    $rank['rank'] = 35;
    $rank['next'] = 1060000;
    $rank['begin'] = 1010000;
  }
  else if ($xp >= 1060000 && $xp <= 1109999) {
    $rank['name'] = 'Chief Warrant Officer Two';
    $rank['rank'] = 36;
    $rank['next'] = 1110000;
    $rank['begin'] = 1060000;
  }
  else if ($xp >= 1110000 && $xp <= 1164999) {
    $rank['name'] = 'Chief Warrant Officer Three';
    $rank['rank'] = 37;
    $rank['next'] = 1165000;
    $rank['begin'] = 1110000;
  }
  else if ($xp >= 1165000 && $xp <= 1219999) {
    $rank['name'] = 'Chief Warrant Officer Four';
    $rank['rank'] = 38;
    $rank['next'] = 1220000;
    $rank['begin'] = 1165000;
  }
  else if ($xp >= 1220000 && $xp <= 1279999) {
    $rank['name'] = 'Chief Warrant Officer Five';
    $rank['rank'] = 39;
    $rank['next'] = 1280000;
    $rank['begin'] = 1220000;
  }
  else if ($xp >= 1280000 && $xp <= 1339000) {
    $rank['name'] = 'Second Lieutenant';
    $rank['rank'] = 40;
    $rank['next'] = 1340000;
    $rank['begin'] = 1280000;
  }
  else if ($xp >= 1340000 && $xp <= 1399999) {
    $rank['name'] = 'First Lieutenant';
    $rank['rank'] = 41;
    $rank['next'] = 1400000;
    $rank['begin'] = 1340000;
  }
  else if ($xp >= 1400000 && $xp <= 1459999) {
    $rank['name'] = 'Captain';
    $rank['rank'] = 42;
    $rank['next'] = 1460000;
    $rank['begin'] = 1400000;
  }
  else if ($xp >= 1460000 && $xp <= 1519999) {
    $rank['name'] = 'Major';
    $rank['rank'] = 43;
    $rank['next'] = 1520000;
    $rank['begin'] = 1460000;
  }
  else if ($xp >= 1520000 && $xp <= 1599999) {
    $rank['name'] = 'Lt. Colonel';
    $rank['rank'] = 44;
    $rank['next'] = 1600000;
    $rank['begin'] = 1520000;
  }
  // else if ($xp >= 1600000 && $xp <= 1999999) {
  //   $rank['name'] = 'Colonel';
  //   $rank['rank'] = 45;
  //   $rank['next'] = 2000000;
  //   $rank['begin'] = 1600000;
  // }
  else if ($xp >= 1600000) {
    $rank['name'] = 'Colonel';
    $rank['rank'] = 45;
    //$rank['next'] = 2000000;
    $rank['begin'] = 1600000;
  }
  return $rank;
}
