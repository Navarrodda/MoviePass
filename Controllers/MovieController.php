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
		//devuelve cant paginas;
		public function getAllPages()
		{
			return $this->MovieFileDao->getPages();
		}
	}
?>