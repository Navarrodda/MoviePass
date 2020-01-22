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
		return $this->MovieGenreDao->bring_id_by_generoAll($idgenero);

	}

	public function bringbygenderidmovies($idgenero)
	{

		if($idgenero != null)
		{
			$moviesgenre = $this->bringbygender($idgenero);
			$idmovies = array();
			if ($moviesgenre != null) {
				foreach ($moviesgenre as $movgen) {
					array_push($idmovies, $movgen->getMovie());
				}
			}
		}
		return $idmovies;

	}	

	public function remove_by_id_movie($id)
	{
		$this->MovieGenreDao->remove_by_id_movie($id);
	}

	public function bring_id_by_MovieAll($idmovie)
	{
		return $this->MovieGenreDao->bring_id_by_MovieAll($idmovie);
	}

	public function gender_selection_by_id($idgenero){

		$genresel = array();
		$moviesgenre = $this->bringbygender($idgenero);
		foreach ($moviesgenre as $movgenre) {
			array_push($genresel, $movgenre->getGenre());
		}
		return $genresel;
	}

	public function move_selection_by_gender_id($idgenero){

		$value = array();
		$moviesgenre = $this->bringbygender($idgenero);
		foreach ($moviesgenre as $movgenre) {
			array_push($value, $movgenre->getMovie());
		}
		return $value;

	}
	public function bring_id_by_movie_for_genres($idgenero)
	{
		$moviesgenre = $this->bringbygender($idgenero);
		$idmovies = array();
		if ($moviesgenre != null) {
			foreach ($moviesgenre as $movgen) {
				array_push($idmovies, $movgen->getMovie()->getId());
			}
		}
		return $idmovies;
	}


}

