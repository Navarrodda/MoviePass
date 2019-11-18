<?php
namespace Controllers;
//Model
use \Model\Message as Message;
use \Model\Shopping as Shopping;
//Controler
use \Controllers\CinemaController as CinemaC;
use \Controllers\FuctionController as Fuctionc;
use \Controllers\DiscountController as DiscountC;
//DAO
use \Dao\ShoppingsBdDao as ShoppingsBdDao;

class ShoppingController
{
	private $daoShopping;
	public function __construct()
	{
		$this->daoShopping = ShoppingsBdDao::getInstance();
	}

	public function purchasetikets($id)
	{
		return $this->daoShopping->bring_buy_by_user($id);
	}

	//Verify and add the shop
	public function add($cardnumber,$cardnumber1,$cardnumber2,$cardnumber3,$cardholder,$cardexpirationmonth,$cardexpirationyear,$idicount,$idfuction,$quantity)
	{

		if(!empty($_SESSION))
		{
			$fuction = $this->ControlFuctionc->bringidfuction($idfuction);

			if(!empty($fuction))
			{
			$movie = $fuction->getMovie();
			$room =  $fuction->getRoom();
			$cinema = $fuction->getRoom()->getCinema();
			$discount = $this->ControlDiscount->give_discount_day($fuction->getDia());
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