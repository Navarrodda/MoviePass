<?php

namespace Controllers;

//Modelo
use \Model\User as User;
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

	public function check_in($name, $lastname, $dni, $nikname, $email, $password, $pass2){
		try{
			$regCompleted = FALSE;

			$name = ucwords($name);
			$lastname = ucwords($lastname);
			$nikname = ucwords($nikname);

			if(!$this->daoUser->verify_email($email)){
				$id = 3;
				$userInstance = new User($nikname, $email, $name, $lastname, $dni, $password, $this->daoRole->bring_by_id($id));
				$idUser = $this->daoUser->add($userInstance);
				$userInstance->setId($idUser);
				$regCompleted = TRUE;
			}
			if($regCompleted == TRUE)
			{
				$view = "MESSAGE";
				$this->message = new Message( "success", "The User was registered successfully!" );
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
