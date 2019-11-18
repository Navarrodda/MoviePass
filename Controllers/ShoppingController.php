<?php
namespace Controllers;
//Model
use \Model\Message as Message;
use \Model\Shopping as Shopping;
//Controler
use \Controllers\CinemaController as CinemaC;
use \Controllers\FuctionController as Fuctionc;
use \Controllers\DiscountController as DiscountC;
use \Controllers\UserController as UserC;
//DAO
use \Dao\ShoppingsBdDao as ShoppingsBdDao;

class ShoppingController
{
	private $daoShopping;
	private $usercontroller;
	private $ControlDiscount;
	public function __construct()
	{
		$this->daoShopping = ShoppingsBdDao::getInstance();
		$this->usercontroller = new Userc();
		$this->ControlDiscount = new DiscountC();
	}

	public function purchasetikets($id)
	{
		return $this->daoShopping->bring_buy_by_user($id);
	}

	//Verify and add the shop 
	public function add($cardnumber,$cardnumber1,$cardnumber2,$cardnumber3,$cardholder,$cardexpirationmonth,$cardexpirationyear,$ccv,$idicount,$idfuction,$quantity)
	{

		if(!empty($_SESSION))
		{
			$cardnumber = $cardnumber.$cardnumber1.$cardnumber2.$cardnumber3;

			$fuction = $this->ControlFuctionc->bringidfuction($idfuction);

			if(!empty($fuction))
			{
				$movie = $fuction->getMovie();
				$room =  $fuction->getRoom();
				$cinema = $fuction->getRoom()->getCinema();
				$discount = $this->ControlDiscount->give_discount_day($fuction->getDia());
				$year = date("Y"); 
				$month = date("m");
				if(count($cardnumber) == 16 && !is_string($cardnumber)) 
				{
					if(!preg_match('~[0-9]+~', $cardholder))
					{
						if($year == $cardexpirationyear && $month == $cardexpirationmonth)
						{
							if(strlen($ccv) == 3 && preg_match('~[0-9]+~', $ccv) )
							{
								$shopping = new Shopping();
								$shopping->setUser($this->usercontroler->bring_by_id());
								$shopping->setFunction($fuction);
								$shopping->setDiscount($discount);
								$shopping->setDate(date("Y-m-d"));
								$shopping->setCountrtiket($quantity);
								$shopping->setPrice($cinema->getValor_entrada());
								$shopping->setDiscount($discount);
								if($discount != null)
								{								
									$total = $shopping->getPrice() * $shopping->getCountrtiket()*  (1 - ($discount->getDisc()/100));
								}else
								{
									$total = $shopping->getPrice() * $shopping->getCountrtiket();
								}
								$shopping->setTotal($total);

							}else
							{
								$view = 'CARD';
								$wear =  strtolower($view);
								$this->message = new Message("warning","Invalid CCV" );
							}

						}else 
						{
							$view = 'CARD';
							$wear =  strtolower($view);
							$this->message = new Message("warning","Invalid Expiration Date" );
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
			$view = "LOGIN";
			$wear =  strtolower($view);
			$this->message = new Message("warning","without a session started!" );
		}

		$wear = $wear . '.'.'php';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . $wear);
		include URL_VISTA . 'footer.php';
	}

}
?>