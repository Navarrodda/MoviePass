<?php

namespace Dao;

use \Model\Movie;

class MovieBdDao{

	protected $table = "movies";
	protected $list;
	private static $instance;

	public static function getInstance()
	{
		if (!self::$instance instanceof self) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function bring_id_by_title($title){
		$sql = "SELECT id FROM $this->table WHERE title = \"$title\" LIMIT 1";

		$conec = Conection::conection();

		$judgment = $conec->prepare($sql);

		$judgment->execute();


		$id = $judgment->fetch(\PDO::FETCH_ASSOC);

		if(!empty($id))
		{
			return $id['id'];
		}

		return null;
	}

	public function add(Movie $movie){
		try{

			/** @noinspection SqlResolve */
			$sql = ("INSERT INTO $this->table (idApi, vote, poster, backdrop, lan ,title, popularity, overview, datemdy, average, duration) VALUES (:idApi, :vote, :poster, :backdrop, :lan, :title, :popularity, :overview, :datemdy, :average, :duration)");

			$conec = Conection::conection();

			$judgment = $conec->prepare($sql);


			$idApi = $movie->getIdapi();
			$vote = $movie->getVote();
			$poster = $movie->getPoster();
			$backdrop = $movie->getBackdrop();
			$lan = $movie->getLanguage();
			$title = $movie->getTitle();
			$popularity = $movie->getPopularity();
			$overview = $movie->getOverview();
			$datemdy = $movie->getDate();
			$average = $movie->getAverage();
			$duration = $movie->getDuration();

			$judgment->bindParam(":idApi",$idApi);
			$judgment->bindParam(":vote",$vote);
			$judgment->bindParam(":poster",$poster);
			$judgment->bindParam(":backdrop",$backdrop);
			$judgment->bindParam(":lan",$lan);
			$judgment->bindParam(":title",$title);
			$judgment->bindParam(":popularity", $popularity);
			$judgment->bindParam(":overview", $overview);
			$judgment->bindParam(":datemdy", $datemdy);
			$judgment->bindParam(":average", $average);
			$judgment->bindParam(":duration", $duration);

			$judgment->execute();

			return $conec->lastInsertId();
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

	public function remove_by_id($id){
		try{

			$sql = "DELETE FROM $this->table WHERE id = \"$id \"";

			$conec = Conection::conection();

			$judgment = $conec->prepare($sql);

			$judgment->execute();

		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}


	public function to_update(Movie $movie, $id){

		try{
			$sql = ("UPDATE $this->table SET idApi=:idApi, vote=:vote, poster=:poster, backdrop=:backdrop, lan=:lan, title=:title, popularity=:popularity, overview=:overview, datemdy=:datemdy, average=:average duration=:duration WHERE id=\"$id\"");

			$conec = Conection::conection();

			$judgment = $conec->prepare($sql);

			$idApi = $movie->getIdapi();
			$vote = $movie->getVote();
			$poster = $movie->getPoster();
			$backdrop = $movie->getBackdrop();
			$lan = $movie->getLanguage();
			$title = $movie->getTitle();
			$popularity = $movie->getPopularity();
			$overview = $movie->getOverview();
			$datemdy = $movie->getDate();
			$average = $movie->getAverage();
			$duration = $movie->getDuration();

			$judgment->bindParam(":idApi",$idApi);
			$judgment->bindParam(":vote",$vote);
			$judgment->bindParam(":poster",$poster);
			$judgment->bindParam(":backdrop",$backdrop);
			$judgment->bindParam(":lan",$lan);
			$judgment->bindParam(":title",$title);
			$judgment->bindParam(":popularity", $popularity);
			$judgment->bindParam(":overview", $overview);
			$judgment->bindParam(":datemdy", $datemdy);
			$judgment->bindParam(":average", $average);
			$judgment->bindParam(":duration", $duration);


			$judgment->execute();
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

	public function bring_everything(){
		try{
			$sql = "SELECT * FROM $this->table";

			$conec = Conection::conection();

			$judgment = $conec->prepare($sql);

			$judgment->execute();

			$dataSet = $judgment->fetchAll(\PDO::FETCH_ASSOC);

			$this->mapear($dataSet);

			if (!empty($this->list)) {
				return $this->list;
			}
			return null;
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}



	public function bring_by_id($id)
	{   
		try{
			if ($id != null) {
				$sql = ("SELECT * FROM $this->table WHERE id = \"$id\"" );

				$conec = Conection::conection();

				$judgment = $conec->prepare($sql);

				$judgment->execute();

				$dataSet[] = $judgment->fetch(\PDO::FETCH_ASSOC);

				$this->mapear($dataSet);

				if(!empty($this->list[0])){

					return $this->list[0];
				}
			}

			return null;
		}catch(\PDOException $e){
			echo $e->getMessage();die();
		}catch(\Exception $e){
			echo $e->getMessage();die();
		}
	}

	public function mapear($dataSet){
		$dataSet = is_array($dataSet) ? $dataSet : false;
		if($dataSet){
			$this->list = array_map(function ($p) {
				$movie = new Movie
				(
					$p['idapi'],
					$p['vote'],
					$p['poster'],
					$p['backdrop'],
					$p['lan'],
					$p['title'],
					$p['popularity'],
					$p['overview'],
					$p['datemdy'],
					$p['average'],
					$p['duration']

				);
				$movie->setId($p['id']);
				return $movie;
			}, $dataSet);
		}
	}
}
