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
use \Controllers\TicketController as TicketC;
//Dao

class ViewController
{

	public function __construct()
	{
		$this->ControlMovies = new MoviesC;
		$this->ControlGenre = new GenreC;
		$this->ControlCinema = new CinemaC;
		$this->ControlUser = new UserC;
		$this->ControlMuvGen = new MoviegenreC;
		$this->ControlDiscount = new DiscountC;
		$this->ControlFuctionc = new Fuctionc;
		$this->ControlRoom = new Roomc;
		$this->ControlShopping = new Shoppingc;
		$this->ControlTicket = new TicketC;
	}

	public function index()
	{
		$current_date = date ("d-m-Y G:m.a");
		$movies = $this->ControlFuctionc->movie_extraction_algorithm();
		$roomcinema = $this->ControlFuctionc->feature_extraction_algorithm();
		if(empty($movies))
		{
			$view = 'HOME';
			$wear =  strtolower('HOME'). '.' .'php';
		}
		else{
			$view = 'BILLBOARD';
			$wear =  strtolower('homebillboard'). '.' .'php';
		}
		include URL_VISTA . 'header.php';
		require(URL_VISTA . $wear);
		include URL_VISTA . 'footer.php';
	}

	public function register()
	{
		$intranet = $this->ControlUser->validate_connection_for_faceboock();
		$view = 'REGISTER';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrer.php");
		include URL_VISTA . 'footer.php';
	} 

	public function login()
	{
		$intranet = $this->ControlUser->validate_connection_for_faceboock();
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
		$values = $this->ControlMovies->movies_stored_in_the_bd(1);
		if(!empty($values))
		{
			$genere = $this->ControlGenre->getList();
			$length = $this->ControlMovies->getAllPages();
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "movies.php");
			include URL_VISTA . 'footer.php';
		}
		else
		{
			$view = "MESSAGE";		
			$this->message = new Message( "info", "At this time there are no movies to show trying later!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'message.php');
			include URL_VISTA . 'footer.php';
		}
	}

