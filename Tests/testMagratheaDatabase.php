<?php

	class TestOfDatabase extends UnitTestCase{

		function setUp(){

		}
		function tearDown(){

		}

		// is Database connecting?
		function testConnectDatabase(){
			$env = MagratheaConfig::Instance()->GetEnvironment();
			$configSection = MagratheaConfig::Instance()->GetConfigSection($env);
			$magdb = Magdb::Instance();
			$magdb->SetConnection($configSection["db_host"], $configSection["db_name"], $configSection["db_user"], $configSection["db_pass"]);
			$this->assertTrue( $magdb->OpenConnectionPlease() );	
		}

	}

	class TestOfDatabaseActions extends UnitTestCase {

		private $magdb = null;

		function setUp(){
			$env = MagratheaConfig::Instance()->GetEnvironment();
			$configSection = MagratheaConfig::Instance()->GetConfigSection($env);
			$this->magdb = Magdb::Instance();
			$this->magdb->SetConnection($configSection["db_host"], $configSection["db_name"], $configSection["db_user"], $configSection["db_pass"]);
		}
		function tearDown(){

		}

		// tests if queries as an array
		function testSelectQueryAll(){
			$query = "SELECT 1 AS ok";
			$result = $this->magdb->QueryAll($query);
			$this->assertIsA($result[0], "array");
		}

		// tests if queries as a row
		function testSelectQueryRow(){
			$query = "SELECT 1 AS ok";
			$result = $this->magdb->QueryRow($query);
			$this->assertIsA($result, "array");
		}

		// tests if queries as a single result
		function testSelectQueryOne(){
			$query = "SELECT 1 AS ok";
			$result = $this->magdb->QueryOne($query);
			$this->assertEqual($result, 1);
		}

		// tests if queries as an ordered row
		function testSelectQueryRowObject(){
			$this->magdb->SetFetchMode("object");
			$query = "SELECT 1 AS ok";
			$result = $this->magdb->QueryRow($query);
			$this->assertEqual($result->ok, 1);
		}

		// tests if queries as an assoc row
		function testSelectQueryRowAssoc(){
			$this->magdb->SetFetchMode("assoc");
			$query = "SELECT 1 AS ok";
			$result = $this->magdb->QueryRow($query);
			$this->assertEqual($result["ok"], 1);
		}

		function testIfAllColumnNamesComesInLowerCase(){
			$this->magdb->SetFetchMode("assoc");
			$query = "SELECT 1 AS UppErCasEvar";
			$result = $this->magdb->QueryRow($query);
			$this->assertEqual($result["uppercasevar"], 1);

		}

	}


?>