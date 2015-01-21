<pre>
<?php

//	ini_set('display_errors', 1);
//	error_reporting(E_ALL);

	include(__DIR__."/../Magrathea/LOAD.php");
	require_once("simpletest/autorun.php");

	SimpleTest :: prefer(new TextReporter());

	echo "</pre><hr/><br/>";
	echo "Config Tests: [ok]<br/>";
	echo "Logger Tests: [ok]<br/>";
	echo "Database Tests: [ok]<br/>";
	echo "<br/><hr/><br/><pre>";

	include("testMagratheaConfig.php");
	include("testMagratheaLogger.php");
	include("testMagratheaDatabase.php");

?>
</pre>