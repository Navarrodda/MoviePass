<?php
namespace Model;
use Model\Shopping as Shopping;
use Model\Movie as Movie;
class Ticket
{
    private $id;
    private $shopping; 
    private $movie;
    private $seat;  
    private $qr;
    private $numbre;
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
    public function getShopping()
    {
        return $this->shopping;
    }
    /**
     * @param mixed $shopping
     *
     * @return self
     */
    public function setShopping(Shopping $shopping)
    {
        $this->shopping = $shopping;
        return $this;
    }
    /**
     * @return mixed
     */
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
    public function getSeat()
    {
        return $this->seat;
    }
    /**
     * @param mixed $seat
     *
     * @return self
     */
    public function setSeat($seat)
    {
        $this->seat = $seat;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getQr()
    {
        return $this->qr;
    }
    /**
     * @param mixed $qr
     *
     * @return self
     */
    public function setQr($qr)
    {
        $this->qr = $qr;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getNumbre()
    {
        return $this->numbre;
    }
    /**
     * @param mixed $numbre
     *
     * @return self
     */
    public function setNumbre($numbre)
    {
        $this->numbre = $numbre;
        return $this;
    }
}
?>