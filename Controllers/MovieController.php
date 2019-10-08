<?php
	namespace Controllers;

	use \Dao\MovieFileDao as MovieFileDao;

	class MovieController
	{
		private $MovieFileDao;

		public function __construct()
		{
			$this->MovieFileDao = new MovieFileDao();
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

		public function getAllPages()
		{
			die(var_dump($this->MovieFileDao->getPages()));
		}
	}
?>