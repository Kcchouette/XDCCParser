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
 * @link https://github.com/Kcchouette/XDCCParser-global/
 * @author Kcchouette
 * @author Alex 'xshadowfire' Yu <ayu@xshadowfire.net>
 * @author DrX
 * @copyright 2008-2009 Alex Yu and DrX - 2015 Kcchouette
 */

require_once 'core.php';
require_once 'smarty/libs/Smarty.class.php';

//initialize smarty
$smarty = new Smarty;
$smarty->caching = false;
$smarty->template_dir = "./tpl";
$smarty->compile_dir =  "./templates_c";

//figure out url, if needed.
if(!URL) {
	$uri = explode("/",$_SERVER['REQUEST_URI']);
	array_pop($uri);
	define('_URL', "http://".$_SERVER['SERVER_NAME'].implode("/",$uri)."/");
} else {
	define('_URL', URL);
}

//assign our vars
$smarty->assign("url", _URL);
$smarty->assign("skin", $_REQUEST['skin'] ? $_REQUEST['skin'] : SKIN);
$smarty->assign("display_sc", DISPLAY_SC);
$smarty->assign("bots", xp_get("bots"));
$smarty->assign("bookmarks", xp_get("bookmarks"));
$_GET['search'] ? $smarty->assign("search", htmlentities(stripslashes($_GET['search']))) : null;
$_GET['nick'] ? $smarty->assign("nick", $_GET['nick']) : null;
if(IRC) {
	$smarty->assign("irc_chan", IRC_CHANNEL);
	$smarty->assign("irc_net", IRC_NETWORK);
}

$smarty->display('packlist.tpl');

//how old is our cache?
if(time() > xp_get("time")+UPDATE_FREQ)
	file_get_contents(_URL.'refresh.php',0,stream_context_create(array('http' => array('timeout' => 0))));

?>