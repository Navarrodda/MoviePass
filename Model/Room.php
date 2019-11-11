<?php 

namespace Model;

use Model\Cinema as Cinema;


class Room
{
    private $id;
    private $cinema;
    private $number;
    private $capacity;


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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     *
     * @return self
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     *
     * @return self
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }
}