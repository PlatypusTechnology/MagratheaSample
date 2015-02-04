<?php

	// include pear (if not installed):
	set_include_path(".".PATH_SEPARATOR.("/Users/paulohenrique/www/magrathea_sample/Magrathea/libs/pear".PATH_SEPARATOR.get_include_path()));

	session_start();

	error_reporting(E_ALL ^ E_STRICT);
//	error_reporting(E_ALL);

	$magrathea_path = "/Users/paulohenrique/www/magrathea_sample/Magrathea";
	$site_path = "/Users/paulohenrique/www/magrathea_sample";

	include($magrathea_path."/LOAD.php");

//	MagratheaDebugger::Instance()->SetType("debug");

	$Smarty = new Smarty;
	$Smarty->template_dir = $site_path."/app/Views/";
	$Smarty->compile_dir  = $site_path."/app/Views/_compiled";
	$Smarty->config_dir   = $site_path."/app/Views/configs";
	$Smarty->cache_dir    = $site_path."/app/Views/_cache";
	$Smarty->configLoad("site.conf");
	
	$View = new MagratheaView();
	$Smarty->assign("View", $View);

	$View->IsRelativePath(false); // for mod_rewrite

//	MagratheaDebugger::Instance()->SetType("dev");

?>
