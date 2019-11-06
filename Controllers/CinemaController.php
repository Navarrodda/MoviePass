<?php
namespace Controllers;
//Model
use \Model\Message as Message;
use \Model\Cinema as Cinema;
//Dao
use Dao\CinemaFileDao as CinemaFileDao;
use Dao\CinemaBdDao as CinemaBd;
use \Controllers\FuctionController as Fuctionc;

class CinemaController
{
	private $cinemaFileDao;
	private $cinemaBdDao;

	public function __construct()
	{
		$this->cinemaFileDao = new CinemaFileDao();
		$this->cinemaBdDao = CinemaBd::getInstance();
		$this->ControlFuctionc = new Fuctionc;
	}

	public function add($name,$capacity,$address,$input_value)
	{
		$name = ucwords($name);
		$address = ucwords($address);
		if(!empty($_SESSION))
		{
			if($this->cinemaBdDao->bring_id_by_title($name) == NULL)
			{
				$this->cinemaFileDao->addCinema($name,$capacity,$address,$input_value);
				$cinema = new Cinema();
				$cinema->setNombre($name);
				$cinema->setCapacidad($capacity);
				$cinema->setDireccion($address);
				$cinema->setValor_entrada($input_value);
				$this->cinemaBdDao->add($cinema);

				$view = "MESSAGE";
				$this->message = new Message( "success", "Has successfully registered the Cinema!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$view = "MESSAGE";
				$this->message = new Message( "warning", "The cinema with that name is already registered!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
		}

	}

	public function  bringeverything()
	{
		return $this->cinemaBdDao->bring_everything();
	}

	public function remove($id)
	{
		$cinema = $this->cinemaBdDao->bring_by_id($id);
		if($cinema != null )
		{
			$name = $cinema->getNombre();
			$this->ControlFuctionc->removefuctioncinema($id);
			$this->cinemaFileDao->removeCinema($id);
			$this->cinemaBdDao->remove_by_id($id);
			$view = "MESSAGE";
			$this->message = new Message('success', 'The cinema with the id for:'  . '<i><strong>' .  $id 
				. '</strong>. and Name' . ' ' . '<i><strong>' .  $name 
				. '</strong> has been deleted successfully </i>');
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'message.php');
			include URL_VISTA . 'footer.php';
		}
		else
		{
			$view = "MESSAGE";
			$this->message = new Message('warning', ' The id was already deleted or no data is found that the id:' . ' ' . '<i><strong>' .  $id 
				. '</strong>!');
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'message.php');
			include URL_VISTA . 'footer.php';
		}
	}

	public function list()
	{
		return $this->cinemaFileDao->retrieveData();
	}

		public function bring_for_id($idcinema)
	{
		return $this->cinemaBdDao->bring_by_id($idcinema);
	}
}
?>