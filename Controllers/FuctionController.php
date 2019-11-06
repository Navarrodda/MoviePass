<?php
namespace Controllers;
//Model

use \Model\Message as Message;
use \Model\Cinema as Cinema;
use \Model\Movie as Movie;
use \Model\Fuction as Fuction;

//Dao

use \Dao\CinemaBdDao as CinemaBd;
use \Dao\MovieBdDao as MovieBdDao;
use \Dao\FunctionBdDao as FunctionBd;


class FuctionController
{
	private $cinemaBdDao;
	private $movieBdDao;
	private $fuctionBdDao;

	public function __construct()
	{
		$this->cinemaBdDao = CinemaBd::getInstance();
		$this->movieBdDao = MovieBdDao::getInstance();
		$this->fuctionBdDao = FunctionBd::getInstance();

	}

	public function add($idcinema,$day,$hour,$idmovie)
	{	

		if(!empty($_SESSION))
		{
			$cinema = $this->cinemaBdDao->bring_by_id($idcinema); 

			if($cinema != NULL)
			{
				
				$movie = $this->movieBdDao->bring_by_id($idmovie);

				if($movie != NULL)
				{

					$listday = $this->fuctionBdDao->bring_by_day_for_cinema($day,$idcinema);

					$regla = $this->fuctionBdDao->bring_by_date_idmovie_idcinema_hour($idcinema,$day,$idmovie,$hour);
					if($regla == NULL)
					{
						$regle = false;

						$nuevaFecha = (float)$hour;
						$durationyhismovie = (float)$movie->getDuration()/60;
						$minutesretarde = 0.15;
						if(!empty($listday))
						{
							foreach ($listday as $dayfun) {
								$hourss = (float)$dayfun->getHora();
								$resultmin = $hourss - $minutesretarde;
								$duration = (float)$dayfun->getMovie()->getDuration()/60;
								$resultmax = $hourss + ($minutesretarde * ($duration/60));
								$resultmin = $hourss - ($minutesretarde * ($duration/60));
								die(var_dump($resultmin));
								$resultFecmin = $nuevaFecha - $resultmin;
								$resultFemax = $nuevaFecha - $resultmax;
								if($resultFemax < $resultmax || $resultFecmin > $resultmin)
								{
									$regle = true;
								}
						
							}
						}
						else
						{
							$regle = true;
						}
						if($regle){
							$function = new Fuction();
							$function->setCinema($cinema);
							$function->setMovie($movie);
							$function->setDia($day);
							$function->setHora($hour);
							$this->fuctionBdDao->add($function);
							$view = "MESSAGE";
							$this->message = new Message( "success", "The movie was loaded successfully!" );
							include URL_VISTA . 'header.php';
							require(URL_VISTA . 'message.php');
							include URL_VISTA . 'footer.php';
						}
						else
						{
							$view = "MESSAGE";
							$this->message = new Message( "warning", "Does not meet the duration!" );
							include URL_VISTA . 'header.php';
							require(URL_VISTA . 'message.php');
							include URL_VISTA . 'footer.php';
						}
					}
					else
					{
						$view = "MESSAGE";
						$this->message = new Message( "warning", "Billboard movie already exists. It does not matter!!" );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . 'message.php');
						include URL_VISTA . 'footer.php';
					}
				}
				else
				{
					$view = "MESSAGE";
					$this->message = new Message( "warning", "Cinema dont exist!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . 'message.php');
					include URL_VISTA . 'footer.php';
				}
			}
			else
			{
				$view = "MESSAGE";
				$this->message = new Message( "warning", "Movie dont exist!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
		}
		else{
			$view = "MESSAGE";
			$this->message = new Message( "warning", "Must login!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'login.php');
			include URL_VISTA . 'footer.php';
		}
	}


	public function  bring_Function_by_idCinema($id)
	{
		return $this->fuctionBdDao->bring_Function_by_idCinema($id);
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
		$this->fuctionBdDao->remove_by_id_cinema($idcinema);
	}

	public function bringeverything()
	{
		return $this->fuctionBdDao->bring_everything();
	}


}
