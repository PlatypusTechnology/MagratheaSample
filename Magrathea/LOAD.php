<?php

$path = __DIR__."/";
require ($path."Exceptions.class.php");
require ($path."Functions.php");
require ($path."Database.class.php");
require ($path."Config.class.php");
require ($path."Controller.class.php");
require ($path."Model.class.php");
require ($path."ModelControl.class.php");
require ($path."View.class.php");

include ($path."MagratheaCompressor.php");
require ($path."MagratheaQuery.php");
require ($path."MagratheaLogger.php");

$magdb = null;
try	{
	if(!isset($GLOBALS['environment'])){
		$GLOBALS['environment'] = MagratheaConfigStatic::GetConfig("general/use_environment");
	}
	$configSection = MagratheaConfigStatic::GetConfigSection($GLOBALS['environment']);
	$magdb = Magdb::Instance();
	$magdb->SetConnection($configSection["db_host"], $configSection["db_name"], $configSection["db_user"], $configSection["db_pass"]);
} catch (Exception $ex){
	$error_msg = "Error: ".$ex->getMessage();
	echo $error_msg; die;
}


// optional:
date_default_timezone_set( MagratheaConfigStatic::GetConfig("general/time_zone") );



?>