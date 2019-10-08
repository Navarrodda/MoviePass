<?php
	namespace Dao;

	use Model\Movie as Movie;

	class MovieFileDao
	{

		public function getMovieByGenre($id)
		{
			$array = $this->getNowApi();
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

		public function getNowApi()
		{
			return $this->retrieveApi();
		}

		public function getPages()
		{
			return $this->retrievePages();
		}

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

		private function retrieveApi($page)
		{
			
			$movieList = array();

			//$jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=1b6861e202a1e52c6537b73132864511&language=en-US&page=1");
			
			$jsonContent = file_get_contents(API. "movie/now_playing" .KEY.PAGE.$page);

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