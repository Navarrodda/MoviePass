<?php 

namespace Model;

use Model\Movie as Movie;
use Model\Room as Room;

class Fuction
{
    private $id;
    private $room;
    private $movie;
    private $dia;
    private $hora;

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


    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param mixed $movie
     *
     * @return self
     */
    public function setMovie(Movie $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * @param mixed $dia
     *
     * @return self
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @param mixed $hora
     *
     * @return self
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param mixed $room
     *
     * @return self
     */
    public function setRoom(Room $room)
    {
        $this->room = $room;

        return $this;
    }
}