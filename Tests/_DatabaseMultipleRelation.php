<?php

	global $magdb;

	class TestDatabaseMultipleRelations extends UnitTestCase {

		function setUp(){
			MockMe::truncateTables();
		}
		function tearDown(){
			MockMe::truncateTables();
		}

		function testAddActorToMovie(){
			$act1 = new Actor();
			$act1->name = "Tom Hanks";
			$act1->Save();
			$this->assertNotNull($act1->id);

			$mv1 = new Movie();
			$mv1->title = "Forrest Gump";
			$mv1->year = 1994;
			$mv1->Save();
			$this->assertNotNull($mv1->id);

			$mv1->AddActor($act1);

			$cast = $mv1->GetActors();
			$this->assertEqual(1, count($cast));
		}

		function testAddMoviesToActor(){
			$act1 = new Actor();
			$act1->name = "Brad Pitt";
			$act1->Insert();
			$this->assertNotNull($act1->id);

			$mv1 = new Movie();
			$mv1->title = "Fight Club";
			$mv1->Insert();
			$this->assertNotNull($mv1->id);

			$mv2 = new Movie();
			$mv2->title = "Troy";
			$mv2->Save();
			$this->assertNotNull($mv2->id);

			$mv3 = new Movie();
			$mv3->title = "World War Z";
			$mv3->year = 2013;
			$mv3->Save();
			$this->assertNotNull($mv3->id);

			$act1->AddMovie($mv1);
			$act1->AddMovie($mv2);
			$act1->AddMovie($mv3);

			$filmography = $act1->GetMovies();
			$this->assertEqual(3, count($filmography));
		}

		function testRemoveMoviesAndActors(){
			$brad_pitt = new Actor();
			$brad_pitt->name = "Brad Pitt";
			$brad_pitt->Insert();
			$this->assertNotNull($brad_pitt->id);

			$edward_norton = new Actor();
			$edward_norton->name = "Edward Norton";
			$edward_norton->Insert();
			$this->assertNotNull($edward_norton->id);

			$fight_club = new Movie();
			$fight_club->title = "Fight Club";
			$fight_club->Insert();
			$this->assertNotNull($fight_club->id);

			$hulk = new Movie();
			$hulk->title = "Hulk";
			$hulk->Save();
			$this->assertNotNull($hulk->id);

			$brad_pitt->AddMovie($fight_club);
			$edward_norton->AddMovie($fight_club);

			$hulk->AddActor($edward_norton);

			$fight_club_cast = $fight_club->GetActors();
			$this->assertEqual(2, count($fight_club_cast));

			$hulk_cast = $hulk->GetActors();
			$this->assertEqual("Edward Norton", $hulk_cast[0]->name);

			$en_films = $edward_norton->GetMovies();
			$this->assertEqual(2, count($en_films));


			$hulk->removeActors(array($edward_norton->id));
			$en_films = $edward_norton->GetMovies();
			$this->assertEqual(1, count($en_films));


		}


	}



?>