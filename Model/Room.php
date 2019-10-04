<?php 

namespace Model;

class Room
{
    private $id;
    private $numero_sala;
    private $descripcion;
    
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
     * Get the value of numero_sala
     */ 
    public function getNumero_sala()
    {
        return $this->numero_sala;
    }

    /**
     * Set the value of numero_sala
     *
     * @return  self
     */ 
    public function setNumero_sala($numero_sala)
    {
        $this->numero_sala = $numero_sala;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}