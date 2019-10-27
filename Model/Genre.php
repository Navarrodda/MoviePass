<?php
	namespace Model;

	class Genre
	{
        private $id;
        private $id_api;
		private $name;
        private $image;
    
        public function __construct()
		{

		}

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         *
         * @return self
         */
        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         *
         * @return self
         */
        public function setName($name)
        {
            $this->name = $name;

            return $this;
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        /**
         * Get the value of id_api
         */ 
        public function getId_api()
        {
                return $this->id_api;
        }

        /**
         * Set the value of id_api
         *
         * @return  self
         */ 
        public function setId_api($id_api)
        {
                $this->id_api = $id_api;

                return $this;
        }
}
?>