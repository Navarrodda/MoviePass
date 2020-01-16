<?php

namespace Model;

class Cinema
{
	private $id;
	private $direccion;
	private $nombre;
	//private $valor_entrada;
	
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
	 * Get the value of direccion
	 */ 
	public function getDireccion()
	{
		return $this->direccion;
	}

	/**
	 * Set the value of direccion
	 *
	 * @return  self
	 */ 
	public function setDireccion($direccion)
	{
		$this->direccion = $direccion;

		return $this;
	}

	/**
	 * Get the value of nombre
	 */ 
	public function getNombre()
	{
		return $this->nombre;
	}

	/**
	 * Set the value of nombre
	 *
	 * @return  self
	 */ 
	public function setNombre($nombre)
	{
		$this->nombre = $nombre;

		return $this;
	}

}