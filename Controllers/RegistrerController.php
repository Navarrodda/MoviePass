<?php

namespace Controllers;

//Modelo
use \Model\User as user;
use \Model\Role as role;
use \Model\Message as Message;;

//Dao

use \Dao\RolBdDao as RoleBd;
use \Dao\UserBdDao as UserBD;

class RegistrerController
{

	protected $daoRole;
	protected $daoUser;

	public function __construct()
	{
		$this->daoRole = RoleBd::getInstance();
		$this->daoUser = UserBD::getInstance();
	}

	public function check_in($nikname, $email, $password, $pass2){
		try{
			$regCompleted = FALSE;

			$nombre = ucwords($nikname); 

			if(!$this->daoUser->verify_email($email)){
				$id = 3;
				print_r("llego");
				$userInstance = new user($nikname, $email, $password, $this->daoRole->bring_by_id($id));
				print_r("r");
				$idUser = $this->daoUser->add($userInstance);
				$userInstance->setId($idUser);
				$regCompleted = TRUE;
			}
			if($regCompleted == TRUE)
			{
				$view = "MESSAGE";
				$this->message = new Message( "success", "The user was registered successfully!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$view = "MESSAGE";
				$this->message = new Message( "warning", "Email entered existing!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
		}catch(\PDOException $pdo_error){
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'error.php');
			include URL_VISTA . 'footer.php';
		}catch(\Exception $error){
			echo $error->getMessage();
		}
	}

}
