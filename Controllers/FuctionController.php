<?php
namespace Controllers;
//Model

use \Model\Message as Message;
use \Model\Room as Room;
use \Model\Movie as Movie;
use \Model\Fuction as Fuction;

//Dao

use \Dao\RoomBdDao as RoomBdDao;
use \Dao\MovieBdDao as MovieBdDao;
use \Dao\FunctionBdDao as FunctionBd;


class FuctionController
{
	private $cinemaBdDao;
	private $movieBdDao;
	private $fuctionBdDao;

	public function __construct()
	{
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

			$regla = $this->bring_by_date_idmovie_idroom_hour($idroom,$day,$idmovie,$hour);
			if($regla == NULL)
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
							$total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1]+$movie->getDuration()+$veda[1][1]; 
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

		if(!empty($_SESSION))
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

	public function bringidfuction($idfuction)
	{
		return $this->fuctionBdDao->bring_by_id($idfuction);
	}
	public function removefuctioncinema($idcinema)
	{
		return $this->fuctionBdDao->remove_by_id_cinema($idcinema);
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

	public function bring_by_date_idmovie_idroom_hour($idroom,$day,$idmovie,$hour)
	{
		return $this->fuctionBdDao->bring_by_date_idmovie_idroom_hour($idroom,$day,$idmovie,$hour);
	}

	public function feature_extraction_algorithm()
	{
		$movie = $this->movieBdDao->bring_everything();
		$roomcinema = array();
		if(!empty($movie))
		{
			foreach ($movie as $mov) {
				$thisfunction = $this->bring_Function_by_idMovies($mov->getId());
				if(!empty($thisfunction))
				{
					foreach($thisfunction as $fun) {
						array_push($roomcinema, $fun);
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
	


}