<?php
	namespace Controllers; 

	use Dao\GenreFileDao as GenreFileDao;

	class GenreController
	{
		private $GenreFileDao;

		public function __construct()
		{
			$this->GenreFileDao = new GenreFileDao();
		}

		// Devuelve un Array de Generos desde la api.
		public function getList()
		{
			$api = $this->GenreFileDao->getNowApi();
			die(var_dump($api));
			return $api;
		}

	}
?>