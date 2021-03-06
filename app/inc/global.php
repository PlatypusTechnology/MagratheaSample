<?php

	session_start();

	error_reporting(E_ALL ^ E_STRICT);
	error_reporting(1);

	include("configs.php");
	include($magrathea_path."/LOAD.php");

//	MagratheaDebugger::Instance()->SetType("debug");

	$Smarty = new Smarty;
	$Smarty->template_dir = $site_path."/app/Views/";
	$Smarty->compile_dir  = $site_path."/app/Views/_compiled";
	$Smarty->config_dir   = $site_path."/app/Views/configs";
	$Smarty->cache_dir    = $site_path."/app/Views/_cache";
	$Smarty->configLoad("site.conf");
	$Smarty->assign("View", MagratheaView::Instance());

	MagratheaView::Instance()->IsRelativePath(false); // for mod_rewrite

	// wanna debug? here's your debug!
	// options: dev; debug; log; none;
	MagratheaDebugger::Instance()->SetType(MagratheaDebugger::DEBUG);

?>
