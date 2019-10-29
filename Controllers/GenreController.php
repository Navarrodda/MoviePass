<?php
namespace Controllers; 

use Model\Genre as Genre;

use Dao\GenreFileDao as GenreFileDao;
use Dao\GenreBdDao as GenreBdDao;

class GenreController
{
	private $GenreFileDao;
	private $GenreBdDao;

	public function __construct()
	{
		$this->GenreFileDao = new GenreFileDao();
		$this->GenreBdDao = GenreBdDao::getInstance();
	}

		// Devuelve un Array de Generos desde la api.
	public function getList()
	{
		$api = $this->GenreFileDao->getNowApi();
		return $api;
	}

	public function add($genre)
	{

		foreach ($genre as $id) 
		{
			$genre = $this->GenreFileDao->bring_by_id($id);
			if($this->GenreBdDao->bring_id_by_idapi($id) == null)
			{
				$this->GenreBdDao->add($genre);
			}
		}
	}

	public function bring_everything()
	{
		return $this->GenreBdDao->bring_everything();
	}



}
