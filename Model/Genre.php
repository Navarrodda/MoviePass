<?php
namespace Model;

class Genre
{
    private $id;
    private $idapi;
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
     * @return mixed
     */
    public function getIdapi()
    {
        return $this->idapi;
    }

    /**
     * @param mixed $idapi
     *
     * @return self
     */
    public function setIdapi($idapi)
    {
        $this->idapi = $idapi;

        return $this;
    }
}
