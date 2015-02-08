<?php

	global $magdb;

	class TestDatabaseManipulation extends UnitTestCase{

		private $magdb;

		function setUp(){
			MockMe::truncateTables();
			MockMe::insertTarantinos();
			MockMe::insertSpielbergs();
			MockMe::insertZemeckis();
		}
		function tearDown(){
			MockMe::truncateTables();
		}

		// should bring me back all directors
		function testGetAllDirectors(){
			$directors = DirectorControl::GetAll();
			$this->assertEqual(3, count($directors));
		}

		// tests GetById and SimpleWhere:
		function testGetAllMoviesFromTarantino(){
			$tarantino = new Director(1);
			$this->assertEqual("Quentin Tarantino", $tarantino->name);

			$movies = MovieControl::GetWhere(array("director_id" => $tarantino->id));
			$this->assertEqual(3, count($movies));
		}

		// two tests, actually: tests the update and saving special chars
		function testUpdate(){
			$kill_b = new Movie(1);
			$kill_b->year = 2005;
			$kill_b->Update();

			$kill_b2 = new Movie(1);
			$this->assertEqual(2005, $kill_b2->year);
		}

		// I must update if I have the Id or insert if I don't...
		function testSaveOrUpdate(){
			$kill_b = new Movie();
			$kill_b->title = "Kill Bill";
			$kill_b->year = 2004;
			$kill_b->Director = new Director(1);
			$kill_b->Save();
			// this will insert

			$kill_b2 = new Movie($kill_b->id);
			$kill_b2->title = "Kill Bill 2";
			$kill_b2->year = 2005;
			$kill_b2->Save();
			// this will update

			$this->assertEqual($kill_b->id, $kill_b2->id);
			$this->assertNotEqual($kill_b->title, $kill_b2->title);

			$kb2 = MovieControl::GetWhere(array("year" => 2005));
			$this->assertEqual("Kill Bill 2", $kb2[0]->title);
		}

		// asserts that I can get multiple objects
		function testGetMultipleObject(){
			$movie_without_director = MovieControl::GetWhere(array("name" => "Pulp Fiction"));
			$movie_with_director = MovieControl::GetMultipleObjects(
				array("movie" => new Movie(), "director" => new Director()), 
				"INNER JOIN tab_directors ON tab_movies.director_id = tab_directors.id",
				array("tab_movies.name" => "Pulp Fiction")
			);
			$movie = null;
			foreach ($movie_with_director as $row) {
				$row["movie"]->Director = $row["director"];
				$movie = $row["movie"];
			}
			$this->assertEqual("Quentin Tarantino", $movie->Director->name);
		}

		// test Simple Where (as a query)
		function testGetSimpleWhere(){
			$where = "tab_directors.name LIKE '%Steven%'";
			$director = DirectorControl::GetSimpleWhere($where);
			$this->assertEqual("Steven Spielberg", $director[0]->name);
		}

	}

?>