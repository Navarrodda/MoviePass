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

	public function bring_data_id($id)
	{
		return $this->DiscountBd->bring_by_id($id);
	}

	public function add($dis,$description,$day,$hours)
	{
		if(!empty($_SESSION))
		{
			$valid = $this->DiscountBd->bring_by_day($day);
			if(empty($valid))
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
			else
			{
				$view = "MESSAGE";
				$this->message = new Message( "warning", "That date already coincides with another discount!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}


		}
	}

	public function remove_by_id($id)
	{
		if(!empty($_SESSION))
		{
			$id = $this->DiscountBd->bring_by_for_id($id);
			$this->DiscountBd->remove_by_id($id);
			if(!empty($id))
			{

				$view = "MESSAGE";
				$this->message = new Message( "success", "The discount was deleted successfully!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$view = "MESSAGE";
				$this->message = new Message( "warning", "There is no such discount!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';

			}
		}
	}

	public function to_update($id,$dis,$description,$day,$hours)
	{
		if(!empty($_SESSION))
		{
			$regle = false;
			$valid = $this->DiscountBd->bring_by_day($day);
			if(!empty($valid))
			{

				foreach ($valid as $d) {
					if($d->getId() == $id){
						$regle = True;
					}
				}
			}
			else
			{
				$regle = True;
			}
			if($regle){
				$valid = $this->DiscountBd->bring_by_day($day);
				$disc = $this->DiscountBd->bring_by_id($id);
				$discount = new Discount;
				$discount->setDisc($dis);
				$discount->setDescription($description);
				$discount->setFecha($day);
				$discount->setHora($hours);

				$id = $this->DiscountBd->to_update($discount,$id);
				$view = "MESSAGE";
				$this->message = new Message( "success", "The discount is modify valid!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$view = "MESSAGE";
				$this->message = new Message( "warning", "That date already coincides with another discount!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
		}
	}

	public function validate_day_hours($day,$hour)
	{
		$discount = false;
		if(!empty($_SESSION))
		{
			$hoursnaw = date("G:i");
			$dianaw = date ("Y-m-d");
			$modification = $dianaw .'/'. $hoursnaw;
			$modificationthisday = $day .'/'. $hour;
			
			if($modificationthisday >= $modification)
			{
				$discount = TRUE;
			}
		}
		return $discount;
	}

	public function give_discount_day($day)
	{
		$discount = $this->DiscountBd->bring_by_day($day);
		return $discount;
	}

	public function modification_of_discount_dates_to_d_m_y()
	{
		$data = null;
		$discount = $this->bring_everything();
		$i=0;
		if(!empty($discount))
		{
			foreach ($discount as $dis) {
				$data[$i] = date("Y-m-d", strtotime($dis->getFecha()));
				$i++;
			}
		}
		return $data;
	}


}