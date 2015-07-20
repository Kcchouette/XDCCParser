<?php

/**
 * XDCC Parser
 * |- Admin Module
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

//set your user and password here
define('ADMIN_USER', "changeme");
define('ADMIN_PASS', "yougonnagethackedifyoudont");

// DO NOT EDIT BELOW!!
if (!($_SERVER['PHP_AUTH_USER'] == ADMIN_USER && $_SERVER['PHP_AUTH_PW'] == ADMIN_PASS)) {
	header('WWW-Authenticate: Basic realm="XDCC Parser Admin"');
	header('HTTP/1.0 401 Unauthorized');
	die("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\n<html><head>\n<title>403 Forbidden</title>\n</head><body>\n<h1>Forbidden</h1>\n<p>You don't have permission to access ".$_SERVER['REQUEST_URI']." on this server.</p>\n</body></html>\n");
}

require_once 'core.php';
require_once 'vendor/smarty/smarty/libs/Smarty.class.php';

//initialize smarty
$smarty = new Smarty;
$smarty->caching = false;
$smarty->template_dir = "./tpl";
$smarty->compile_dir =  "./templates_c";
$botconfig = xp_get("botconfig");
$config = xp_get("config");
$bookmarks = xp_get("bookmarks");

$smarty->assign("skin", $_REQUEST['skin'] ? $_REQUEST['skin'] : SKIN);
if(IRC) {
	$smarty->assign("irc_chan", IRC_CHANNEL);
	$smarty->assign("irc_net", IRC_NETWORK);
}

switch($_REQUEST['do']) {
	case 'editbot':
		if($botconfig[$_REQUEST['bot']]) {
			$smarty->assign("edit", $_REQUEST['bot']);
			$smarty->assign("boturi", $botconfig[$_REQUEST['bot']]);
		}
		$smarty->display('adminbot.tpl');
		exit();
	case 'editbookmark':
		if($bookmarks[$_REQUEST['bm_id']]) {
			$smarty->assign("bm", htmlentities($bookmarks[$_REQUEST['bm_id']][0]));
			$smarty->assign("bmv", htmlentities($bookmarks[$_REQUEST['bm_id']][1]));
			$smarty->assign("bm_id", $_REQUEST['bm_id']);
		}
		$smarty->display('adminbookmark.tpl');
		exit();
	case 'editgroup':
		$smarty->assign("group",$config['group']);
		$smarty->display('admingroup.tpl');
		exit();
	case 'deletebot':
		if($botconfig[$_REQUEST['bot']]) {
			unset($botconfig[$_REQUEST['bot']]);
			xp_set("botconfig",$botconfig);
			$refresh = 1;
		}
		break;
	case 'commitbot':
		if($_REQUEST['botname'] && $_REQUEST['boturi']) {
			$botconfig[$_REQUEST['botname']] = $_REQUEST['boturi'];
			xp_set("botconfig",$botconfig);
			$refresh = 1;
		}
		break;
	case 'deletebookmark':
		if($bookmarks[$_REQUEST['bm_id']]) {
			unset($bookmarks[$_REQUEST['bm_id']]);
			xp_set("bookmarks",$bookmarks);
		}
		break;
	case 'commitbookmark':
		if($_REQUEST['bmname'] && $_REQUEST['bmval']) {
			if(!$_REQUEST['bm_id']) {
				if(empty($bookmarks))
					$_REQUEST['bm_id'] = 1;
				else
					$_REQUEST['bm_id'] = array_pop(array_keys($bookmarks)) + 1;
			}
			$bookmarks[$_REQUEST['bm_id']] = array( stripslashes($_REQUEST['bmname']), stripslashes($_REQUEST['bmval']) );
			xp_set("bookmarks",$bookmarks);
		}
		break;
	case 'commitgroup':
		$config['group'] = stripslashes($_REQUEST['groupname']);
		xp_set("config",$config);
		$refresh = 1;
		break;
	case 'refresh':
		$refresh = 1;
		break;
}

if($refresh) require_once "refresh.php";
$smarty->assign("bots",$botconfig);
$smarty->assign("config",$config);
$smarty->assign("bookmarks",$bookmarks);
$smarty->display('adminindex.tpl');

?>
