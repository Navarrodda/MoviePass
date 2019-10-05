<?php

namespace Model;

class Location
{

	private $street;
	private $number;
	
	  public function __construct()
    {

    }

	/**
	 * Get the value of street
	 */ 
	public function getStreet()
	{
		return $this->street;
	}

	/**
	 * Set the value of street
	 *
	 * @return  self
	 */ 
	public function setStreet($street)
	{
		$this->street = $street;

		return $this;
	}

	/**
	 * Get the value of number
	 */ 
	public function getNumber()
	{
		return $this->number;
	}

	/**
	 * Set the value of number
	 *
	 * @return  self
	 */ 
	public function setNumber($number)
	{
		$this->number = $number;

		return $this;
	}
}