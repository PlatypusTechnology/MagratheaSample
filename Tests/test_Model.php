<?php

	global $magdb;

	class TestOfModels extends UnitTestCase{

		function setUp(){
			MockMe::truncateTables();
		}
		function tearDown(){
			MockMe::truncateTables();
		}

		// most simple test we can do with an object:
		function testIfObjectIsBeingNicelySaved(){
			$d = new Director();
			$d->name = "Andrew Stanton";
			$d->Insert();
			$this->assertNotNull($d->id);

			$m = new Movie();
			$m->title = "Wall-e";
			$m->year = 2008;
			$m->Director = $d;
			$m->Insert();

			// director id should not be null!
			$this->assertNotNull($m->director_id);
		}

		// tests if lazy load is working
		function testLazyLoad(){
			$d = new Director();
			$d->name = "Quentin Tarantino";
			$d->Insert();
			$this->assertNotNull($d->id);

			$m = new Movie();
			$m->title = "Kill Bill";
			$m->director_id = $d->id;
			$this->assertEqual($m->Director->name, "Quentin Tarantino");
		}

		// tests if you can load a object from a table row:
		function testCreateObjectFromTableRow(){
			$d = new Director();
			$d->name = "Steven Spielberg";
			$d->Insert();
			$this->assertNotNull($d->id);

			$m1 = new Movie();
			$m1->title = "Jurassic Park";
			$m1->year = 1993;
			$m1->Director = $d;

			$movieTest = array(
				'name' => "Jurassic Park",
				'year' => 1993,
				'director_id' => $d->id 
			);
			$m2 = new Movie();
			$m2->LoadObjectFromTableRow($movieTest);
			$m2->GetDirector();

			$this->assertEqual($m1, $m2);
		}

		// tests UTF-8 characters persistence
		function testInsertObjectWithUTF8(){
			$m = new Movie();
			$m->title = "Adaptação";
			$m->year = 2002;
			$m->Insert();
			$this->assertNotNull($m->id);

			$m_test = new Movie($m->id);
			$this->assertEqual("Adaptação", $m_test->title);

		}

	}

?>