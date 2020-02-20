<?php
namespace Controllers;
//Model
use \Model\Message as Message;
use \Model\Cinema as Cinema;
//Dao
use Dao\CinemaFileDao as CinemaFileDao;
use Dao\CinemaBdDao as CinemaBd;
use \Dao\RoomBdDao as RoomBdDao;

//controllers
use \Controllers\FuctionController as Fuctionc;
use \Controllers\ShoppingController as Shoppingc;
use \Controllers\RoomController as Roomc;


class CinemaController
{
	private $cinemaFileDao;
	private $cinemaBdDao;

	public function __construct()
	{
		$this->cinemaFileDao = new CinemaFileDao();
		$this->cinemaBdDao = CinemaBd::getInstance();
		$this->RoomBdDao = RoomBdDao::getInstance();

	}

	public function add($name,$address)
	{
		$name = ucwords($name);
		$address = ucwords($address);
		if(!empty($_SESSION))
		{
			if($this->cinemaBdDao->bring_id_by_title($name) == NULL)
			{
				$this->cinemaFileDao->addCinema($name,$address);
				$cinema = new Cinema();
				$cinema->setNombre($name);
				$cinema->setDireccion($address);
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

		if($cinema != null)
		{
			$name = $cinema->getNombre();
			$this->cinemaFileDao->removeCinema($id);
			$this->RoomBdDao->remove_by_id_cinema($id);
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

	public function modify($idcinema,$name,$address)
	{

		$cine = $this->cinemaBdDao->bring_id_by_title($name);
		if($cine == $idcinema){
			$cinema = new Cinema();
			$cinema->setNombre($name);
			$cinema->setDireccion($address);
			$this->cinemaBdDao->to_update($cinema,$idcinema);
			$this->message = new Message( "success", "The cinema has been successfully modified!" );
		}
		else
		{
			if($cine == NULL)
			{
				$cinema = new Cinema();
				$cinema->setNombre($name);
				$cinema->setDireccion($address);
				$this->cinemaBdDao->to_update($cinema,$idcinema);
				$this->message = new Message( "success", "The cinema has been successfully modified!" );
			}
			else{
				$this->message = new Message( "warning", "The cinema with that name is already registered!" );
			}
		}
		$view = "MESSAGE";
		include URL_VISTA . 'header.php';
		require(URL_VISTA . 'message.php');
		include URL_VISTA . 'footer.php';
	}


	public function remanete_buy_for_cinemas($search)
	{
		$shoping = new Shoppingc;
		$rooms = new Roomc;
		$function = new Fuctionc;

		$brithdate = explode('/', $search);
		if(!empty($brithdate[2]))
		{
			$separedayforyear = explode(' ', $brithdate[2]);
			$date1 = $brithdate[0] . "/" . $brithdate[1] . "/" . $separedayforyear[0];
			$date1 = $function->validate_date($date1);
			if(!empty($brithdate[3]))
			{
				$date2 = $separedayforyear[1] . "/" . $brithdate[3] . "/" . $brithdate[4];
				$date2 = $function->validate_date($date2);
			}
			else
			{
				$date2 = NULL;
			}
			if(empty($data2))
			{
				$data2 = NULL;
			}
		}
		else
		{
			$date1 = NULL;
		}
		$count = 0;
		$cinemas = array();
		$cinema = $this->bringeverything();
		if(!empty($cinema))
		{
			foreach ($cinema as $cin) {
				$roomscinema = $rooms->bring_list_for_id_cinema($cin->getId());
				if($roomscinema){
					array_push($cinemas, $cin);
					$cinemas[$count]->coun = 0;
					$cinemas[$count]->min = 0 ;
					foreach ($roomscinema as $room) {
						$functionsrom = $function->bring_Function_by_idroom($room->getId());
						if($functionsrom)
						{
							foreach ($functionsrom as $fun) {
								if($cin->getId() == $fun->getRoom()->getCinema()->getId())
								{
									$shop = $shoping->bringbuybyFunction($fun->getId());
									if(!empty($shop))
									{
										foreach ($shop as $ti) {
											if($fun->getId() == $ti->getFunction()->getId())
											{
												if(!empty($date1))
												{
													if($date1 <= $ti->getFunction()->getDia())
													{
														
														if(!empty($date2))
														{

															if($date2 >= $ti->getFunction()->getDia())
															{
																$cinemas[$count]->coun = $cinemas[$count]->coun  + $ti->getCountrtiket();
																$cinemas[$count]->min =  $cinemas[$count]->min + $ti->getTotal();
															}
														}
														else
														{
															$cinemas[$count]->coun = $cinemas[$count]->coun  + $ti->getCountrtiket();
															$cinemas[$count]->min =  $cinemas[$count]->min + $ti->getTotal();
														}

													}

												}
												else
												{
													if($search == null)
														if(!empty($ti->getCountrtiket()))
														{
															$cinemas[$count]->coun = $cinemas[$count]->coun  + $ti->getCountrtiket();
															$cinemas[$count]->min =  $cinemas[$count]->min + $ti->getTotal();

														}
													}
												}
											}
										}
									}

								}
							}
						}

					}
					$count++;
				}
			}
			return $cinemas;
		}


	}
	?>