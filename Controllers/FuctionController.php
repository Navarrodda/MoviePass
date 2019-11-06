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
					$dayfuction= array();
					$listday = $this->fuctionBdDao->bring_by_day_list($day);
					if(!empty($listday )){
						foreach ($listday as $funct) {
							
							if($idcinema == $funct->getCinema()->getId() && $idmovie == $funct->getMovie()->getId())
							{
								array_push($dayfuction, $funct);
							}
						}
					}
					$regla = $this->fuctionBdDao->bring_by_date_idmovie_idcinema_hour($idcinema,$day,$idmovie,$hour);
					if($regla == NULL)
					{
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
						$regle = false;
						$hou = strtotime($hour);
						foreach ($dayfuction as $dayfun) {
							$hourss = strtotime($dayfun->getHora());
							$hourss = $hourss + strtotime('00:15') + strtotime($dayfun->getMovie()->getDuration());
							$hourmin =  $hourss - strtotime('00:15') + strtotime($dayfun->getMovie()->getDuration());
							if($hourss < $hou || $hourmin > $hou)
							{
								$regle = true;
							}
						}
						if($regla == NULL)
						{
						if($regle)
						{
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
							$this->message = new Message( "warning", "Time not accepted duration!" );
							include URL_VISTA . 'header.php';
							require(URL_VISTA . 'message.php');
							include URL_VISTA . 'footer.php';
						}
						}
						else
						{
							$view = "MESSAGE";
							$this->message = new Message( "warning", "Billboard movie already exists!" );
							include URL_VISTA . 'header.php';
							require(URL_VISTA . 'message.php');
							include URL_VISTA . 'footer.php';
						}
					}

				}else
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
				$this->message = new Message( "warning", "Cinema dont exist!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
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
	public function masCercano($list,$numer)
	{
		$menor = 0;
		$mayor = 0;
		$cercano = 0;

		foreach($list as $n) 
		{
			if ($n->getHora() == $numer) {
				return $numer;
			} else if ($n->getHora() < $numer && $n->getHora() < $menor) {
				$menor = $n->getHora();
			} else if ($n->getHora() > $numer && $n->getHora() > $mayor) {
				$mayor = $n->getHora();
			}
		}

		$array = array();
		array_push($array,$menor);
		array_push($array,$mayor);

		return $array;
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
