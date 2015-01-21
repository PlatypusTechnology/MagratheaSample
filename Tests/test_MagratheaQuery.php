<?php

	class TestMagratheaQuery extends UnitTestCase{

		function setUp(){
			MockMe::truncateTables();
			MockMe::insertTarantinos();
			MockMe::insertSpielbergs();
			MockMe::insertZemeckis();
		}
		function tearDown(){
//			MockMe::truncateTables();
		}

		// test simple query:
		function testSimpleQuery(){
			$query = MagratheaQuery::Create()->Obj("Director");
			$directors = DirectorControl::Run($query);
			$this->assertEqual(3, count($directors));
		}

		// test simple query order:
		function testSimpleQueryOrder(){
			$query = MagratheaQuery::Create()->Obj("Movie")->Order("year ASC");
			$movies = MovieControl::Run($query);
			$this->assertEqual("1982", $movies[0]->year);
		}

		// select movies and directors between 90s
		function testComplexQueryGettingObjectsWithRelatedHasOne(){
			$query = MagratheaQuery::Create()->Obj("Movie")->HasOne("Director", "director_id")->Where("year BETWEEN 1990 AND 1999")->Order("tab_movies.name DESC");
			$movies = MovieControl::Run($query);
			$this->assertEqual(2, count($movies));
			$this->assertEqual("Quentin Tarantino", $movies[0]->Director->name);
		}

		// select directors with movies between 80s
		function testComplexQueryGettingObjectsWithRelatedBelongsTo(){
			$query = MagratheaQuery::Create()->Obj("Director")->BelongsTo("Movie", "director_id")->Where("tab_movies.year BETWEEN 1980 AND 1989")->Order("tab_movies.year ASC");
			$directors = DirectorControl::Run($query);
			$this->assertEqual(2, count($directors));
			$this->assertEqual("Steven Spielberg", $directors[0]->name);
		}

	}

?>