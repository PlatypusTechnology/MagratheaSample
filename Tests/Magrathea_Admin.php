<pre>
<?php

//	ini_set('display_errors', 1);
//	error_reporting(E_ALL);

	include_once(__DIR__."/../Magrathea/LOAD.php");
	require_once("simpletest/autorun.php");
	require_once('simpletest/web_tester.php');

	echo "</pre><hr/><br/>";
	echo "Magrathea Admin: [nothing to do here]<br/>";
	echo "<br/><hr/><br/><pre>";


	SimpleTest :: prefer(new TextReporter());

	include ("testMagratheaAdmin.php");

?>
</pre>