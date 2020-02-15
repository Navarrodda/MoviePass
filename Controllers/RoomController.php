<?php
namespace Controllers;
//Model
use \Model\Message as Message;
use \Model\Room as Room;
use \Model\Cinema as Cinema;
//Dao
use Dao\RoomBdDao as RoomBdDao;
use Dao\CinemaBdDao as CinemaBdDao;
use \Controllers\FuctionController as Fuctionc;
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
		$this->ControlFuctionc = new Fuctionc;
	}

	public function bringidbytitleroom($name_room){

		return $this->RoomBd->bring_id_by_titleroom($name_room);
	}

	public function add($name_room,$cant_site,$input_value,$idcinema)
	{
		$name_room = ucwords($name_room); 
		$id = $this->RoomBd->bring_id_by_nameRoom($name_room,$idcinema);
	 	//$regla = $this->control_capacity($idcinema, $cant_site);
		if (empty($id)) {
			$cinema = $this->CinemaControl->bring_for_id($idcinema);
			if (!empty($cinema)) {
				//if ($regla) {
				$room = new Room();
				$room->setNameRoom($name_room);
				$room->setCantSite($cant_site);
				$room->setCinema($cinema);
				$room->setInputValue($input_value);

				$this->RoomBd->add($room);
				$view = "MESSAGE";
				$this->message = new Message( "success", "The room loaded successfully!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
				//}
				/*else{
					$view = "MESSAGE";
					$this->message = new Message( "warning", "The capacity of the room exceeds the capacity of the cinema!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . 'message.php');
					include URL_VISTA . 'footer.php';
				}*/

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
		$room = $this->bring_by_id($id);
		if(!empty($room))
		{
			$name = $room->getNameRoom();
			$this->ControlFuctionc->removefunctionforroom($id);
			$this->RoomBd->remove_by_id($id);
			$view = "MESSAGE";
			$this->message = new Message('success', 'the cinema room with the id:'  . '<i><strong>' .  $id 
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

	public function remove_by_id_cinema($id)
	{
		return $this->RoomBd->remove_by_id_cinema($id);
	}
	

	public function modify($name_room,$cant_site,$input_value,$idroom){
		$id = $this->bringidbytitleroom($name_room);
		$roomaray = $this->bring_by_id($idroom);
		if($id == $idroom){
			$room = new Room();
			$room->setNameRoom($name_room);
			$room->setCantSite($cant_site);
			$room->setCinema($roomaray->getCinema());
			$room->setInputValue($input_value);
			$this->RoomBd->to_update($room,$idroom);
			$this->message = new Message( "success", "The room has been successfully modified!" );
		}
		else
		{
			if($id == NULL)
			{
				$room = new Room();
				$room->setNameRoom($name_room);
				$room->setCantSite($cant_site);
				$room->setCinema($roomaray->getCinema());
				$room->setInputValue($input_value);
				$this->RoomBd->to_update($room,$idroom);
				$this->message = new Message( "success", "The room has been successfully modified!" );
			}
			else
			{
				$this->message = new Message( "warning", "The room with that name is already registered!" );
			}
		}
		$view = "MESSAGE";
		include URL_VISTA . 'header.php';
		require(URL_VISTA . 'message.php');
		include URL_VISTA . 'footer.php';
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

	public function brin_cant_site_room_for_idroom($idroom)
	{
		$room = $this->RoomBd->bring_by_id($idroom);
		return $room->getCantSite();
	}

	//traer toda la capacidad del cine
	//traer todas las salas
	//contar esas capacidades y ver si se puede dar de alta la sala
	/*
	public function control_capacity($idcinema, $cant_site){
		$rooms = $this->RoomBd->bring_list_for_id_cinema($idcinema);
		$cinema = $this->CinemaControl->bring_for_id($idcinema);
		$count = 0;
		if(!empty($rooms))
		{
			foreach ($rooms as $room) 
		{
			$count = $count + $room->getCantSite();
		}
		$count = $count + $cant_site;
		if ($cinema->getCapacidad() >= $count) {
				return true;
		}	
		return false;
	}else
	{
		if($cinema->getCapacidad() >= $cant_site)
		{
			return true;
		}
		return false;
	}
		
}*/


}

?>