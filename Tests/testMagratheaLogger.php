<?php

	class TestOfLogger extends UnitTestCase{

		function setUp(){
			$this->deleteLogFile();
		}
		function tearDown(){
		}

		private function GetLogFilePath(){
			$env = MagratheaConfig::Instance()->GetConfig("general/use_environment");
			$magrathea_path = MagratheaConfig::Instance()->GetConfig($env."/magrathea_path");
			$logPath = $magrathea_path."logs/log.txt";
			return $logPath;
		}

		private function deleteLogFile(){
			$logPath = $this->GetLogFilePath();
			@unlink($logPath);
			$this->assertFalse(file_exists($logPath));
		}

		// test log database
		function testLogDatabase(){
			$logPath = $this->GetLogFilePath();
			$GLOBALS["log"] = "all";

			$env = MagratheaConfig::Instance()->GetConfig("general/use_environment");
			$configSection = MagratheaConfig::Instance()->GetConfigSection($env);
			$magdb = Magdb::Instance();
			$magdb->SetConnection($configSection["db_host"], $configSection["db_name"], $configSection["db_user"], $configSection["db_pass"]);

			$query = "SELECT 1 AS ok";
			$magdb->Query($query);
			$this->assertTrue(file_exists($logPath));
		}

		// tests if new lines are added to the log file
		function testIncrementLogger(){
			$logPath = $this->GetLogFilePath();

			$message = "this nice message for testing";
			MagratheaLogger::Log($message);
			$initialFile = file_get_contents($logPath);

			$message2 = "adding a new message for testing";
			MagratheaLogger::Log($message2);
			$finalFile = file_get_contents($logPath);

			$this->assertTrue(($finalFile > $initialFile));
		}

	}

?>



