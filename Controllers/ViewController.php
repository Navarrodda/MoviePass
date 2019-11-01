<?php

namespace Controllers;

//Modelo
use \Model\User as User;
use \Model\Message as Message;
//Controler
use \Controllers\MovieController as MoviesC;
use \Controllers\GenreController as GenreC;
use \Controllers\CinemaController as CinemaC;
use \Controllers\UserController as UserC;
use \Controllers\MoviegenreController as MoviegenreC;
use \Controllers\DiscountController as DiscountC;
//Dao
use \Dao\UserBdDao as UserBD;

class ViewController
{

	public function __construct()
	{
		$this->daoUser = UserBD::getInstance();
		$this->ControlMovies = new MoviesC;
		$this->ControlGenre = new GenreC;
		$this->ControlCinema = new CinemaC;
		$this->ControlUser = new UserC;
		$this->ControlMuvGen = new MoviegenreC;
		$this->ControlDiscount = new DiscountC;
	}

	public function index()
	{
		
		$view = 'HOME';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "home.php");
		include URL_VISTA . 'footer.php';
		/*
		$view = 'Billboard';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "homebillboard.php");
		include URL_VISTA . 'footer.php';
		*/
		
	} 

	public function register()
	{

		$view = 'REGISTER';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrer.php");
		include URL_VISTA . 'footer.php';
	} 

	public function login()
	{

		$view = 'LOGIN';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "login.php");
		include URL_VISTA . 'footer.php';
	} 

	public function feature()
	{

		$view = 'FEATURE';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "feature.php");
		include URL_VISTA . 'footer.php';
	} 

	public function message()
	{

		$view = 'MESSAGE';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "message.php");
		include URL_VISTA . 'footer.php';
	}

	public function account()
	{
		$view = 'ACCOUNT';
		$user = $this->ControlUser->bring_by_id();
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "account.php");
		include URL_VISTA . 'footer.php';
	}

	public function modifyaccount()
	{
		$view = 'ACCOUNT';
		$espace = 'MODIFY';
		$user = $this->ControlUser->bring_by_id();
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "modifyaccount.php");
		include URL_VISTA . 'footer.php';
	}

	public function movies()
	{
		$view = 'MOVIES';
		$count = 3;
		$page = 1;
		$emty = $page;
		$values = $this->ControlMovies->getList(1);
		$value = $this->ControlMovies->bringmovies();
		$i = 0;
		foreach ($values as $data) {

			if($this->ControlMovies->bring_id_by_idapi($data->getIdapi()))
			{
				$values[$i]->codigo = TRUE;

			}
			else
			{
				$values[$i]->codigo = FALSE;
			}
			$i++;
		}
		$genere = $this->ControlGenre->getList();
		$length = $this->ControlMovies->getAllPages();
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "movies.php");
		include URL_VISTA . 'footer.php';
	}

	public function genre($genre, $id)
	{
		$view = 'MOVIES'.' '.' '.'->'. ' '.'GENRE';
		$values = NULL;
		$page = 1;
		$values = $this->ControlMovies->getMovieByGenre($id);
		$genere = $this->ControlGenre->getList();

		$i = 0;
		foreach ($values as $data) 
		{
			if($this->ControlMovies->bring_id_by_idapi($data->getIdapi()))
			{
				$values[$i]->codigo = TRUE;
			}
			else
			{
				$values[$i]->codigo = FALSE;
			}
			$i++;
		}
		$strip = array("~", "`", "!", "@", "#", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
			"}", "\\", "|", ";", ":", "\"", "'", "&#;", "&#;", "3", "4","5","6","7","8","9","10","9", "â€”", "â€“", ",", "<", ".", ">", "/", "?","20");
		$genre = trim(str_replace($strip, " ", strip_tags($genre)));
		$genre = preg_replace('/\s+/', " ", $genre);
		$titule = ucwords($genre);	

		include URL_VISTA . 'header.php';
		require(URL_VISTA . "genre.php");
		include URL_VISTA . 'footer.php';
	}

	public function registrercinema()
	{
		$view = 'REGISTRER CINEMA';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrercinema.php");
		include URL_VISTA . 'footer.php';
	}

	public function cinema()
	{
		$view = 'CINEMA';
		$values = $this->ControlCinema->bringeverything();
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "cinemas.php");
		include URL_VISTA . 'footer.php';
	}

	public function moviespages($emty,$pages,$count,$buton)
	{
		$view = 'MOVIES';
		$length = $this->ControlMovies->getAllPages();
		if($buton == 1){ 
			$page = $pages;
			$count = $count + 3;
			$emty = $count - 2;
		}
		if ($buton == 2) 
		{
			$emty = $count -2;
			$page = $pages;
			$count = $count;
		}		
		if($buton == -1){ 
			$emty = $emty - 3;
			$page = $pages -3;
			$count = $count - 3;
		}
		$value = $this->ControlMovies->bringmovies();
		$values = $this->ControlMovies->getList($page);
		$genere = $this->ControlGenre->getList();
		$i = 0;
		foreach ($values as $data) {

			if($this->ControlMovies->bring_id_by_idapi($data->getIdapi()))
			{
				$values[$i]->codigo = TRUE;

			}
			else
			{
				$values[$i]->codigo = FALSE;
			}
			$i++;
		}

		include URL_VISTA . 'header.php';
		require(URL_VISTA . "movies.php");
		include URL_VISTA . 'footer.php';
	}

	public function mymovies()
	{

		$view = 'MY MOVIES';
		$genre = $this->ControlGenre->bring_everything();
		$value = $this->ControlMovies->bringmovies();
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "mymovies.php");
		include URL_VISTA . 'footer.php';
	} 

	public function mymoviegenres($idgenre)
	{
		$view = 'My Movies';
		$espace = 'Genre';
		$genresel = array();
		$value = array();
		$genre = $this->ControlGenre->bring_everything();
		$moviesgenre = $this->ControlMuvGen->bringbygender($idgenre);
		if ($moviesgenre != null) {
			foreach ($moviesgenre as $movgenre) {
				array_push($genresel, $movgenre->getGenre());
				array_push($value, $movgenre->getMovie());
			}
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "mymoviegenres.php");
			include URL_VISTA . 'footer.php';
		}
		else
		{	$genresel = NULL;
			$this->message = new Message( "warning", "That genre does not contain movies!" );
			$genre = $this->ControlGenre->bring_everything();
			$value = $this->ControlMovies->bringmovies();
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "mymovies.php");
			include URL_VISTA . 'footer.php';
		}

	} 

	public function discounts()
	{

		$view = 'DISCOUNTS';
		$discount = $this->ControlDiscount->bring_everything();
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "discounts.php");
		include URL_VISTA . 'footer.php';
	} 

	public function registrerdiscounts()
	{

		$view = 'DISCOUNTS';
		$espace = 'REGISTRED';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrerdiscounts.php");
		include URL_VISTA . 'footer.php';
	} 

		public function modifydiscounts($id)
	{

		$view = 'DISCOUNTS';
		$espace = 'MODIFY';
		$discount = $this->ControlDiscount->bring_data_id($id);
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "modificationdiscounts.php");
		include URL_VISTA . 'footer.php';
	} 

}