<?php
	namespace Controllers; 

	use Dao\GenreDao as GenreDao;

	class GenreController
	{
		private GenreFileDao;

		public function __construct()
		{
			GenreFileDao = new GenreFileDao();
		}

	}
?>