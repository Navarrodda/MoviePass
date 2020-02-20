<?php
namespace Controllers;
//Model

use \Model\Message as Message;
use \Model\Room as Room;
use \Model\Movie as Movie;
use \Model\Fuction as Fuction;

//Controllers

use \Controllers\GenreController as GenreC;
use \Controllers\MovieController as MoviesC;
use \Controllers\MoviegenreController as MoviegenreC;
use \Controllers\ShoppingController as Shoppingc;
//Dao

use \Dao\RoomBdDao as RoomBdDao;
use \Dao\MovieBdDao as MovieBdDao;
use \Dao\FunctionBdDao as FunctionBd;


class FuctionController
{
	private $genreC;
	private $moviegenreC;
	private $RoomBdDao;
	private $movieBdDao;
	private $fuctionBdDao;

	public function __construct()
	{
		$this->genreC = new GenreC;
		$this->moviegenreC = new MoviegenreC;
		$this->RoomBdDao = RoomBdDao::getInstance();
		$this->movieBdDao = MovieBdDao::getInstance();
		$this->fuctionBdDao = FunctionBd::getInstance();
	}

	public function add($room,$day,$hour,$movie)
	{
		$function = new Fuction();
		$function->setRoom($room);
		$function->setMovie($movie);
		$function->setDia($day);
		$function->setHora($hour);
		$this->fuctionBdDao->add($function);
	}

