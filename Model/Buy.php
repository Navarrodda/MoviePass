<?php
namespace Model;

use Model\User as User;
use Model\Function as Function;
use Model\Discount as Discount;
class Buy
{
    private $id;
    private $user;
    private $function;
    private $discount;
    private $date;
    private $countrtiket;
    private $price;
    private $total;


    public function __construct()
    {

    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of discount
     */ 
    public function getDescuento()
    {
        return $this->discount;
    }

    /**
     * Set the value of discount
     *
     * @return  self
     */ 
    public function setDescuento(Discount $discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getFecha()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setFecha($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
         * Get the value of price
         */ 
        public function getPrecio()
        {
            return $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */ 
        public function setPrecio($price)
        {
            $this->price = $price;

            return $this;
        }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

  

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of function
     */ 
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set the value of function
     *
     * @return  self
     */ 
    public function setFunction(Function $function)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountrtiket()
    {
        return $this->countrtiket;
    }

    /**
     * @param mixed $countrtiket
     *
     * @return self
     */
    public function setCountrtiket($countrtiket)
    {
        $this->countrtiket = $countrtiket;

        return $this;
    }
}
?>