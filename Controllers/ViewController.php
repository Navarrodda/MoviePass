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
use \Controllers\FuctionController as Fuctionc;
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
		$this->ControlFuctionc = new Fuctionc;
	}

	public function index()
	{
		$funcion = $this->ControlFuctionc->bringeverything();
		if(empty($funcion))
		{
			$view = 'HOME';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "home.php");
			include URL_VISTA . 'footer.php';
		}
		else{
			$genresel = $this->ControlGenre->bring_everything();
			$cinema = $this->ControlCinema->bringeverything();
			$movies = array();
			$cinemas = array();
			if(!empty($cinema))
			{
				foreach ($cinema as $cin) {
					if($cin->getId() != null)
					{
						$tocinema = $this->ControlFuctionc->bring_Function_by_idCinema($cin->getId());
						if (!empty($tocinema)) {
							array_push($cinemas, $cin);
							foreach ($tocinema as $to) {
								if($to->getCinema()->getId() == $cin->getId())
								{
									array_push($movies, $to);
								}

							}
						}

					}
				}

			}
			$view = 'BILLBOARD';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "homebillboard.php");
			include URL_VISTA . 'footer.php';
		}

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
		$genresel = array();
		$value = array();
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

	public function modifycinema($idcinema)
	{

		$view = 'CINEMA';
		$espace = 'MODIFY';
		$cinema = $this->ControlCinema->bring_for_id($idcinema);
		$current_date = date ("Y-m-d");
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "modifycinema.php");
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
		$cinemas = $this->ControlCinema->bringeverything();
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
		$cinemas = $this->ControlCinema->bringeverything();
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
			$discount = $this->ControlDiscount->bring_everything();
			$i = 0;
			$current_date = date ("Y-m-d");
			if(!empty($discount))
			{
				foreach ($discount as $dis) {
					$fecha[$i] = date("Y-m-d", strtotime($dis->getFecha()));
					$i++;
				}
			}
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

		public function registerFunction($id)
		{	
			$view = 'REGISTRER FUNCTION';
			$movie = $this->ControlMovies->movieBdId($id);
			$cineList = array();
			$cineList = $this->ControlCinema->bringeverything();
			if(empty($cineList))
			{
				$this->message = new Message( "warning", "There are no registered cinemas!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "registrercinema.php");
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$current_date = date ("Y-m-d");
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "registerfunction.php");
				include URL_VISTA . 'footer.php';
			}
		}

		public function billboardforgenre($idgenre)
		{
			if(!empty($idgenre))
			{
				$fers = NULL;
				$last = -1;
				$i = 0;
				$idmovies = array();
				$genresel = $this->ControlGenre->bring_everything();
				$genre = $this->ControlGenre->bring_everything();
				$funcion = $this->ControlFuctionc->bringeverything();
				$moviesgenre = $this->ControlMuvGen->bringbygender($idgenre);
				$namegenre = $this->ControlGenre->bring_genre($idgenre);
				$namegenre = $namegenre->getName();
				if ($moviesgenre != null) {
					foreach ($moviesgenre as $movgen) {
						array_push($idmovies, $movgen->getMovie()->getId());
					}
				}
				$movies = array();
				$cinemas = array();
				if(!empty($idmovies))
				{
					foreach ($idmovies as $idm) {
						$tocinema = $this->ControlFuctionc->bring_Function_by_idMovies($idm);
						if (!empty($tocinema)) {
							foreach ($tocinema as $to) {
								if($to != NULL)
								{
									$movie = $to->getMovie()->getId();
									if($idm == $movie)
									{
										array_push($movies, $to);
										$id = $to->getCinema()->getId();
										if($fers != $id && $last != $id )
										{
											if(!empty($cinemas))
											{
												foreach ($cinemas as $cinemaa) {
													$idcinema= $cinemaa->getId();
													if($idcinema != $id)
													{
														array_push($cinemas, $to->getCinema());
													}
												}
											}
											else
											{

												array_push($cinemas, $to->getCinema());
											}
											$last = $fers;
											$fers = $id;
										}
									}

								}
							}
						}
					}

				}

				if($cinemas != NULL)
				{
					$this->message = new Message('info', ' The selected genre' . ' ' . '<i><strong>' .  $namegenre 
						. '</strong>. It has movies in cinemas!');
					$view = 'BILLBOARD';
					$espace = 'FOR GENRE';
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "billboardforgenre.php");
					include URL_VISTA . 'footer.php';
				}
				else
				{
					$genresel = $this->ControlGenre->bring_everything();
					$cinema = $this->ControlCinema->bringeverything();
					$movies = array();
					$cinemas = array();
					if(!empty($cinema))
					{
						foreach ($cinema as $cin) {
							$tocinema = $this->ControlFuctionc->bring_Function_by_idCinema($cin->getId());
							array_push($cinemas, $cin);
							foreach ($tocinema as $to) {
								array_push($movies, $to);
								$moviesgenre = $this->ControlMuvGen->bring_id_by_MovieAll($to->getMovie()->getId());

							}
						}
					}
					$this->message = new Message('warning', ' The selected genre' . ' ' . '<i><strong>' .  $namegenre 
						. '</strong>. does not contain any billboards. we are sorry!');
					$view = 'BILLBOARD';
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "homebillboard.php");
					include URL_VISTA . 'footer.php';
				}
			}
			else
			{
				$cinema = $this->ControlCinema->bringeverything();
				$genresel = $this->ControlGenre->bring_everything();
				$movies = array();
				$cinemas = array();
				$genresel = array();
				if(!empty($cinema))
				{
					foreach ($cinema as $cin) {
						$tocinema = $this->ControlFuctionc->bring_Function_by_idCinema($cin->getId());
						array_push($cinemas, $cin);
						foreach ($tocinema as $to) {
							array_push($movies, $to);
						}
					}
				}
				$this->message = new Message( "warning", "That genre does not contain movies!" );
				$view = 'BILLBOARD';
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "homebillboard.php");
				include URL_VISTA . 'footer.php';
			}
		}

		public function modifyfuction($idfuction)
		{

			$view = 'DISCOUNTS';
			$espace = 'MODIFY';

			$function = $this->ControlFuctionc->bringidfuction($idfuction);
			if(!empty($function))
			{
				$movie = $this->ControlMovies->movieBdId($function->getMovie()->getId());
				$cineList = array();
				$cineList = $this->ControlCinema->bringeverything();
				$current_date = date ("Y-m-d");
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "modifyfuction.php");
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$view = "MESSAGE";		
				$this->message = new Message( "warning", "The function does not exist!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
			
		} 


		public function billboardforsearch($search)
		{
			$home = false;
			$home = 1;
			$valid = $this->ControlFuctionc->validate_date($search);
			if(!empty($valid) && $valid != '1969-12-31')
			{
				$genresel = $this->ControlGenre->bring_everything();
				$cinema = $this->ControlCinema->bringeverything();
				$tocinema = $this->ControlFuctionc->bringe_for_data($valid);
				$movies = array();
				$cinemas = array();
				if(!empty($tocinema))
				{
					if(!empty($cinema))
					{
						foreach ($cinema as $cin) {
							if($cin->getId() != null)
							{

								if (!empty($tocinema)) {
									array_push($cinemas, $cin);
									foreach ($tocinema as $to) {
										if($to->getCinema()->getId() == $cin->getId())
										{
											array_push($movies, $to);
										}

									}


								}

							}
						}

					}
					$view = 'BILLBOARD';
					$espace = 'FOR GENRE';
					$home = 0;
					$this->message = new Message('info', 'The searched Date is' . ' ' . '<i><strong>' .  $search 
						. '</strong>. On this date there are functions:!');
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "billboardforgenre.php");
					include URL_VISTA . 'footer.php';	
				}
				else
				{
					$home = True;
					$view = 'BILLBOARD';
					$this->message = new Message('warning', 'The searched date' . ' ' . '<i><strong>' .  $search 
						. '</strong>. what do you want to search. We are sorry!');
				}		
			}
			else
			{
				$search = ucwords($search);
				$genresel = $this->ControlGenre->bring_everything();
				$idgenre = 	$this->ControlGenre->bring_genre_id_name($search);
				if($idgenre != null)
				{
					$moviesgenre = $this->ControlMuvGen->bringbygender($idgenre);
					$idmovies = array();
					if ($moviesgenre != null) {
						foreach ($moviesgenre as $movgen) {
							array_push($idmovies, $movgen->getMovie()->getId());
						}
					}
					$fers = NULL;
					$last = -1;
					$movies = array();
					$cinemas = array();
					if(!empty($idmovies))
					{
						foreach ($idmovies as $idm) {
							$tocinema = $this->ControlFuctionc->bring_Function_by_idMovies($idm);
							if (!empty($tocinema)) {
								foreach ($tocinema as $to) {
									if($to != NULL)
									{
										$movie = $to->getMovie()->getId();
										if($idm == $movie)
										{
											array_push($movies, $to);
											$id = $to->getCinema()->getId();
											if($fers != $id && $last != $id)
											{
												if(!empty($cinemas))
												{
													foreach ($cinemas as $cinemaa) {
														$idcinema= $cinemaa->getId();
														if($idcinema != $id)
														{
															array_push($cinemas, $to->getCinema());
														}
													}
												}
												else
												{

													array_push($cinemas, $to->getCinema());
												}
												$last = $fers;
												$fers = $id;
											}
										}

									}
								}
							}
						}

					}
					if($cinemas != NULL)
					{
						$home = 0;
						$this->message = new Message('info', ' The selected genre' . ' ' . '<i><strong>' .  $search 
							. '</strong>. It has movies in cinemas!');
						$view = 'BILLBOARD';
						$espace = 'FOR GENRE';
						include URL_VISTA . 'header.php';
						require(URL_VISTA . "billboardforgenre.php");
						include URL_VISTA . 'footer.php';
					}
					else
					{
						$home = 1;
						$this->message = new Message('warning', ' The selected genre' . ' ' . '<i><strong>' .  $search 
							. '</strong>. does not contain any billboards. we are sorry!');
					}
				}

			}
			if($home)
			{
				$search = ucwords($search);
				$genresel = $this->ControlGenre->bring_everything();
				$cinema = $this->ControlCinema->bringeverything();
				$movies = array();
				$cinemas = array();
				if(!empty($cinema))
				{
					foreach ($cinema as $cin) {
						$tocinema = $this->ControlFuctionc->bring_Function_by_idCinema($cin->getId());
						array_push($cinemas, $cin);
						foreach ($tocinema as $to) {
							array_push($movies, $to);
							$moviesgenre = $this->ControlMuvGen->bring_id_by_MovieAll($to->getMovie()->getId());

						}
					}
				}

				$this->message = new Message('warning', ' The selected Search' . ' ' . '<i><strong>' .  $search 
					. '</strong>. does not contain any billboards. we are sorry!');
				$view = 'BILLBOARD';
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "homebillboard.php");
				include URL_VISTA . 'footer.php';
			}
		}

		public function card()
		{

			$view = 'CARD';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "card.php");
			include URL_VISTA . 'footer.php';
		} 
	}