	public function check_time_and_room_to_add($idroom,$day,$hour,$idmovie)
	{	
		if(!empty($_SESSION))
		{
			$regle = false;
			$listday = $this->fuctionBdDao->bring_by_day_for_room($day,$idroom);
			$reg = $this->fuctionBdDao->bring_by_day_for_room_and_movie($day,$idroom,$idmovie);
			$regla = $this->bring_by_date_idroom_hour($idroom,$day,$hour);
			if($regla === null && $reg === false)
			{
				
				$ve = '00:15:00';
				$veda[1]=explode(':',$ve);
				$separar[1]=explode(':',$hour);
				if(!empty($listday))
				{
					foreach ($listday as $dayfun) {
						$hourss = $dayfun->getHora();
						$separar[2]=explode(':',$hourss);

						if($hour > $hourss)
						{
							$total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1]+$dayfun->getMovie()->getDuration()+$veda[1][1];
							$total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1]; 
							$total_minutos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2];
							if($total_minutos>=0)
							{
								$regle = true;
							}

						}
						else
						{
							$total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1];
							$total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1]+$dayfun->getMovie()->getDuration()+$veda[1][1]; 

							$total_minutos = $total_minutos_trasncurridos[2]-$total_minutos_trasncurridos[1];
							if($total_minutos>=0)
							{
								$regle = true;
							}
						}
						if(!$regle)
						{
							$view = "MESSAGE";
							$wear =  strtolower($view);
							$this->message = new Message( "warning", "Does not meet the duration!" );
						}

					}
				}
				else
				{
					$regle = true;
				}
			}
			else
			{
				$view = "MESSAGE";
				$wear =  strtolower($view);
				$this->message = new Message( "warning", "Existing Fuction with that date and that hour!" );
			}
			

		}
		else
		{
			$view = "LOGIN";
			$wear =  strtolower($view);
			$this->message = new Message( "warning", "Must login!" );
		}

		if($regle)
		{
			$room = $this->RoomBdDao->bring_by_id($idroom);
			$movie = $this->movieBdDao->bring_by_id($idmovie);
			$this->add($room,$day,$hour,$movie);
			$view = "MESSAGE";
			$wear =  strtolower($view);
			$this->message = new Message( "success", "Function loaded successfully!" );

		}
		$wear = $wear . '.'.'php';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . $wear);
		include URL_VISTA . 'footer.php';
	}





	public function validate_day_hours($day,$hour)
	{

		$hoursnaw = date("G:i");
		$dianaw = date ("Y-m-d");
		$modification = $dianaw .'/'. $hoursnaw;
		$modificationthisday = $day .'/'. $hour;
		$movieforcinema = false;
		if($modificationthisday >= $modification)
		{
			$movieforcinema = TRUE;
		}
		return $movieforcinema;
	}

	public function tomakeatoast_day_and_cinema_with_movie($day,$idcinema,$idmovie)
	{ if(!empty($_SESSION))
		{
			$movieforcinema = false;
			$movie = $this->movieBdDao->bring_by_id($idmovie);
			if($movie != NULL)
			{
				$funcionmuvie =$this->fuctionBdDao->bring_Function_by_idMovies_for_day($idmovie,$day);
				if(!empty($funcionmuvie))
				{
					foreach ($funcionmuvie as $miviefun) {
						$room = $this->RoomBdDao->bring_by_id($miviefun->getRoom()->getId());
						if($room->getCinema()->getId() == $idcinema)
						{
							$movieforcinema = TRUE;
						}
					}
				}
				else
				{
					$movieforcinema = TRUE;
				}
			}
		}
		return $movieforcinema;
	}

	public function tomakeatoast_day_and_cinema_for_room_with_movie($idroom,$day,$idmovie)
	{

		if(!empty($_SESSION))
		{
			$hoursnaw = date("G:i");
			$dianaw = date ("Y-m-d");
			$modification = $dianaw .'/'. $hoursnaw;
			$modificationthisday = $day .'/'. $hour;
			if($modificationthisday >= $modification)
			{
				$movieforcinema = false;

				$movie = $this->movieBdDao->bring_by_id($idmovie);

				if($movie != NULL)
				{
					$funcionmuvie =$this->fuctionBdDao->bring_Function_by_idMovies_for_day($idmovie,$day);

					if(!empty($funcionmuvie))
					{

						foreach ($funcionmuvie as $miviefun) {
							if($miviefun->getCinema()->getId() == $idcinema)
							{
								$movieforcinema = TRUE;

							}

						}
					}
					else
					{
						$movieforcinema = TRUE;
					}
				}
			}
		}
		return $movieforcinema;
	}


	public function validate_cinema_day_and_room_for_movie($idcinema,$day,$idmovie)
	{

		if(!empty($_SESSION))
		{
			$hoursnaw = date("G:i");
			$dianaw = date ("Y-m-d");
			$modification = $dianaw .'/'. $hoursnaw;
			$modificationthisday = $day .'/'. $hour;
			if($modificationthisday >= $modification)
			{
				$movieforcinema = false;

				$movie = $this->movieBdDao->bring_by_id($idmovie);

				if($movie != NULL)
				{
					$funcionmuvie =$this->fuctionBdDao->bring_Function_by_idMovies_for_day($idmovie,$day);

					if(!empty($funcionmuvie))
					{

						foreach ($funcionmuvie as $miviefun) {
							if($miviefun->getCinema()->getId() == $idcinema)
							{
								$movieforcinema = TRUE;

							}

						}
					}
					else
					{
						$movieforcinema = TRUE;
					}
				}
			}
		}
		return $movieforcinema;
	}


	public function  bring_Function_by_idroom($id)
	{
		return $this->fuctionBdDao->bring_Function_by_idroom($id);
	}

	public function bring_by_function($idcinema,$day,$idmovie,$hour)
	{
		return $this->fuctionBdDao->bring_by_function($idcinema,$day,$idmovie,$hour);
	}

	public function bring_Function_by_idMovies($idmovie)
	{
		return $this->fuctionBdDao->bring_Function_by_idMovies($idmovie);
	}

	public function bring_Function_by_function_for_data($data)
	{
		$roomcinema = array();
		$movie = $this->movieBdDao->bring_everything();
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->bring_Function_by_idMovies($mov->getId());
				if(!empty($thisfunction))
				{
					foreach ($thisfunction as $fun) {
						if($data == $fun->getDia())
						{

							array_push($roomcinema, $fun);
						}

					}
				}
			}
		}
		return $roomcinema;
	}

	public function bring_Function_by_movies_for_data($data)
	{
		
		$chequin = false;
		$movies = array();
		$movie = $this->movieBdDao->bring_everything();
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->bring_Function_by_idMovies($mov->getId());
				$chequin = false;
				if(!empty($thisfunction))
				{
					foreach ($thisfunction as $fun) {
						if($data == $fun->getDia())
						{
							$chequin = True;
						}

					}
					if($chequin)
					{
						array_push($movies, $mov);
					}
				}
			}
		}
		return $movies;
	}

	public function bringidfuction($idfuction)
	{
		return $this->fuctionBdDao->bring_by_id($idfuction);
	}

	public function removefunctionforroom($idroom)
	{
		return $this->fuctionBdDao->remove_by_id_cinema_room($idroom);
	}

	public function removefuctionmovie($idmovie)
	{
		$this->fuctionBdDao->remove_by_id_movie($idmovie);
	}

	public function bringeverything()
	{
		return $this->fuctionBdDao->bring_everything();
	}

	public function validate_date($date)
	{
		$brithdate = explode('/', $date);
		if(!empty($brithdate[2])){
			$brithdateFormated = $brithdate[2] . "-" . $brithdate[1] . "-" . $brithdate[0];
			if (date('d-m-Y', strtotime($brithdateFormated))) {
				return $brithdateFormated;
			} 
		}
		return null;
	}



	public function bringe_for_data($data)
	{
		return $this->fuctionBdDao->bringe_for_data($data);
	}

	public function removefuctionmovieandmensaj($idfuction)
	{

		if($idfuction)
		{

			$function = $this->fuctionBdDao->bring_by_id($idfuction);
			if(!empty($function))
			{
				$movie = $function->getMovie();

				if(!empty($movie))
				{
					$data = date("d-m-Y", strtotime($function->getDia()));
					$this->fuctionBdDao->remove_by_id($idfuction);
					$view = "MESSAGE";
					$this->message = new Message('success', ' The functions with the name of the movie:' . ' ' . '<i><strong>' .  $movie->getTitle()
						. '</strong>. Has been deleted successfully. the time:' . ' ' . '<i><strong>' .  $function->getHora()
						. '</strong> and date are:' . ' ' . '</i><strong>' .  $function->getDia()
						. '</strong>  ');
				}

			}
			else
			{

				$this->message = new Message( "warning", "The function does not exist!" );
			}

		}else
		{
			$this->message = new Message( "warning", "There is no function selected!" );
		}
		$view = "MESSAGE";		
		include URL_VISTA . 'header.php';
		require(URL_VISTA . 'message.php');
		include URL_VISTA . 'footer.php';
	}

	public function bring_by_date_idroom_hour($idroom,$day,$hour)
	{
		return $this->fuctionBdDao->bring_by_date_idroom_hour($idroom,$day,$hour);
	}

	public function feature_extraction_algorithm()
	{
		$movie = $this->movieBdDao->bring_everything();
		$roomcinema = array();
		$i=0;
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->bring_Function_by_idMovies($mov->getId());
				if(!empty($thisfunction))
				{
					foreach($thisfunction as $fun) {
						$reglehours = $this->validate_day_hours($fun->getDia(),$fun->getHora());
						if ($reglehours) {
							$shoping = new Shoppingc;
							$result = $shoping->cant_tiket_for_function_bacanci($fun->getId());
							if($result > 0)
							{
								array_push($roomcinema, $fun);
								$roomcinema[$i]->count = 1;
							}
							else
							{
								array_push($roomcinema, $fun);
								$roomcinema[$i]->count = 0;
							}
							$i++;
						}
					}
				}
			}
		}
		return $roomcinema;
	}
	public function movie_extraction_algorithm()
	{
		$movie = $this->movieBdDao->bring_everything();
		$movies = array();
		$idmolas = null;
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->bring_Function_by_idMovies($mov->getId());
				if(!empty($thisfunction))
				{
					foreach ($thisfunction as $fun) {
						$reglehours = $this->validate_day_hours($fun->getDia(),$fun->getHora());
						if($reglehours)
						{	
							if($idmolas != $mov->getId())
							{
								array_push($movies, $mov);
							}
							$idmolas = $mov->getId();
						}
					}
					
				}
			}
		}
		return $movies;
	}

	public function bring_by_genre_id_fuction($search)
	{
		$roomcinema = array();
		$idgenre = 	$this->genreC->bring_genre_id_name($search);
		if($idgenre != null ){
			$idmovies = $this->moviegenreC->move_selection_by_gender_id($idgenre);
			if(!empty($idmovies))
			{
				foreach ($idmovies as $idm) {
					$thisfunction = $this->bring_Function_by_idMovies($idm->getId());
					if(!empty($thisfunction))
					{
						foreach ($thisfunction as $fun) {
							array_push($roomcinema, $fun);
						}
					}
				}

			}
		}
		return $roomcinema;
	}


	public function bring_by_genre_id_muvies($search)
	{
		$movies = array();
		$idgenre = 	$this->genreC->bring_genre_id_name($search);
		if($idgenre != null )
		{
			$idmovies = $this->moviegenreC->move_selection_by_gender_id($idgenre);
			if(!empty($idmovies))
			{
				foreach ($idmovies as $idm) {
					$thisfunction = $this->bring_Function_by_idMovies($idm->getId());
					if(!empty($thisfunction))
					{
						array_push($movies, $idm);
					}
				}

			}
		}
		return $movies;
	}

	public function bring_by_movie_for_name_movies($search)
	{
		$movies = array();
		$movie = $this->movieBdDao->bring_by_name($search);
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->bring_Function_by_idMovies($mov->getId());
				if(!empty($thisfunction))
				{
					array_push($movies, $mov);
				}
			}
		}
		return $movies;
	}

	public function bring_by_function_for_name_movies($search){
		$roomcinema = array();
		$movie = $this->movieBdDao->bring_by_name($search);
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->bring_Function_by_idMovies($mov->getId());
				if(!empty($thisfunction))
				{
					foreach ($thisfunction as $fun) {
						array_push($roomcinema, $fun);
					}
				}
			}
		}
		return $roomcinema;
	}


	public function brind_grafic_buys()
	{
		$ControlShopping = new Shoppingc;
		$movie = $this->bring_movies_and_function_for_buys();
		$count = 0;
		$roomcinema = array();
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->bring_Function_by_idMovies($mov->getId());
				if(!empty($thisfunction))
				{
					foreach ($thisfunction as $fun) {
						array_push($roomcinema, $fun);
						$roomcinema[$count]->coun = 0;
						$shop = $ControlShopping->bringbuybyFunction($fun->getId());
						if(!empty($shop))
						{
							foreach ($shop as $ti) {
								if($fun->getId() == $ti->getFunction()->getId())
								{
									if(!empty($ti->getCountrtiket()))
									{
										$roomcinema[$count]->coun = $roomcinema[$count]->coun  + $ti->getCountrtiket();
										$roomcinema[$count]->min = $roomcinema[$count]->getRoom()->getCantSite() - $roomcinema[$count]->coun;
										$roomcinema[$count]->buy = $roomcinema[$count]->getRoom()->getInputValue() * $roomcinema[$count]->coun;
									}
								}
							}
						}
						$count++;
					}
				}
			}
		}
		return $roomcinema;
	}

	public function bring_movies_and_function_for_buys()
	{
		$this->ControlMovies = new MoviesC;
		$movies = array();
		$movie = $this->ControlMovies->bringmovies();
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->bring_Function_by_idMovies($mov->getId());
				if(!empty($thisfunction))
				{
					array_push($movies, $mov);
				}
			}
		}
		return $movies;
	}

	public function modification_data($day)
	{
		$hoursnaw = date("G:i");
		$dianaw = date ("Y-m-d");
		$modification = $dianaw .'/'. $hoursnaw;
		$modificationthisday = $day .'/'. $hour;
		return $modificationthisday;
	}



	public function remanete_buy_for_movie($search)
	{
		$shoping = new Shoppingc;
		$this->ControlMovies = new MoviesC;
		$brithdate = explode('/', $search);
		if(!empty($brithdate[2]))
		{
			$separedayforyear = explode(' ', $brithdate[2]);
			$date1 = $brithdate[0] . "/" . $brithdate[1] . "/" . $separedayforyear[0];

			$date1 = $this->validate_date($date1);
			if(!empty($brithdate[3]))
			{
				$date2 = $separedayforyear[1] . "/" . $brithdate[3] . "/" . $brithdate[4];
				$date2 = $this->validate_date($date2);
			}
			else
			{
				$date2 = NULL;
			}
			if(empty($data2))
			{
				$data2 = NULL;
			}
		}
		else
		{
			$date1 = NULL;
		}
		$count = 0;
		$movies = array();
		$movie = $this->ControlMovies->bringmovies();
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->bring_Function_by_idMovies($mov->getId());
				if(!empty($thisfunction))
				{
					array_push($movies, $mov);
					$movies[$count]->coun = 0;
					$movies[$count]->min = 0 ;
					foreach ($thisfunction as $fun) {
						if($mov->getId() == $fun->getMovie()->getId())
						{

							$shop = $shoping->bringbuybyFunction($fun->getId());
							if(!empty($shop))
							{
								foreach ($shop as $ti) {
									if($fun->getId() == $ti->getFunction()->getId())
									{
										if(!empty($date1))
										{
											if($date1 <= $ti->getFunction()->getDia())
											{
												if(!empty($date2))
												{
													if($date2 >= $ti->getFunction()->getDia())
													{
														$movies[$count]->coun = $movies[$count]->coun  + $ti->getCountrtiket();
														$movies[$count]->min =  $movies[$count]->min + $ti->getTotal();
													}
												}
												else
												{
													$movies[$count]->coun = $movies[$count]->coun  + $ti->getCountrtiket();
													$movies[$count]->min =  $movies[$count]->min + $ti->getTotal();
												}

											}
											
										}
										else
										{
											if($search == null)
												if(!empty($ti->getCountrtiket()))
												{
													$movies[$count]->coun = $movies[$count]->coun  + $ti->getCountrtiket();
													$movies[$count]->min =  $movies[$count]->min + $ti->getTotal();

												}
											}
										}
									}
								}

							}

						}
						$count++;
					}
				}
			}
			return $movies;
		}

	}