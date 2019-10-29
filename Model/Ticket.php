<?php

namespace Model;

class Ticket
{
    private $id;
    private $nro_entrada;    //nro_entrada = id_compra
    private $nro_funcion;   //nro_funcion = id_funcion 
    private $qr;

	 public function __construct()
    {

    }
    
    /**
     * Get the value of nro_funcion
     */ 
    public function getNro_funcion()
    {
        return $this->nro_funcion;
    }

    /**
     * Set the value of nro_funcion
     *
     * @return  self
     */ 
    public function setNro_funcion($nro_funcion)
    {
        $this->nro_funcion = $nro_funcion;

        return $this;
    }


    /**
     * Get the value of nro_entrada
     */ 
    public function getNro_entrada()
    {
        return $this->nro_entrada;
    }

    /**
     * Set the value of nro_entrada
     *
     * @return  self
     */ 
    public function setNro_entrada($nro_entrada)
    {
        $this->nro_entrada = $nro_entrada;

        return $this;
    }

    /**
     * Get the value of qr
     */ 
    public function getQr()
    {
        return $this->qr;
    }

    /**
     * Set the value of qr
     *
     * @return  self
     */ 
    public function setQr($qr)
    {
        $this->qr = $qr;

        return $this;
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
}