<?php
namespace Controllers;
//Model
use \Model\Message as Message;
//Dao
use Dao\CinemaFileDao as CinemaFileDao;

class CinemaController
{
	private $cinemaFileDao;

	public function __construct()
	{
		$this->cinemaFileDao = new CinemaFileDao();
	}

	public function add($name,$capacity,$address,$input_value)
	{
		$name = ucwords($name);
		$address = ucwords($address);
		$question = $this->cinemaFileDao->addCinema($name,$capacity,$address,$input_value);
		if($question == true)
		{
			$view = "MESSAGE";
			$this->message = new Message( "success", "Has successfully registered the Cinema!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'message.php');
			include URL_VISTA . 'footer.php';
		}
		else
		{
			$view = "MESSAGE";
			$this->message = new Message( "warning", "An error has occurred!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'message.php');
			include URL_VISTA . 'footer.php';
		}
	}

	public function remove($id)
	{
		$question = $this->cinemaFileDao->removeCinema($id);
		if($question == true)
		{
			$view = "MESSAGE";
			$this->message = new Message('success', ' The cinema with the id' . ' ' . '<i><strong>' .  $id 
				. '</strong>. has been deleted successfully!');
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'message.php');
			include URL_VISTA . 'footer.php';
		}
		else
		{
			$view = "MESSAGE";
			$this->message = new Message( "warning", "An error has occurred!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'message.php');
			include URL_VISTA . 'footer.php';
		}
	}

	public function list()
	{
		return $this->cinemaFileDao->retrieveData();
	}
}
?>