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

		public function getList()
		{
			$api = $this->MovieFileDao->getNowApi();
			return $api;
		}

		public function getMovieByGenre($id)
		{

			return $this->MovieFileDao->getMovieByGenre($id);
		}

	}
?>