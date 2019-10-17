<?php

namespace Controllers;

//Modelo
use \Model\User as user;
use \Model\Role as role;
use \Model\Message as Message;;

//Dao
use \Dao\UserBdDao as UserBD;


class SessionController
{

	protected $daoUser;
	

	public function __construct()
	{
		$this->daoUser = UserBD::getInstance();
	}

	public function login($data, $password)
	{
		try {
			$ir_a_inicio = FALSE;

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
							$_SESSION["email"] = $data;
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

}