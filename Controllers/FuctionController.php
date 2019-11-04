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
					$verifiqueday = $this->fuctionBdDao->bring_id_by_day($day);
					$verifiquehour = $this->fuctionBdDao->bring_id_by_hour($hour);
					if($verifiqueday == NULL && $verifiquehour == NULL && )
					{
						$function = new Fuction;
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
					else
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
				$this->message = new Message( "warning", "cine no existente!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
		}

	}

	public function  bringeverything()
	{
		return $this->fuctionBdDao->bring_everything();
	}


}
