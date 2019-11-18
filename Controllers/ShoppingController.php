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

	public function add($card-number,$card-number-1,$card-number-2,$card-number-3,$card-holder,$card-expiration-month,$card-expiration-year,$idicount,$idfuction,$quantity)
	{

		if(!empty($_SESSION))
		{
			$cinema = $this->ControlCinema->bring_for_id($idcinema);
			if(!empty($cinema))
			{

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