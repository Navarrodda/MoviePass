<?php
namespace Controllers; 

use Model\Movie_X_Genre as MovieGenre;

use Dao\MovieGenreBdDao as MovieGenreBdDao;
use Dao\MovieBdDao as MovieBdDao;
use Dao\GenreBdDao as GenreBdDao;


class MoviegenreController
{
	private $MovieGenreDao;
	private $MovieDao;
	private $GenreDao;

	public function __construct()
	{
		$this->MovieGenreDao = MovieGenreBdDao::getInstance();
		$this->MovieDao = MovieBdDao::getInstance();
		$this->GenreDao = GenreBdDao::getInstance();
	}

	public function add($idmovie,$idgenre)
	{

		$movie = $this->MovieDao->bring_by_id_api($idmovie->getIdapi());
		$genre = $this->GenreDao->bring_by_id($idgenre);
		$moviegenre = new MovieGenre;
		$moviegenre->setMovie($movie); 
		$moviegenre->setGenre($genre);
		$this->MovieGenreDao->add($moviegenre);
	}

	public function bringbygender($idgenero)
	{
		die(var_dump($this->MovieGenreDao->bring_id_by_generoAll($idgenero)));

	}

}
