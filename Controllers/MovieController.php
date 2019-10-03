<?php
	namespace Controllers;

	use Dao\MovieFileDao as MovieFileDao;

	class MovieController
	{
		private $MovieFileDao;

		public function __construct()
		{
			$this->MovieFileDao = new MovieFileDao();
		}

		public function getList()
		{
			$this->MovieFileDao->getNowApi();
		}

	}
?>