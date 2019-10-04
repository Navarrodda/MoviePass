<?php 

 namespace Model;

 class Seat
 {
	 private $nro_asiento;
	 private $fila;
	 
 	public function __construct()
 	{
 		
 	}

	 /**
	  * Get the value of nro_asiento
	  */ 
	 public function getNro_asiento()
	 {
	 	 return $this->nro_asiento;
	 }

	 /**
	  * Set the value of nro_asiento
	  *
	  * @return  self
	  */ 
	 public function setNro_asiento($nro_asiento)
	 {
	 	 $this->nro_asiento = $nro_asiento;

	 	 return $this;
	 }

	 /**
	  * Get the value of fila
	  */ 
	 public function getFila()
	 {
	 	 return $this->fila;
	 }

	 /**
	  * Set the value of fila
	  *
	  * @return  self
	  */ 
	 public function setFila($fila)
	 {
	 	 $this->fila = $fila;

	 	 return $this;
	 }
 }