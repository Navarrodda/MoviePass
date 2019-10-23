<?php
	namespace Controllers;

	use \Model\Movie as Movie;
	use \Model\Message as Message;

	use \Dao\MovieFileDao as MovieFileDao;
	use \Dao\MovieBdDao as Moviebd;

	class MovieController
	{
		private $MovieFileDao;
		private $MovieBddao;

		public function __construct()
		{
			$this->MovieFileDao = new MovieFileDao();
			$this->MovieBddao = Moviebd::getInstance();
		}

		public function getList($page)
		{
			$api = $this->MovieFileDao->getNowApi($page);
			return $api;
		}

		public function getMovieByGenre($id)
		{

			return $this->MovieFileDao->getMovieByGenre($id);
		}
		//devuelve cant paginas;
		public function getAllPages()
		{
			return $this->MovieFileDao->getPages();
		}

		public function choose_movie($idmovie,$page){
		try{
			$regCompleted = FALSE;

			if($this->MovieFileDao->getMovieById($idmovie,$page)){
			$movie = $this->MovieFileDao->getMovieById($idmovie,$page);
			$this->MovieBddao->add($movie,$page);
			$regCompleted = TRUE;
		}
		if($regCompleted)
		{
			$view = "MESSAGE";
			$this->message = new Message( "success", "piola!" );
			include URL_VISTA . 'header.php';
			require(URL_VISTA . 'message.php');
			include URL_VISTA . 'footer.php';
		}
		else
		{
			$view = "MESSAGE";
			$this->message = new Message( "warning", "no!" );
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
?>