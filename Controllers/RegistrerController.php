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
				/*
				ini_set( 'display_errors', 1 );
				error_reporting( E_ALL );
				$from = "test@hostinger-tutorials.com";
				$to = "test@gmail.com";
				$subject = "Checking PHP mail";
				$message = "PHP mail works just fine";
				$headers = "From:" . $from;
				mail($to,$subject,$message, $headers);
				echo "The email message was sent.";
			);*/
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

public function change_priority($code){
	try{
		if(!empty($_SESSION))
		{
			if (!empty($code)) {

				$strip = array("~", "`", "!", "@", "#", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
					"}", "\\", "|", ";", ":", "\"", "'", "&#;", "&#;", "3", "4","5","6","7","8","9","10","9", "â€”", "â€“", ",", "<", ".", ">", "/", "?","20");
				$code = trim(str_replace($strip, " ", strip_tags($code)));
				$code = preg_replace('/\s+/', " ", $code);
			}
			$id = $code;
			$_SESSION["rol"] = $id;
			if ($id == 1  && $id = 2) {

				if(substr_count($_SESSION["data"], "@") == 1)
				{

					$user = $this->daoUser->bring_by_mail($_SESSION["data"]);
					$userInstance = new User($_SESSION["nikname"],  $_SESSION["data"], $_SESSION["nombre"], $_SESSION["lastname"],  $_SESSION["dni"], $_SESSION["password"], $this->daoRole->bring_by_id($code));
					$idUser = $this->daoUser->to_update($userInstance,$_SESSION["id"]);
					$userInstance->setId($idUser);
					$regCompleted = TRUE;
				}
				else
				{
					$user = $this->daoUser->bring_by_nikname($_SESSION["data"]);
					$nikname = $_SESSION["data"];
					$userInstance = new User($_SESSION["data"], $_SESSION["email"], $_SESSION["nombre"], $_SESSION["lastname"],  $_SESSION["dni"], $_SESSION["password"], $this->daoRole->bring_by_id($code));
					$idUser = $this->daoUser->to_update($userInstance,$_SESSION["id"]);
					$userInstance->setId($idUser);
					$regCompleted = TRUE;

					//Email probar 
					/*
					ini_set( 'display_errors', 1 );
					error_reporting( E_ALL );
					$from = "test@hostinger-tutorials.com";//email de MoviePass
					$to = "test@gmail.com"; //destinatario
					$subject = "Checking PHP mail";
					$message = "PHP mail works just fine";
					$headers = "From:" . $from;
					mail($to,$subject,$message, $headers);
					echo "The email message was sent.";
					*/
				}
			}
			if($regCompleted == TRUE)
			{
				$view = "MESSAGE";
				$this->message = new Message( "success", "Valid key!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
			else
			{
				$view = "MESSAGE";
				$this->message = new Message( "warning", "Invalid key!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
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
