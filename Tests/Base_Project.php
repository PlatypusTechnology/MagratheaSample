<pre>
<?php

	ini_set('display_errors', 1);
//	error_reporting(E_ALL);

	include_once(__DIR__."/../Magrathea/LOAD.php");
	require_once("simpletest/autorun.php");

	include(__DIR__."/../app/Models/Movie.php");
	include(__DIR__."/../app/Models/Director.php");
	include(__DIR__."/../app/Models/Actor.php");

	SimpleTest :: prefer(new TextReporter());

	echo "</pre><hr/><br/>";
	echo "Model Tests: [ok]<br/>";
	echo "Database manipulation Tests: [ok]<br/>";
	echo "Query Tests: [ok]<br/>";
	echo "<br/><hr/><br/><pre>";

	include("test_Model.php");
	include("test_DatabaseManipulation.php");
	include("test_DatabaseMultipleRelation.php");
	include("test_MagratheaQuery.php");





	class MockMe{ 

		public static function truncateTables(){
			$magdb = Magdb::Instance();
			$query = "TRUNCATE TABLE tab_movies";
			$magdb->Query($query);
			$query = "TRUNCATE TABLE tab_directors";
			$magdb->Query($query);
			$query = "TRUNCATE TABLE tab_actors";
			$magdb->Query($query);
			$query = "TRUNCATE TABLE rel_movies_actors";
			$magdb->Query($query);
		}

		public static function insertTarantinos(){
			$quentin_t = new Director();
			$quentin_t->name = "Quentin Tarantino";
			$quentin_t->Insert();

			$kill_b = new Movie();
			$kill_b->title = "Kill Bill";
			$kill_b->year = 2004;
			$kill_b->Director = $quentin_t;
			$kill_b->Insert();

			$pulp_f = new Movie();
			$pulp_f->title = "Pulp Fiction";
			$pulp_f->year = 1994;
			$pulp_f->Director = $quentin_t;
			$pulp_f->Insert();

			$inglorious_b = new Movie();
			$inglorious_b->title = "Inglorious Bastards";
			$inglorious_b->year = 2009;
			$inglorious_b->Director = $quentin_t;
			$inglorious_b->Insert();
		}

		public static function insertSpielbergs(){
			$steven_s = new Director();
			$steven_s->name = "Steven Spielberg";
			$steven_s->Insert();

			$jurassic_p = new Movie();
			$jurassic_p->title = "Jurassic Park";
			$jurassic_p->year = 1993;
			$jurassic_p->Director = $steven_s;
			$jurassic_p->Insert();

			$et = new Movie();
			$et->title = "E.T.";
			$et->year = 1982;
			$et->Director = $steven_s;
			$et->Insert();
		}

		public static function insertZemeckis(){
			$robert_z = new Director();
			$robert_z->name = "Robert Zemeckis";
			$robert_z->Insert();

			$back_f = new Movie();
			$back_f->title = "Back to the Future";
			$back_f->year = 1985;
			$back_f->Director = $robert_z;
			$back_f->Insert();
		}
	}





?>
</pre>