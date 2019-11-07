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
		$menssaj = 1;
		if(!empty($_SESSION))
		{
			$cinema = $this->cinemaBdDao->bring_by_id($idcinema); 

			if($cinema != NULL)
			{
				
				$movie = $this->movieBdDao->bring_by_id($idmovie);

				if($movie != NULL)
				{
					$funcionmuvie =$this->fuctionBdDao->bring_Function_by_idMovies_for_day($idmovie,$day);

					if(!empty($funcionmuvie))
					{
						$menssaj=2;
						$movieforcinema = false;
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

					$listday = $this->fuctionBdDao->bring_by_day_for_cinema($day,$idcinema);

					if($movieforcinema)
					{

						$regla = $this->fuctionBdDao->bring_by_date_idmovie_idcinema_hour($idcinema,$day,$idmovie,$hour);
						if($regla == NULL)
						{
							$regle = false;
							$ve = '00:15:00';
							$veda[1]=explode(':',$ve);
							$separar[1]=explode(':',$hour);
							//$separar[2]=explode(':',$hora2);
							$total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1]+$movie->getDuration()+$veda[1][1]; 
							if(!empty($listday))
							{
								foreach ($listday as $dayfun) {

									$hourss = $dayfun->getHora();
									$separar[2]=explode(':',$hourss);
									$total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1]+$dayfun->getMovie()->getDuration()+$veda[1][1]; 
									$total_minutos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2]; 
									if($separar[1][0] != $separar[2][0] && $separar[1][0] != '00'){
									}
									if($total_minutos <= -132)
									{
										$regle = true;
									}
									if($total_minutos >= 136)
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
						$this->message = new Message( "warning", "The selected movie is already in another movie theater!" );
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
