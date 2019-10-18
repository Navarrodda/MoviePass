<?php

namespace Controllers;

//Modelo
use \Model\User as User;
use \Model\Role as role;
use \Model\Message as Message;

//Dao

use \Dao\RolBdDao as RoleBd;
use \Dao\UserBdDao as UserBD;


class UserController
{

	protected $daoRole;
	protected $daoUser;
	

	public function __construct()
	{
		$this->daoRole = RoleBd::getInstance();
		$this->daoUser = UserBD::getInstance();
	}


	public function login($data, $password)
	{
		try {
			$ir_a_inicio = FALSE;
			
			$data = ucwords($data);

			if (isset($data) && isset($password))  {
				if ($data === "" || $password === "") {
					$this->message = new Message('warning', 'You must fill in all fields!');
				} else {
					/** @var Cuenta $usuario */
					if($this->daoUser->bring_by_nikname($data));
					{

						$user = $this->daoUser->bring_by_nikname($data);

						if ($data === $user->getNikname() && $password === $user->getPassword()) {
							$rol = $user->getRole();
                        //Seteo las variables de sesión.
							$_SESSION["id"] = $user->getId();
							$_SESSION["nikname"] = $data;
							$_SESSION["email"] = $user->getEmail();
							$_SESSION["nombre"] = $user->getName();
							$_SESSION["lastname"] = $user->getLastname();
							$_SESSION["dni"] = $user->getDni();
							$_SESSION["password"] = $password;
							$_SESSION["rol"] = $rol->getId();
							$result = $user->getName() . ' ' . $user->getLastname();
							$ir_a_inicio = TRUE;				
						}

					}
					if($this->daoUser->bring_by_mail($data))
					{
						$user = $this->daoUser->bring_by_mail($data);
						if ($data === $user->getEmail() && $password === $user->getPassword()) {
							$rol = $user->getRole();
                        //Seteo las variables de sesión.
							$_SESSION["id"] = $user->getId();
							$_SESSION["nikname"] = $user->getNikname();
							$_SESSION["email"] = $data;
							$_SESSION["nombre"] = $user->getName();
							$_SESSION["lastname"] = $user->getLastname();
							$_SESSION["dni"] = $user->getDni();
							$_SESSION["password"] = $password;
							$_SESSION["rol"] = $rol->getId();
							$result = $user->getName() . ' ' . $user->getLastname();
							$ir_a_inicio = TRUE;
						}
					}


					if ($ir_a_inicio) {
                        //Message de success
						$this->message = new Message('success', ' Welcome' . ' ' . '<i><strong>' .  $result 
							. '</strong>. You have successfully logged in 
							! Logged in as' . ' ' . '<i><strong>' .  $data 
							. '</strong></i>');

					} else {
						$this->message = new Message('warning', 'The data entered is incorrect!');
					}
				}
			}


			else {
				throw new \Exception('Login failed, try again later!');
			}


		}

		catch (\PDOException $e) {
			$this->message = new Message('danger', 'There was an error connecting to the database! ' . $e);
		} catch (\Exception $exception) {
			$this->message = new Message('danger', $exception->getMessage());
		}

		if($ir_a_inicio){
			$view = 'MENSSAGE';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "message.php");
			include URL_VISTA . 'footer.php';		
		}else{
			$view = 'MENSSAGE';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "login.php");
			include URL_VISTA . 'footer.php';
		}

	}
	public function logout()
	{
        // Elimio las variables de sesión y sus valores.
		$_SESSION = array();
        // Eliminamos la cookie del usuario que identifcaba a esa sesión, verifcando "si existía".
		if (ini_get("session.use_cookies") == true) {
			$parametros = session_get_cookie_params();
			setcookie(
				session_name(),
				'',
				time() - 99999,
				$parametros["path"],
				$parametros["domain"],
				$parametros["secure"],
				$parametros["httponly"]
			);
		}

		session_destroy();

		$this->message = new Message('info', 'You have logged out!');
		$view = 'MENSSAGE';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "message.php");
		include URL_VISTA . 'footer.php';
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
			$regCompleted = FALSE;
			if (!empty($code)) {

				$strip = array("~", "`", "!", "@", "#", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
					"}", "\\", "|", ";", ":", "\"", "'", "&#;", "&#;", "3", "4","5","6","7","8","9","10","9", "â€”", "â€“", ",", "<", ".", ">", "/", "?","20");
				$code = trim(str_replace($strip, " ", strip_tags($code)));
				$code = preg_replace('/\s+/', " ", $code);
			}
			$id = $code;
			if ($id == 1  || $id = 2) {

				if(substr_count($_SESSION["data"], "@") == 1)
				{
					$_SESSION["rol"] = $id;
					$user = $this->daoUser->bring_by_mail($_SESSION["data"]);
					$userInstance = new User($_SESSION["nikname"],  $_SESSION["data"], $_SESSION["nombre"], $_SESSION["lastname"],  $_SESSION["dni"], $_SESSION["password"], $this->daoRole->bring_by_id($code));
					$idUser = $this->daoUser->to_update($userInstance,$_SESSION["id"]);
					$userInstance->setId($idUser);
					$regCompleted = TRUE;
				}
				else
				{
					$_SESSION["rol"] = $id;
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

public function bring_by_id()
{
	if(!empty($_SESSION["id"]))
	{
		$user = $this->daoUser->bring_by_id($_SESSION["id"]);
	}
	return $user;
}
}

