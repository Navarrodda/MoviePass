<?php
	namespace Dao;

	use Model\Room as Room;

	class RoomFileDao
	{
		public function addRoom($name_room,$price,$cant_seat)
		{
			$flag = false;
			$roomList = $this->retrieveData();
			
			$room = new Room();
			if(count($roomList) == 0)
			{	
				$room->setId(1);
				$room->setNameRoom($name_room);
				$room->setPrice($price);
				$room->setCantSeat($cant_seat);
				$flag = true;
			}else
			{	
				$room->setId(1);
				$room->setNameRoom($name_room);
				$room->setPrice($price);
				$room->setCantSeat($cant_seat);
				$flag = true;

			}
			
			array_push($roomList, $room);
			$this->saveData($roomList);
			return $flag;
		}

		public function removeRoom($id)
		{
			$flag = false;
			$roomList = $this->retrieveData();
			$i=0;
			foreach ($roomList as $room) 
			{
				if($room->getId() == $id)
				{
					unset($roomList[$i]);
					//die(var_dump($id));
					$flag = true;
				}else
				{
					$room->setId($i+1);
					$i++;
				}
			}
			$this->saveData($roomList);
			return $flag;
		}

		private function saveData($list)
		{
			$arrayToencode = array();

			foreach ($list as $cinema) 
			{

				$valueArray["id"] = $room->getId();
				$valueArray["name_room"] =	$room->getNameRoom();
				$valueArray["price"] =	$room->getPrice();
				$valueArray["cant_seat"] =	$room->getCantSeat();
				
				array_push($arrayToencode, $valueArray);

			}

			$jsonContent = json_encode($arrayToencode,JSON_PRETTY_PRINT);

			file_put_contents("Data/room.json", $jsonContent);


		}

		public function retrieveData()
		{
			$roomList = array();

			if(file_exists("Data/room.json"))
			{
				$jsonContent = file_get_contents("Data/room.json");

				$arrayTodecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

				foreach ($arrayTodecode as $values) 
				{
					
					$room = new Room();
					$room->setNameRoom($values["name_room"]);
					$room->setPrice($values["price"]);
					$room->setCantSeat($values["cant_seat"]);
					
					array_push($roomList, $room);
				}
				return $roomList;
			}
		}
	}
?>