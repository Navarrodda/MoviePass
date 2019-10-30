<?php
namespace Controllers;
//Model
use \Model\Message as Message;
use \Model\Discount as Discount;

//Dao
use Dao\DiscountBdDao as DiscountBd;


class DiscountController
{

	private $DiscountBd;

	public function __construct()
	{
		$this->DiscountBd = DiscountBd::getInstance(); 
	}

	public function bring_everything()
	{
		return $this->DiscountBd->bring_everything();
	}

	public function add($dis,$description,$day,$hours)
	{
		if(!empty($_SESSION))
		{
			$discount = new Discount;
			$discount->setDisc($dis);
			$discount->setDescription($description);
			$discount->setFecha($day);
			$discount->setHora($hours);
			$id = $this->DiscountBd->add($discount);
			if(!empty($id))
			{
				$view = "MESSAGE";
				$this->message = new Message( "success", "The discount was registered successfully!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$view = "MESSAGE";
				$this->message = new Message( "warning", "The discount could not be registered!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';

			}


		}
	}
}
