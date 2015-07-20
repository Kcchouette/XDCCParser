<?php

/**
 * XDCC Parser
 * |- Index
 *
 * This software is free software and you are permitted to
 * modify and redistribute it under the terms of the GNU General
 * Public License version 3 as published by the Free Sofware
 * Foundation.
 *
 * @link https://github.com/Kcchouette/XDCCParser/
 * @author Kcchouette
 * @author Alex 'xshadowfire' Yu <ayu@xshadowfire.net>
 * @author DrX
 * @copyright 2008-2009 Alex Yu and DrX - 2015 Kcchouette
 */

require_once 'core.php';
require_once 'vendor/smarty/smarty/libs/Smarty.class.php';

//figure out url, if needed.
if(!URL) {
	$uri = explode("/",$_SERVER['REQUEST_URI']);
	array_pop($uri);
	define('_URL', "http://" . $_SERVER['SERVER_ADDR'] . implode("/",$uri)."/");
} else {
	define('_URL', URL);
}


//how old is our cache?
if(time() > xp_get("time")+UPDATE_FREQ)
	file_get_contents(_URL.'refresh.php',0,stream_context_create(array('http' => array('timeout' => 0))));

$bots=xp_get("bots");
if(isset($_GET['nick'])) {
	header('Content-type: application/rss+xml');
	for($i=0;isset($bots[$i]);$i++) {
		if($bots[$i]['nick']==$_GET['nick']) {
			echo '<?xml version="1.0" encoding="utf-8" ?>
			<rss version="2.0">
			<channel>
			<title>' . RSS_TITLE . '</title>
			<link>' . URL . '</link>
			<description>' . RSS_DESC . '</description>';
			for($j=0;isset($bots[$i]['packs'][1][$j]);$j++) {
				echo '<item>
					<title>' . $bots[$i]['packs'][5][$j] . '</title>';
				echo 	'<link>' . _URL . '?nick=' . rawurlencode($bots[$i]['nick']) .'</link>';
				echo 	'<description>/msg ' . $bots[$i]['nick'] . ' XDCC SEND ' . $bots[$i]['packs'][1][$j] . '</description>
				<guid>urn:uuid:'.md5(
					$bots[$i]['packs'][1][$j] .
					$bots[$i]['packs'][2][$j] .
					$bots[$i]['packs'][3][$j] .
					$bots[$i]['packs'][4][$j] .
					$bots[$i]['packs'][5][$j] .
					$bots[$i]['nick']
				) . '</guid>
				</item>';
			}
		}
	}
	echo '</channel>
	</rss>';

} else {
	//initialize smarty
	$smarty = new Smarty;
	$smarty->caching = false;
	$smarty->template_dir = "./tpl";
	$smarty->compile_dir = "./templates_c";

	$smarty->assign("skin", $_REQUEST['skin'] ? $_REQUEST['skin'] : SKIN);

	$smarty->display("header.tpl");
	$smarty->assign("bots", xp_get("bots"));
        echo '<h2>Bots</h2>';
	$smarty->display("botlist.tpl");
	$smarty->display("adminfooter.tpl");
}

?>
