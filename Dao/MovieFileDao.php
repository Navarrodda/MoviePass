<?php
	namespace Dao;

	use Model\Movie as Movie;

	class MovieFileDao
	{

		private function saveData($list)
		{
			$arrayToencode = array();

			foreach ($list as $movie) {

				//$valueArray["id"] = $movie->setId($values["id"]);
				$valueArray["title"] =	$movie->setTitle($values["title"]);
				$valueArray["idApi"] =	$movie->setIdapi($values["idApi"]);
				$valueArray["imagenruta"] =	$movie->setImagenruta($values["imagenruta"]);
				$valueArray["overview"] =	$movie->setOverview($values["overview"]);
				//$valueArray["duration"] =	$movie->setDuration($values["duration"]);
				$valueArray["genre"] =	$movie->setGenre($value["genre"]);

				array_push($arrayToencode, $valueArray);

			}

			$jsonContent = json_encode($arrayToencode,JSON_PRETTY_PRINT);

			file_put_contents("Data/movie.json", $jsonContent);


		}

		public function getNowApi()
		{
			return $this->retrieveApi();
		}

		private function retrieveApi()
		{
			
			$movieList = array();

			//$jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=1b6861e202a1e52c6537b73132864511&language=en-US&page=1");
			
			$jsonContent = file_get_contents(API. "movie/now_playing" .KEY);

				$arrayTodecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

				$array = $arrayTodecode["results"]; // La api entregar 2 arreglos 1 de results y otro de date.

				foreach ($array as $indice) 
				{
						$movie = new Movie();
								$movie->setIdApi($indice["id"]);
								$movie->setTitle($indice["original_title"]);
								//$movie->setIdapi($arreglo["idApi"]);
								$movie->setImagenruta($indice["backdrop_path"]);
								$movie->setOverview($indice["overview"]);
								//$movie->setDuration($arreglo["duration"]);
								$movie->setGenre($indice["genre_ids"]);
								$movie->setReleaseDate($indice["release_date"]);
								$movie->setVoteCount($indice["vote_count"]);
								$movie->setVoteAverage($indice["vote_average"]);
								$movie->setOriginalLanguage($indice["original_language"]);


								/*$cell = new Cellphone($values["id"],$values["code"],$values["brand"],$values["model"],
									$values["price"]);*/
								array_push($movieList, $movie);
							
					
				}
				return $movieList;
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