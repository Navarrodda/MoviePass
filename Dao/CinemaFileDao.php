<?php
	namespace Dao;

	use Model\Cinema as Cinema;

	class CinemaFileDao
	{
		public function addCinema($nombre,$capacidad,$direccion,$valor_entrada)
		{
			$flag = false;
			$cinemaList = $this->retrieveData();
			
			$cinema = new Cinema();
			if(count($cinemaList) == 0)
			{	
				$cinema->setId(1);
				$cinema->setCapacidad($capacidad);
				$cinema->setDireccion($direccion);
				$cinema->setNombre($nombre);
				$cinema->setValor_entrada($valor_entrada);
				$flag = true;
			}else
			{
				
				
				$cinema->setId(sizeof($cinemaList)+1);
				$cinema->setCapacidad($capacidad);
				$cinema->setDireccion($direccion);
				$cinema->setNombre($nombre);
				$cinema->setValor_entrada($valor_entrada);
				$flag = true;

			}
			
			array_push($cinemaList, $cinema);
			$this->saveData($cinemaList);
			return $flag;
		}

		public function removeCinema($id)
		{
			$flag = false;
			$cinemaList = $this->retrieveData();
			$i=0;
			foreach ($cinemaList as $cinema) 
			{
				if($cinema->getId() == $id)
				{
					unset($cinemaList[$i]);
					//die(var_dump($id));
					$flag = true;
				}else
				{
					$cinema->setId($i+1);
					$i++;
				}
			}
			$this->saveData($cinemaList);
			return $flag;
		}

		private function saveData($list)
		{
			$arrayToencode = array();

			foreach ($list as $cinema) 
			{

				$valueArray["id"] = $cinema->getId();
				$valueArray["capacidad"] =	$cinema->getCapacidad();
				$valueArray["direccion"] =	$cinema->getDireccion();
				$valueArray["nombre"] =	$cinema->getNombre();
				$valueArray["valor_entrada"] =	$cinema->getValor_entrada();
				
				array_push($arrayToencode, $valueArray);

			}

			$jsonContent = json_encode($arrayToencode,JSON_PRETTY_PRINT);

			file_put_contents("Data/cinema.json", $jsonContent);


		}

		public function retrieveData()
		{
			$cinemaList = array();

			if(file_exists("Data/cinema.json"))
			{
				$jsonContent = file_get_contents("Data/cinema.json");

				$arrayTodecode = ($jsonContent) ? json_decode($jsonContent,true) : array();

				foreach ($arrayTodecode as $values) 
				{
					
					$cinema = new Cinema();

					$cinema->setId($values["id"]);
					$cinema->setCapacidad($values["capacidad"]);
					$cinema->setDireccion($values["direccion"]);
					$cinema->setNombre($values["nombre"]);
					$cinema->setValor_entrada($values["valor_entrada"]);
					
					/*$cell = new Cellphone($values["id"],$values["code"],$values["brand"],$values["model"],
						$values["price"]);*/
					array_push($cinemaList, $cinema);
				}
				return $cinemaList;
			}
		}
	}
?>