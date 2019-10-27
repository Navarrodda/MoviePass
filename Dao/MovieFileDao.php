<?php
namespace Dao;

use Model\Movie as Movie;

class MovieFileDao
{
		// Devuelve pelicula por genero
	public function getMovieByGenre($id)
	{
		$array = $this->getNowApi(1);
		$movieList = array();

		foreach ($array as $movie) 
		{
			foreach ($movie->getGenre() as $genero) {
				if($id == $genero)
				{
					array_push($movieList, $movie);
				}
			}
		}

		return $movieList;
	}
		//devuelve pelicula a partir del ID
	public function getMovieById($id,$page)
	{
		$array = $this->retrieveApiMovie($page,$id);
		return $array;
	}
		//devuelve una pagina de la api de peliculas ahora.
	public function getNowApi($page)
	{
		return $this->retrieveApi($page);
	}
		//devuelve el total de paginas de la api
	public function getPages()
	{
		return $this->retrievePages();
	}


		//graba en json
	private function saveData($list)
	{
		$arrayToencode = array();

		foreach ($list as $movie) 
		{

				//$valueArray["id"] = $movie->setId($values["id"]);
			$valueArray["title"] =	$movie->getTitle();
			$valueArray["idApi"] =	$movie->getIdapi();
			$valueArray["imagenruta"] =	$movie->getImagenruta();
			$valueArray["overview"] =	$movie->getOverview();
				//$valueArray["duration"] =	$movie->setDuration($values["duration"]);
			$valueArray["genre"] =	$movie->getGenre();

			array_push($arrayToencode, $valueArray);

		}

		$jsonContent = json_encode($arrayToencode,JSON_PRETTY_PRINT);

		file_put_contents("Data/movie.json", $jsonContent);


	}
// Devuelve cantidad total de paginas Api
	private function retrievePages()
	{
		$jsonContent = file_get_contents(API. "movie/now_playing" .KEY.PAGE."1");
		$arrayTodecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
			$pages = $arrayTodecode["total_pages"]; // La api entregar 2 arreglos 1 de results y otro de date.

			return $pages;
		}

		private function retrieveApiMovie($page,$id)
		{
			$movie = new Movie();

			$jsonContent = file_get_contents(API. "movie/now_playing" .KEY.PAGE.$page);

			$arrayTodecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

				$array = $arrayTodecode["results"]; // La api entregar 2 arreglos 1 de results y otro de date.

				
				foreach ($array as $indice) 
				{

					if($id == $indice["id"])
					{

						$movie->setIdApi($indice["id"]);
						$jsonContenten = file_get_contents(API. "movie/".$indice["id"].KEY.PAGE.$page);
						$data = ($jsonContenten) ? json_decode($jsonContenten,true):array();
						$movie->setTitle($indice["original_title"]);
						
						$poster = "http://image.tmdb.org/t/p/w500". $indice["poster_path"];
						$heders = get_headers($poster,1); 
						if ($heders[0] == "HTTP/1.1 404 Not Found") 
						{
							$poster = "/MoviePass/img/imgrot.jpg";
						}
						$movie->setPoster($poster);

						$backdrop = "http://image.tmdb.org/t/p/w500". $indice["backdrop_path"];
						$heders = get_headers($backdrop,1); 
						if ($heders[0] == "HTTP/1.1 404 Not Found") 
						{
							$backdrop = "/MoviePass/img/imgrot.jpg";
						}

						$movie->setBackdrop($backdrop);
						
						$movie->setOverview($indice["overview"]);
						$movie->setAverage($indice["vote_average"]);
						$movie->setGenre($indice["genre_ids"]);
						$movie->setDate($indice["release_date"]);
						$movie->setVote($indice["vote_count"]);
						$movie->setLanguage($indice["original_language"]);
						$movie->setPopularity($indice["popularity"]);
						$movie->setDuration($data["runtime"]);
					}
					
				}
				return $movie;
			}

			private function retrieveApi($page)
			{
				$movieList = array();
				try{
					$jsonContent = file_get_contents(API. "movie/now_playing" .KEY.PAGE.$page);
					$arrayTodecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
			$array = $arrayTodecode["results"]; // La api entregar 2 arreglos 1 de results y otro de date.
			foreach ($array as $indice) 
			{
				$movie = new Movie();
				$movie->setPopularity($indice["popularity"]);
				$movie->setVote($indice["vote_count"]);
				$poster = "http://image.tmdb.org/t/p/w500". $indice["poster_path"];
				if ($indice["poster_path"] == NULL) 
				{
					$poster = "/MoviePass/img/imgrot.jpg";
				}
				$movie->setPoster($poster);
				$movie->setIdApi($indice["id"]);
				$backdrop = "http://image.tmdb.org/t/p/w500". $indice["backdrop_path"];
				if ($indice["backdrop_path"] == NULL) 
				{
					$backdrop = "/MoviePass/img/imgrot.jpg";
				}
				$movie->setBackdrop($backdrop);
				$movie->setTitle($indice["original_title"]);
				$movie->setGenre($indice["genre_ids"]);
				$movie->setAverage($indice["vote_average"]);
				$movie->setOverview($indice["overview"]);
				$movie->setDate($indice["release_date"]);
				$movie->setLanguage($indice["original_language"]);
				array_push($movieList, $movie);
			}
			return $movieList;
		}catch(\Error $e){
			die("Error");
		}
	}
		//devuelve el detalle de una pelicula
	private function retrieveMovie($id,$page)
	{
		$jsonContent = file_get_contents(API. "movie/$id " .KEY.PAGE.$page);

		$data = ($jsonContent) ? json_decode($jsonContent,true):array();
		$movie = new Movie();
		if(!empty($data))
		{
			$movie->setIdApi($indice["id"]);
			$movie->setTitle($indice["original_title"]);
			$movie->setPoster($indice["poster_path"]);
			$movie->setBackdrop($indice["backdrop_path"]);
			$movie->setOverview($indice["overview"]);
			$movie->setAverage($indice["vote_average"]);
			$movie->setGenre($indice["genre_ids"]);
			$movie->setDate($indice["release_date"]);
			$movie->setVote($indice["vote_count"]);
			$movie->setLanguage($indice["original_language"]);
			$movie->setPopularity($indice["popularity"]);
			$movie->setDuration($indice["runtime"]);
		}else{
			$movie = false;
		}
		return $movie;
	}

	private function retrieveData()
	{
		$movieList = array();

		if(file_exists("Data/movie.json"))
		{
			$jsonContent = file_get_contents("Data/movie.json");

			$arrayTodecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

			foreach ($arrayTodecode as $values) 
			{

				$movie = new Movie();

				$movie->setId($values["id"]);
				$movie->setTitle($values["title"]);
				$movie->setIdapi($values["idApi"]);
				$movie->setImagenruta($values["imagenruta"]);
				$movie->setOverview($values["overview"]);
				$movie->setDuration($values["duration"]);
				$movie->setGenre($value["genre_ids"]);
				$movie->setReleaseDate($value["release_date"]);
				$movie->setVoteCount($value["vote_count"]);
				$movie->setVoteAverage($value["vote_average"]);
				$movie->setOriginalLanguage($value["original_language"]);
					/*$cell = new Cellphone($values["id"],$values["code"],$values["brand"],$values["model"],
					$values["price"]);*/
					array_push($movieList, $movie);
				}
				return $movielList;
			}

			return $list = array();
		}
	}
	?>