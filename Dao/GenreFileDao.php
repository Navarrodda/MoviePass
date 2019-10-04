<?php
	namespace Dao;

	use Model\Genre as Genre;

	class GenreFileDao
	{
		private function saveData($list)
		{
			$arrayToencode = array();

			foreach ($list as $genre) 
			{

				$valueArray["id"] = $genre->setId($values["id"]);
				$valueArray["name"] = $genre->setName($values["name"]);
				

				array_push($arrayToencode, $valueArray);

			}

			$jsonContent = json_encode($arrayToencode,JSON_PRETTY_PRINT);

			file_put_contents("Data/genre.json", $jsonContent);


		}

		public function getNowApi()
		{
			return $this->retrieveApi();
		}

		private function retrieveApi()
		{
			
			$genreList = array();

			//$jsonContent = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=1b6861e202a1e52c6537b73132864511&language=en-US&page=1");
			
			$jsonContent = file_get_contents(API. "genre/movie/list" .KEY);

			$arrayTodecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

			foreach ($arrayTodecode as $indice) 
				{
					$genre = new Genre();
					//indice tiene un  array de arrays de generos.
					foreach ($indice as $value) 
					{	
						//value contiene un solo array con genero.
						$genre->setId($value["id"]);
						$genre->setName($value["name"]);
						array_push($genreList, $genre);
					}
					
				}
				return $genreList;
		}

		private function retrieveData()
		{
			$genreList = array();

			if(file_exists("Data/genre.json"))
			{
				$jsonContent = file_get_contents("Data/genre.json");

				$arrayTodecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

				foreach ($arrayTodecode as $values) 
				{
					
					$genre = new Genre();
					$genre->setId($indice["id"]);
					$genre->setName($indice["name"]);

					/*$cell = new Cellphone($values["id"],$values["code"],$values["brand"],$values["model"],
						$values["price"]);*/
					array_push($genreList, $genre);
				}
				return $genreList;
			}

			return $list = array();
		}

	}
?>