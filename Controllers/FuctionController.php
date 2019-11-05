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
			if($this->cinemaBdDao->bring_id_by_id($idcinema) != NULL)
			{
				$cinema = $this->cinemaBdDao->bring_by_id($idcinema);

				if($this->movieBdDao->bring_id_by($idmovie)!= NULL)
				{
					
					$movie = $this->movieBdDao->bring_by_id($idmovie);
					

					$funtion = $this->fuctionBdDao->bring_by_date_dmovie_cinema($idcinema,$day,$idmovie);
					if( $this->bring_by_function($idcinema,$day,$idmovie,$hour) == NULL )
					{
						$function = new Fuction();
						$function->setCinema($cinema);
						$function->setMovie($movie);
						$function->setDia($day);
						$function->setHora($hour);
						$this->fuctionBdDao->add($function);
						$view = "MESSAGE";
						$this->message = new Message( "success", "exito!" );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . 'message.php');
						include URL_VISTA . 'footer.php';
					}
					else if($this->masCercano($funtion,$hour) != $hour )
					{
						$cercano = array();
						
						$hourSt = (float)$hour;
						$cercano = $this->masCercano($funtion,$hourSt);
						if(($cercano[0]+(15/60) + ($movie->getDuration/60)) < $hourSt  || $cercano[1] > ($hourSt +(15/60) + ($movie->getDuration/60)))
						{
							$function = new Fuction();
							$function->setCinema($cinema);
							$function->setMovie($movie);
							$function->setDia($day);
							$function->setHora($hour);
							$this->fuctionBdDao->add($function);
							$view = "MESSAGE";
							$this->message = new Message( "success", "exito!" );
							include URL_VISTA . 'header.php';
							require(URL_VISTA . 'message.php');
							include URL_VISTA . 'footer.php';
						}
							
					}else
					{
							$view = "MESSAGE";
						$this->message = new Message( "success", "Changos!" );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . 'message.php');
						include URL_VISTA . 'footer.php';
						}

					}else
					{
						$view = "MESSAGE";
						$this->message = new Message( "success", "Changos!" );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . 'message.php');
						include URL_VISTA . 'footer.php';
					}
					
				}
				else{
					$view = "MESSAGE";
					$this->message = new Message( "warning", "muvie no existente!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . 'message.php');
					include URL_VISTA . 'footer.php';
				}
			}
			else
			{
				$view = "MESSAGE";
				$this->message = new Message( "warning", "Need to login!" );
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