	public function genre($genre, $id)
	{
		$view = 'MOVIES'.' '.' '.'->'. ' '.'GENRE';
		$values = NULL;
		$page = 1;
		$values = $this->ControlMovies->getMovieByGenre($id);
		$genere = $this->ControlGenre->getList();
		$values = $this->ControlMovies->movies_stored_in_the_bd(1);
		$titule = $this->ControlGenre->gender_name_modification($genre);
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

	public function modifyroom($idroom)
	{

		$view = 'ROOM';
		$espace = 'MODIFY';
		$room = $this->ControlRoom->bring_by_id($idroom);
		$current_date = date ("Y-m-d");
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "modifyroom.php");
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
		$values = $this->ControlMovies->movies_stored_in_the_bd($pages);
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
		$cinemas = $this->ControlCinema->bringeverything();
		$genre = $this->ControlGenre->bring_everything();
		$genresel = $this->ControlMuvGen->gender_selection_by_id($idgenre);
		$value = $this->ControlMuvGen->move_selection_by_gender_id($idgenre);
		if ($genresel != null) {
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
			$fecha = $this->ControlDiscount->modification_of_discount_dates_to_d_m_y();
			$current_date = date ("Y-m-d");
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
			$home = 1;
			$current_date = date ("d-m-Y G:m.a");

			$valid = $this->ControlFuctionc->validate_date($search);

			if(!empty($valid) && $valid != '1969-12-31')
			{
				$current_date = $search;
				$roomcinema = $this->ControlFuctionc->bring_Function_by_function_for_data($valid);
				$movies = $this->ControlFuctionc->bring_Function_by_movies_for_data($valid);
				$view = 'BILLBOARD';
				$espace = 'FOR GENRE';
				
				if($movies != null)
				{
					$home = 0;
					$this->message = new Message('info', 'The searched Date is' . ' ' . '<i><strong>' .  $search 
						. '</strong>. On this date there are functions:!');
				}
				else
				{
					$home = 1;
					$this->message = new Message('warning', ' The searched Date is' . ' ' . '<i><strong>' .  $search 
						. '</strong>. does not contain any billboards. we are sorry!');
				}
			}
			else
			{
				if($home == 1)
				{
					$search = ucwords($search);
					$movies = $this->ControlFuctionc->bring_by_genre_id_muvies($search);
					$roomcinema = $this->ControlFuctionc->bring_by_genre_id_fuction($search);
					if(!empty($movies))
					{
						$home = 0;
						$this->message = new Message('info', ' The selected genre' . ' ' . '<i><strong>' .  $search 
							. '</strong>. It has movies in cinemas!');
						$view = 'BILLBOARD';
						$espace = 'FOR GENRE';
					}
					else
					{
						$home = 1;
						$this->message = new Message('warning', ' The selected genre' . ' ' . '<i><strong>' .  $search 
							. '</strong>. does not contain any billboards. we are sorry!');
					}
				}
			}
			if(!empty($movies))
			{
				$home = 0;
				$this->message = new Message('info', ' The selected Titile Muvie' . ' ' . '<i><strong>' .  $search 
					. '</strong>. It has movies in cinemas!');
				$view = 'BILLBOARD';
				$espace = 'FOR GENRE';


			}
			if($home)
			{
				$movies = $this->ControlFuctionc->movie_extraction_algorithm();
				$roomcinema = $this->ControlFuctionc->feature_extraction_algorithm();
				$this->message = new Message('warning', ' The selected Search' . ' ' . '<i><strong>' .  $search 
					. '</strong>. does not contain any billboards. we are sorry!');
				$view = 'BILLBOARD';
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "homebillboard.php");
				include URL_VISTA . 'footer.php';
			}
			else
			{
				
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "billboardforgenre.php");
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
				if($quantity >0 && $quantity <= 10)
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
			$max = $this->ControlShopping->cant_tiket_for_function_bacanci($idfuction);
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
				$fers = null;
				$fersfun = null;
				$count = -1;
				$idmovies= array();
				$i=0;
				$q=1;
				$movies = array();
				$funct = array();
				$user = $this->ControlUser->bring_by_id();
				$purchasetikets = $this->ControlShopping->purchasetikets($user->getId());
				if(!empty($purchasetikets))
				{
					foreach ($purchasetikets as $purc) {
						if(!empty($purc))
						{
							if($purc->getFunction()->getMovie() != $fers){
								array_push($idmovies, $purc->getFunction()->getMovie()->getId());

								$fers = $purc->getFunction()->getMovie();			
							}
							if($purc->getFunction()->getDia() != $fersfun)
							{
								array_push($funct, $purc);
								$i = 0;
								$count++;
								$funct[$count]->coun = $purc->getCountrtiket();

							}
							else
							{
								$i++;
								$funct[$count]->coun = $funct[$count]->coun + $purc->getCountrtiket();

							}
							$q++;
							$fersfun = $purc->getFunction()->getDia();
						}
						$fersfun = null;
					}
				}
				if(!empty($idmovies))
				{
					$resultado = array_unique($idmovies);		
					foreach ($resultado as $re) {
						array_push($movies, $this->ControlMovies->movieBdId($re));		
					}
				}
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


		public function print($movieId,$functiondata)
		{
			if(!empty($_SESSION))
			{
				$funct = array();
				$tiket = array();
				$user = $this->ControlUser->bring_by_id();
				$purchasetikets = $this->ControlShopping->purchasetikets($user->getId());
				if(!empty($purchasetikets))
				{
					foreach ($purchasetikets as $purc) {
						if(!empty($purc))
						{
							if($purc->getFunction()->getDia() == $functiondata)
							{
								if($purc->getFunction()->getMovie()->getId() == $movieId)
								{
									array_push($funct, $purc);
									$tikets = $this->ControlTicket->brindforidshopping($purc->getId());
									if(!empty($tikets))
									{

										array_push($tiket, $tikets);

									}

								}
							}
						}
					}
				}
				require(URL_VISTA . "print.php");
			}
			else
			{
				$view = 'LOGIN';
				include URL_VISTA . 'header.php'; 
				require(URL_VISTA . "login.php");
				include URL_VISTA . 'footer.php';
			}
		}

		public function grafic()
		{
			if(!empty($_SESSION))
			{
				$current_date = date ("d-m-Y G:m.a");
				$movies = $this->ControlFuctionc->bring_movies_and_function_for_buys();
				$roomcinema = $this->ControlFuctionc->brind_grafic_buys();
				$view = 'GRAPHIC';
				include URL_VISTA . 'header.php'; 
				require(URL_VISTA . "graphic.php");
				include URL_VISTA . 'footer.php';
			}

		}

		public function remanets_buys($option,$search)
		{
			$current_date = date ("d-m-Y G:m.a");
			if($option == 0)
			{
				$this->message = new Message("warning","you have not chosen an option!" );
				$this->grafic();
			}
			if($option == 1)
			{
				$movies = $this->ControlFuctionc->remanete_buy_for_movie($search);
				if (!empty($search)){
					$this->message = new Message('info', ' You have searched for the following' . ' ' . '<i><strong>' .  $search 
						. '</strong>.');

				}
				else
				{
					$this->message = new Message("info","As you have not sent anything we bring you all sales!" );
				}
				$view = 'REMNENTSMOVIE';
				include URL_VISTA . 'header.php'; 
				require(URL_VISTA . "remnentsmovies.php");
				include URL_VISTA . 'footer.php';
			}
			if($option == 2)
			{
				$cinemas = $this->ControlCinema->remanete_buy_for_cinemas($search);
				if (!empty($search)){
					$this->message = new Message('info', ' You have searched for the following' . ' ' . '<i><strong>' .  $search 
						. '</strong>.');
				}
				else
				{
					$this->message = new Message("info","As you have not sent anything we bring you all sales!" );
				}
				$view = 'REMNENTSCINEMA';
				include URL_VISTA . 'header.php'; 
				require(URL_VISTA . "remnentscinema.php");
				include URL_VISTA . 'footer.php';
				
			}
		}

	}