<?php

include(__DIR__."/Base/MovieBase.php");

class Movie extends MovieBase {
	// your code goes here!


	function removeActors($actors_ids){
		$deleteQuery = MagratheaQuery::Delete()->Table($this->relations["relational_table"]["Actors"])->Where("movie_id = ".$this->GetID()." AND actor_id IN (".implode(',', $actors_ids).")");
		return MovieControl::Run($deleteQuery);
	}



}

class MovieControl extends MovieControlBase {
	// and here!
}

?>