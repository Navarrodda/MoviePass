<?php
	namespace Controllers;

	use Dao\CinemaFileDao as CinemaFileDao;

	class CinemaController
	{
		private $cinemaFileDao;

		public function __construct()
		{
			$this->cinemaFileDao = new CinemaFileDao();
		}

		public function add()
		{
			return $this->cinemaFileDao->addCinema($capacidad,$direccion,$nombre,$valor_entrada);
		}

		public function remove($id)
		{
			return $this->cinemaFileDao->removeCinema($id);
		}
	}
?>