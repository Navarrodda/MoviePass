<?php
namespace Controllers;
//Model
use \Model\Message as Message;
use \Model\Room as Room;
use \Model\Cinema as Cinema;
//Dao
use Dao\RoomBdDao as RoomBdDao;
//Controllers
use Controllers\CinemaController as CinemaController;

class RoomController
{
	private $RoomBd;
	private $CinemaControl;

	public function __construct()
	{
		$this->RoomBd = RoomBdDao::getInstance();
		$this->CinemaControl = new CinemaController();
	}

	public function add($name_room,$cant_site,$number_room,$idcinema)
	{
		$name_room = ucwords($name_room); 
		$id = $this->RoomBd->bring_id_by_nameRoom($name_room,$idcinema);
		if (empty($id)) {
			$cinema = $this->CinemaControl->bring_for_id($idcinema);
			if (!empty($cinema)) {
				$room = new Room();
				$room->setNameRoom($name_room);
				$room->setCantSite($cant_site);
				$room->setCinema($cinema);
				$room->setNumberRoom($number_room);

				$this->RoomBd->add($room);
				$view = "MESSAGE";
				$this->message = new Message( "success", "The room loaded successfully!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';

			}
			else{
				
				$view = "MESSAGE";
				$this->message = new Message( "warning", "The cinema dont exist!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
		}
		else{
			
				$view = "MESSAGE";
				$this->message = new Message( "warning", "The name room exist!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
		}
	}	

	public function remove_by_id_room($id)
	{
		$this->RoomBd->remove_by_id($id);
	}

	public function modify($idroom,$name_room,$cant_site,$number_room){

		$room = $this->RoomBd->bring_by_id($idroom);
		if($room == $id){
			$room = new Cinema();
			$room->setNameRoom($name_room);
			$room->setCantSite($cant_site);
			$cinema->setNumberRoom($number_room);
			$this->RoomBd->to_update($room,$idroom);
			$view = "MESSAGE";
			$this->message = new Message( "success", "The room has been successfully modified!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'message.php');
			include URL_VISTA . 'footer.php';

		}
	}

	public function bring_list_for_id_cinema($idcinema)
	{
		return $this->RoomBd->bring_list_for_id_cinema($idcinema);
	}

	public function bringeverything()
	{
		return $this->RoomBd->bring_everything();
	}

		public function bring_by_id($idroom)
	{
		return $this->RoomBd->bring_by_id($idroom);
	}

	//traer toda la capacidad del cine
	//traer todas las salas
	//contar esas capacidades y ver si se puede dar de alta la sala
	//public function 

}

?>