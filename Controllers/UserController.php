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

	public function validate_connection_for_faceboock() {
		$ch = curl_init();
		$loginUrl = API. "movie/now_playing" .KEY.PAGE. 1;
		curl_setopt ($ch, CURLOPT_URL, $loginUrl );
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		if(!empty($file_contents))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function no_conection()
	{
		$this->message = new Message('danger', 'There was an error connecting!');
		$view = 'MESSAGE';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "message.php");
		include URL_VISTA . 'footer.php';
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
					$data = ucwords($data);
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
					$data = lcfirst($data);
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
			$view = 'MESSAGE';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "message.php");
			include URL_VISTA . 'footer.php';		
		}else{
			$view = 'MESSAGE';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "login.php");
			include URL_VISTA . 'footer.php';
		}

	}
	//Register on facebook
	public function registerFacebook($name, $lastname, $dni, $nikname, $email, $password)
	{
		$id = 3;
		$userInstance = new User($nikname, $email, $name, $lastname, $dni, $password, $this->daoRole->bring_by_id($id));
		$idUser = $this->daoUser->add($userInstance);
		$userInstance->setId($idUser);
	}

	//Login using facebook
	public function flogin($email)
	{
		$user = $this->daoUser->bring_by_mail($email);
		$_SESSION["id"] = $user->getId();
		$_SESSION["nikname"] = $user->getNikname();
		$_SESSION["email"] = $email;
		$_SESSION["nombre"] = $user->getName();
		$_SESSION["lastname"] = $user->getLastname();
		$_SESSION["dni"] = $user->getDni();
		$_SESSION["password"] = $user->getPassword();
		$_SESSION["rol"] = $user->getRole()->getId();
		return true;
	}

	

	//Facebook Login
	public function facebookLogin() {
		try{
			include('./Config/faceConf.php');
			$accessToken = $helper->getAccessToken();

			
		} catch (\Facebook\Exceptions\FacebookResponseException $e) {
			$this->message = new Message('danger', 'There was an error connecting!');
			$view = 'MESSAGE';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "login.php");
			include URL_VISTA . 'footer.php';
			exit();
		} catch (\Facebook\Exceptions\FacebookSDKException $e) {
			echo "Exception: " . $e->getMessage();
			exit();
		}

		if(!$accessToken) {
			$this->message = new Message('danger', 'There was an error connecting!');
			$view = 'MESSAGE';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "login.php");
			include URL_VISTA . 'footer.php';
			exit();
		}

		$oAuth2Client = $fb->getOAuth2Client();
		if (!$accessToken->isLongLived()) {
			$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		}
		$response = $fb->get("/me?fields=id, first_name, last_name, email, birthday, picture.type(large)", $accessToken);
		$userData = $response->getGraphNode()->asArray();
		$email=$userData['email'];
		if(!$this->daoUser->verify_email($email))
		{
				//check_in($name, $lastname, $dni, $nikname, $email, $password, $pass2)
			$password = $userData['picture'];
			$password = $password['url'];
			$this->registerFacebook($userData['first_name'],$userData['last_name'],null,$userData['first_name'],$userData['email'],$password);
			$ir_a_inicio = false;
				//Borro varibles de la session.
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

		}else{
			$ir_a_inicio = $this->flogin($email);
		}

		if($ir_a_inicio){
			$this->message = new Message('success', ' Welcome' . ' ' . '<i><strong>' .  $_SESSION["nombre"] 
				. '</strong>. You have successfully logged in 
				! Logged in as' . ' ' . '<i><strong>' . $_SESSION["nikname"] 
				. '</strong></i>');
			$view = 'MESSAGE';
			include URL_VISTA . 'header.php';
			require(URL_VISTA . "message.php");
			include URL_VISTA . 'footer.php';		
		}else{
			$this->message = new Message("success", "The User was registered successfully!" );
			$view = 'MESSAGE';
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
		$view = 'MESSAGE';
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

				$idnikname = $this->daoUser->bring_id_by_nikname($nikname);
				if($idnikname == NULL)
				{

					$iddni =  $this->daoUser->bring_id_by_dni($dni);
					if($iddni == NULL )
					{
						$id = 3;
						$userInstance = new User($nikname, $email, $name, $lastname, $dni, $password, $this->daoRole->bring_by_id($id));
						$idUser = $this->daoUser->add($userInstance);
						$userInstance->setId($idUser);
						$view = "MESSAGE";
						$this->message = new Message( "success", "The User was registered successfully!" );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . 'message.php');
						include URL_VISTA . 'footer.php';
					}
					else
					{
						$view = "MESSAGE";
						$this->message = new Message( "warning", "Dni entered existing!" );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . 'message.php');
						include URL_VISTA . 'footer.php';
					}
				}
				else
				{
					$view = "MESSAGE";
					$this->message = new Message( "warning", "Nikname entered existing!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . 'message.php');
					include URL_VISTA . 'footer.php';
				}
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
				if($code === "@&#341" || $code === "@&#342" )
				{
					if (!empty($code)) {
						$strip = array("~","labcdefghi","`", "!", "@", "#", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
							"}", "\\", "|", ";", ":", "\"", "'", "&#;", "&#;", "3", "4","5","6","7","8","9","10","9", "â€”", "â€“", ",", "<", ".", ">", "/", "?","20");
						$code = trim(str_replace($strip, " ", strip_tags($code)));
						$code = preg_replace('/\s+/', " ", $code);
					}
					$id = $code;
					if ($id == 1  || $id = 2) {
						if(($_SESSION["email"]))
						{
							$_SESSION["rol"] = $id;
							$user = $this->daoUser->bring_by_mail($_SESSION["email"]);
							$userInstance = new User($_SESSION["nikname"],  $_SESSION["email"], $_SESSION["nombre"], $_SESSION["lastname"],  $_SESSION["dni"], $_SESSION["password"], $this->daoRole->bring_by_id($code));
							$idUser = $this->daoUser->to_update($userInstance,$_SESSION["id"]);
							$userInstance->setId($idUser);
							$regCompleted = TRUE;
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
			return $this->daoUser->bring_by_id($_SESSION["id"]);
		}
		return NULL;
	}

	public function modification_account($name,$lastname,$dni,$nikname,$email,$pass,$pass2)
	{
		if(!empty($_SESSION["id"]))
		{
			$name = ucwords($name);
			$lastname = ucwords($lastname);
			$nikname = ucwords($nikname);

			$idemail = $this->daoUser->bring_id_by_email($email);
			if($idemail == $_SESSION["id"] || $idemail == NULL )
			{
				$idnikname = $this->daoUser->bring_id_by_nikname($nikname);
				if($idnikname == $_SESSION["id"] || $idnikname == NULL)
				{
					$iddni =  $this->daoUser->bring_id_by_dni($dni);
					if($iddni == $_SESSION["id"] || $iddni == NULL )
					{
						$userInstance = new User($nikname, $email, $name, $lastname, $dni, $pass, $this->daoRole->bring_by_id($_SESSION["id"]));
						$this->daoUser->to_update($userInstance,$_SESSION["id"]);
						$_SESSION["nikname"] = $nikname;
						$_SESSION["email"] = $email;
						$_SESSION["nombre"] = $name;
						$_SESSION["lastname"] = $lastname;
						$_SESSION["dni"] = $dni;
						$_SESSION["password"] = $pass;
						$view = "MESSAGE";
						$this->message = new Message( "success", "Modified account modification!" );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . 'message.php');
						include URL_VISTA . 'footer.php';
					}
					else
					{
						$view = "MESSAGE";
						$this->message = new Message( "warning", "Dni entered existing!" );
						include URL_VISTA . 'header.php';
						require(URL_VISTA . 'message.php');
						include URL_VISTA . 'footer.php';
					}
				}
				else
				{
					$view = "MESSAGE";
					$this->message = new Message( "warning", "Nikname entered existing!" );
					include URL_VISTA . 'header.php';
					require(URL_VISTA . 'message.php');
					include URL_VISTA . 'footer.php';
				}
			}
			else
			{
				$view = "MESSAGE";
				$this->message = new Message( "warning", "Email entered existing!" );
				include URL_VISTA . 'header.php';
				require(URL_VISTA . 'message.php');
				include URL_VISTA . 'footer.php';
			}
		}

	}

}

