<?php
namespace Controllers; 

use Model\Movie_X_Genre as MovieGenre;

use Dao\MovieGenreBdDao as MovieGenreBdDao;


class MoviegenreController
{
	private $MovieGenreDao;

	public function __construct()
	{
		$this->MovieGenreDao = MovieGenreBdDao::getInstance();
	}

	public function add($idmovie,$idgenre)
	{
		
	}

}
