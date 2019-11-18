<?php
namespace Controllers;
//Model
use \Model\Message as Message;
use \Model\Buy as Buy;
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

}
?>