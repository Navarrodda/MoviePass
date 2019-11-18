<?php
namespace Controllers;
//Model
use \Model\Message as Message;
use \Model\Buy as Buy;
//Controler
use \Controllers\CinemaController as CinemaC;
use \Controllers\FuctionController as Fuctionc;
use \Controllers\DiscountController as DiscountC;
//DAO
use \Dao\BuyBdDao as BuyBdDao;

class ShoppingController
{
	private $daoBuy;
	public function __construct()
	{
		$this->daoBuy = BuyBdDao::getInstance();
	}

	public function purchasetikets($id)
	{
		return $this->daoBuy->bring_buy_by_user($id);
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