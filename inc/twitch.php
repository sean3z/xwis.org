<?php

$twitch = false;

if ($game == 'ra2') {
	if ($player == 'edd') {
		$twitch = 'vltality';
	}

	if ($player == 'shaun') {
		$twitch = 'youramidget';
	}

	if ($player == 'ganxster') {
		$twitch = 'cncsteffster';
	}
}

if ($twitch) {
	echo sprintf('<iframe src="http://www.twitch.tv/%s/embed" frameborder="0" scrolling="no" style="width:100%%; height:387px;"></iframe>', $twitch);
}