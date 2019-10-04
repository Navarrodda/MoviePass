<?php
namespace Model;

class PaymentCC{
    private $cod_aut;
    private $fecha;
    private $total;

    public function __construct()
    {
        
    }

    /**
     * Get the value of cod_aut
     */ 
    public function getCod_aut()
    {
        return $this->cod_aut;
    }

    /**
     * Set the value of cod_aut
     *
     * @return  self
     */ 
    public function setCod_aut($cod_aut)
    {
        $this->cod_aut = $cod_aut;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

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
}
?>