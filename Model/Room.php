<?php 

namespace Model;

use Model\Cinema as Cinema;


class Room
{
    private $id;

    private $name_room;
    private $cant_site;
    private $cinema;
    private $input_value;
    
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

    /**
     * @return mixed
     */
    public function getCinema()
    {
        return $this->cinema;
    }

    /**
     * @param mixed $cinema
     *
     * @return self
     */
    public function setCinema(Cinema $cinema)
    {
        $this->cinema = $cinema;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getInputValue()
    {
        return $this->input_value;
    }

    /**
     * @param mixed $input_value
     *
     * @return self
     */
    public function setInputValue($input_value)
    {
        $this->input_value = $input_value;

        return $this;
    }
}