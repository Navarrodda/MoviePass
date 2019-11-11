<?php 

namespace Model;

class Room
{
    private $id;
    private $name_room;
    private $price;
    private $cant_site;
    
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
    public function getNameRoom()
    {
        return $this->name_room;
    }

    /**
     * @param mixed $name_room
     *
     * @return self
     */
    public function setNameRoom($name_room)
    {
        $this->name_room = $name_room;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCantSite()
    {
        return $this->cant_site;
    }

    /**
     * @param mixed $cant_site
     *
     * @return self
     */
    public function setCantSite($cant_site)
    {
        $this->cant_site = $cant_site;

        return $this;
    }
}