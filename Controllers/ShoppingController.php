<?php
namespace Controllers;
//Model
use \Model\Message as Message;
use \Model\Shopping as Shopping;
use \Model\Discount as Discount;
//Controler
use \Controllers\CinemaController as CinemaC;
use \Controllers\FuctionController as FuctionC;
use \Controllers\DiscountController as DiscountC;
use \Controllers\UserController as UserC;
use \Controllers\TicketController as TicketC;
//DAO
use \Dao\ShoppingsBdDao as ShoppingsBdDao;

class ShoppingController
{
	private $daoShopping;
	private $usercontroller;
	private $ControlDiscount;
	private $ControlTicket;
	public function __construct()
	{
		$this->daoShopping = ShoppingsBdDao::getInstance();
		$this->usercontroller = new UserC();
		$this->ControlDiscount = new DiscountC();
		$this->ControlFuctionc = new FuctionC();
		$this->ControlTicket = new TicketC();
	}

	public function purchasetikets($id)
	{
		return $this->daoShopping->bring_buy_by_user($id);
	}

	//Verify and add the shop 
	public function add($cardnumber,$cardnumber1,$cardnumber2,$cardnumber3,$cardholder,$cardexpirationmonth,$cardexpirationyear,$ccv,$idicount,$idfuction,$quantity,$card,$view)
	{
		if(!empty($_SESSION))
		{
			if($view != "MESSAGE")
			{
				$cardnumber = $cardnumber.$cardnumber1.$cardnumber2.$cardnumber3;

				$fuction = $this->ControlFuctionc->bringidfuction($idfuction);
				$sum = $this->daoShopping->sum_buy_by_function($fuction->getId());
				$seat = $fuction->getRoom()->getCantSite() + 1;
				$cantotal= $sum["sum(countrtiket)"] + $quantity;
				$result = $seat - $cantotal ;
				
				if($result > 0)
				{
					if(!empty($fuction))
					{
						$movie = $fuction->getMovie();
						$room =  $fuction->getRoom();
						$cinema = $fuction->getRoom()->getCinema();
						$discount = $this->ControlDiscount->give_discount_day($fuction->getDia());
						$year = date("Y"); 
						$month = date("m");
						if(strlen($cardnumber) == 16 && preg_match('~[0-9]+~', $cardnumber)) 
						{
							if(!preg_match('~[0-9]+~', $cardholder))
							{
								$monthyear =  $year . $month;
								$cardexpirationyearmonth = $cardexpirationyear . $cardexpirationmonth;
								if($monthyear <= $cardexpirationyearmonth)
								{

									if(strlen($ccv) == 3 && preg_match('~[0-9]+~', $ccv) )
									{
										$shopping = new Shopping();
										$shopping->setUser($this->usercontroller->bring_by_id());
										$shopping->setFunction($fuction);
										$shopping->setDate(date("Y-m-d"));
										$shopping->setCountrtiket($quantity);
										$shopping->setPrice($room->getInputValue());
										if($discount != null)
										{	
											$shopping->setDiscount($discount[0]);							
											$total = $shopping->getPrice() * $shopping->getCountrtiket()*  (1 - ($discount[0]->getDisc()/100));
										}else
										{
											$total = $shopping->getPrice() * $shopping->getCountrtiket();
										}
										$shopping->setTotal($total);
										$id = $this->daoShopping->add($shopping);
										$shopping->setId($id);
										$this->ControlTicket->add($shopping);

										$view = "MESSAGE";
										$wear = strtolower($view);
										$this->message = new Message("success","La compra se ha realizado con exito " );
									}else
									{
										$view = 'CARD';
										$wear =  strtolower($view);
										$this->message = new Message("warning","Invalid CCV" );
									}

								}else 
								{
									$this->message = new Message("warning","Invalid Expiration Date" );
									$view = 'CARD';
									$wear =  strtolower($view);

								}

							}else
							{
								$view = 'CARD';
								$wear =  strtolower($view);
								$this->message = new Message("warning","Invalid Card Holder" );
							}
						}else
						{
							$view = 'CARD';
							$wear =  strtolower($view);
							$this->message = new Message("warning","Invalid Card Number" );
						}
					}
					else
					{
						$view = "MESSAGE";
						$wear =  strtolower($view);
						$this->message = new Message("warning","Function don't exist." );
					}
				}
				else
				{
					$view = "MESSAGE";
					$wear =  strtolower($view);
					$this->message = new Message("warning","There are no more vacancies for this room." );
				}
			}else
			{
				$this->message = new Message("warning", "You already have a ticket");
				$view = 'MESSAGE';
				include URL_VISTA . 'header.php';
				require(URL_VISTA . "message.php");
				include URL_VISTA . 'footer.php';
			}
		}	
		else
		{
			$view = "LOGIN";
			$wear =  strtolower($view);
			$this->message = new Message("warning","without a session started!" );
		}

		$wear = $wear . '.'.'php';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . $wear);
		include URL_VISTA . 'footer.php';
	}

	public function bringbyid($idsopping)
	{
		return $this->daoShopping->bring_by_id($idsopping);
	}

	public function bringbuybyFunction($idfunction)
	{
		return $this->daoShopping->bring_buy_by_Function($idfunction);
	}

	public function cant_tiket_for_function_bacanci($idfuction)
	{
		$fuction = $this->ControlFuctionc->bringidfuction($idfuction);
		$sum = $this->daoShopping->sum_buy_by_function($fuction->getId());
		$seat = $fuction->getRoom()->getCantSite();
		$result =  $seat - $sum["sum(countrtiket)"] ;
		return$result;	}


	}
	?>