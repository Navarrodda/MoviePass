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
use \Controllers\RoomController as Roomc;
use \Controllers\ShoppingController as Shoppingc;
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
		$this->ControlRoom = new Roomc;
		$this->ControlShopping = new Shoppingc;
	}

	public function index()
	{
		$current_date = date ("d-m-Y G:m.a");
		$movie = $this->ControlMovies->bringmovies();
		$movies = array();
		$roomcinema = array();
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->ControlFuctionc->bring_Function_by_idMovies($mov->getId());
				if(!empty($thisfunction))
				{
					array_push($movies, $mov);
					foreach ($thisfunction as $fun) {
						array_push($roomcinema, $fun);
					}
				}
			}
		}
		if(empty($movies))
		{

			$view = 'HOME';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "home.php");
			include URL_VISTA . 'footer.php';
		}
		else{
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
			$room = $this->ControlRoom->bringeverything();
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

			$view = 'MODIFY';
			$espace = 'FUNCTION';

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

		public function modifyroomfuction($idfuction,$idcinema,$day,$hour)
		{	
			$day = $day;
			$hour = $hour;
			$cinema = $this->ControlCinema->bring_for_id($idcinema);
			if(!empty($cinema))
			{
				$function = $this->ControlFuctionc->bringidfuction($idfuction);
				$room = $this->ControlRoom->bring_list_for_id_cinema($idcinema);
				$movie = $this->ControlMovies->movieBdId($function->getMovie()->getId());
				if(!empty($room))
				{

					$view = 'MODIFY';
					$espace = 'ROOMS';
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "modifyroomfunction.php");
					include URL_VISTA . 'footer.php';
				}
				else 
				{
					$view = 'REGISTER';
					$espace = 'ROOM';
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "registeroom.php");
					include URL_VISTA . 'footer.php';
				}
			}
			else {
				$view = "MESSAGE";		
				$this->message = new Message( "warning", "The Cinema does not exist!" );
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
				$current_date = $search;
				$movies = array();
				$roomcinema = array();
				$tocinema = $this->ControlFuctionc->bringe_for_data($valid);
				$movie = $this->ControlMovies->bringmovies();
				$chequin = false;
				if(!empty($movie))
				{
					foreach ($movie as $mov) {
						$thisfunction = $this->ControlFuctionc->bring_Function_by_idMovies($mov->getId());
						$chequin = false;
						if(!empty($thisfunction))
						{
							foreach ($thisfunction as $fun) {
								if($valid == $fun->getDia())
								{
									array_push($roomcinema, $fun);
									$chequin = True;
								}

							}
							if($chequin)
							{
								array_push($movies, $mov);
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

				$current_date = date ("d-m-Y G:m.a");
				$search = ucwords($search);
				$movie = $this->ControlMovies->bringmovies();
				$idgenre = 	$this->ControlGenre->bring_genre_id_name($search);
				$movies = array();
				$roomcinema = array();
				if(!empty($movie))
				{
					if($idgenre != null)
					{
						$moviesgenre = $this->ControlMuvGen->bringbygender($idgenre);
						$idmovies = array();
						if ($moviesgenre != null) {
							foreach ($moviesgenre as $movgen) {
								array_push($idmovies, $movgen->getMovie());
							}
						}
						if(!empty($idmovies))
						{
							foreach ($idmovies as $idm) {
								$thisfunction = $this->ControlFuctionc->bring_Function_by_idMovies($idm->getId());
								if(!empty($thisfunction))
								{
									array_push($movies, $idm);
									foreach ($thisfunction as $fun) {
										array_push($roomcinema, $fun);
									}
								}
							}
						}
						if(!empty($movies))
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

			}
			$movie = $this->ControlMovies->bring_by_name($search);
			if(!empty($movie))
			{
				foreach ($movie as $mov) {
					$thisfunction = $this->ControlFuctionc->bring_Function_by_idMovies($mov->getId());
					if(!empty($thisfunction))
					{
						array_push($movies, $mov);
						foreach ($thisfunction as $fun) {
							array_push($roomcinema, $fun);
						}
					}
				}
				$home = 0;
				$this->message = new Message('info', ' The selected Titile Muvie' . ' ' . '<i><strong>' .  $search 
					. '</strong>. It has movies in cinemas!');
				$view = 'BILLBOARD';
				$espace = 'FOR GENRE';
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "billboardforgenre.php");
				include URL_VISTA . 'footer.php';

			}
			if($home)
			{
				$current_date = date ("d-m-Y G:m.a");
				$movie = $this->ControlMovies->bringmovies();
				$movies = array();
				$roomcinema = array();
				if(!empty($movie))
				{
					foreach ($movie as $mov) {
						$thisfunction = $this->ControlFuctionc->bring_Function_by_idMovies($mov->getId());
						if(!empty($thisfunction))
						{
							array_push($movies, $mov);
							foreach ($thisfunction as $fun) {
								array_push($roomcinema, $fun);
							}
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

		public function card($quantity,$typecard,$iddiscount,$idfuction)
		{
			$flag = false;
			$fuction = $this->ControlFuctionc->bringidfuction($idfuction);
			$movie = $fuction->getMovie();
			$room =  $fuction->getRoom();
			$cinema = $fuction->getRoom()->getCinema();
			$discount = $this->ControlDiscount->give_discount_day($fuction->getDia());

			if(!empty($_SESSION))
			{
				if($idquantity >0 && $idquantity <= 10)
				{
					if(!empty($fuction) )
					{
						if($typecard != "select")
						{
							if($typecard == "visa")
							{
								$card = 1;
							}
							else{
								$card = 0;
							}
								$view = 'CARD';
								include URL_VISTA . 'header.php';
								require(URL_VISTA . "card.php");
								include URL_VISTA . 'footer.php';
						
						}else
						{
							$this->message = new Message('warning', 'Choose a Type of Card ');
							$flag = true;
						}
						
					}else
					{
						$this->message = new Message('warning', ' The Function is not Available');
						$view = 'BILLBOARD';
						include URL_VISTA . 'header.php';
						require(URL_VISTA . "homebillboard.php");
						include URL_VISTA . 'footer.php';
					}
					
				}
				else
				{
					$this->message = new Message('warning', 'Quantity not Valid ');
					$flag = true;
				}
					
				
				
			}else 
			{
				$this->message = new Message('warning', 'User not logged ');
				$view = 'LOGIN';
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "login.php");
				include URL_VISTA . 'footer.php';
			}

			if($flag)
			{
				
				$view = "Buy Process ";
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "buyq.php");
				include URL_VISTA . 'footer.php';	
			}
			
			
		} 

		public function listroom($idcinema)
		{	
			$cinema = $this->ControlCinema->bring_for_id($idcinema); 
			$room = $this->ControlRoom->bring_list_for_id_cinema($idcinema);
			if(!empty($cinema))
			{
				if(!empty($room))
				{

					$view = 'CINEMA';
					$espace = 'ROOMS';
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "rooms.php");
					include URL_VISTA . 'footer.php';
				}
				else 
				{
					$view = 'REGISTER';
					$espace = 'ROOM';
					include URL_VISTA . 'header.php';
					require(URL_VISTA . "registeroom.php");
					include URL_VISTA . 'footer.php';
				}
			}
			else {
				$view = "MESSAGE";		
				$this->message = new Message( "warning", "The Cinema does not exist!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			} 
		} 

		public function registeroom($idcinema)
		{
			$cinema = $this->ControlCinema->bring_for_id($idcinema); 
			$view = 'CINEMA';
			$espace = 'ROOMS';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "registeroom.php");
			include URL_VISTA . 'footer.php';
		} 

		public function buyq($idfuction)
		{
			$fuction = $this->ControlFuctionc->bringidfuction($idfuction);
			$movie = $fuction->getMovie();
			$room =  $fuction->getRoom();
			$cinema = $fuction->getRoom()->getCinema();
			$discount = $this->ControlDiscount->give_discount_day($fuction->getDia());
			$view = "Buy Process ";
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "buyq.php");
			include URL_VISTA . 'footer.php';
		}

		public function buyseat()
		{
			$view = "Seat Process ";
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "seat.php");
			include URL_VISTA . 'footer.php';
		}




		public function selectroom($idcinema,$day,$hour,$idmovie)
		{
			if(!empty($_SESSION))
			{

				$cinema = $this->ControlCinema->bring_for_id($idcinema);

				if (!empty($cinema)) {
					$regle = $this->ControlFuctionc->validate_day_hours($day,$hour);
					$movie = $this->ControlMovies->movieBdId($idmovie);
					if($regle)
					{
						$question = $this->ControlFuctionc->tomakeatoast_day_and_cinema_with_movie($day,$idcinema,$idmovie);
						if($question)
						{
							$room = $this->ControlRoom->bring_list_for_id_cinema($idcinema);
							if(!empty($room))
							{
								$view = 'REGISTRER';
								$espace = 'FUNCTION ROOMS';
								$wear = 'registerfunctionroom';
							}
							else
							{
								$this->message = new Message('warning', ' There are no rooms registered in the cinema:' . ' ' . '<i><strong>' .  $cinema->getNombre()
									. '</strong>. Register rooms to register functions');
								$view = 'CINEMA';
								$espace = 'ROOMS';
								$wear = 'registeroom';
							}

						}
						else
						{
							$view = "MESSAGE";
							$wear =  strtolower($view);
							$this->message = new Message("warning","The selected movie is already in another movie Cinema!" );
						}
					}
					else
					{
						$view = "MESSAGE";
						$wear =  strtolower($view);
						$this->message = new Message("warning","the selected day and time has passed!" );
					}
				} 
			}
			else
			{
				$view = "LOGIN";
				$wear =  strtolower($view);
				$this->message = new Message("warning","without a session started!" );
			}

			$wear = $wear . '.'.'php';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . $wear);
			include URL_VISTA . 'footer.php';
		}

		public function purchasetikets()
		{
			if(!empty($_SESSION))
			{
				$current_date = date ("d-m-Y G:m.a");
				$purchasetikets = $this->ControlShopping->purchasetikets($_SESSION["rol"]);
				$view = "PURCHASED TICKETS";
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "purchasetikets.php");
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$view = 'LOGIN';
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "login.php");
				include URL_VISTA . 'footer.php';
			}
		}


	}