<?php

$path = __DIR__."/";
include_once($path."libs/Smarty/Smarty.class.php");

require ($path."Exceptions.php");
require ($path."Functions.php");
require ($path."Database.php");
require ($path."MagratheaConfig.php");
require ($path."MagratheaController.php");
require ($path."Model.php");
require ($path."MagratheaModelControl.php");
require ($path."MagratheaView.php");

include ($path."MagratheaCompressor.php");
require ($path."MagratheaQuery.php");
require ($path."MagratheaDebugger.php");
require ($path."MagratheaLogger.php");

include("load_vars.php");

?>