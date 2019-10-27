<?php

namespace Model;

class Cinema
{
	private $id;
	private $capacidad;
	private $direccion;
	private $nombre;
	private $valor_entrada;
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
	 * Get the value of capacidad
	 */ 
	public function getCapacidad()
	{
		return $this->capacidad;
	}

	/**
	 * Set the value of capacidad
	 *
	 * @return  self
	 */ 
	public function setCapacidad($capacidad)
	{
		$this->capacidad = $capacidad;

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

	/**
	 * Get the value of valor_entrada
	 */ 
	public function getValor_entrada()
	{
		return $this->valor_entrada;
	}

	/**
	 * Set the value of valor_entrada
	 *
	 * @return  self
	 */ 
	public function setValor_entrada($valor_entrada)
	{
		$this->valor_entrada = $valor_entrada;

		return $this;
	}
}