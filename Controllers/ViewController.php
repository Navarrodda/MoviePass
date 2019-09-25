<?php

namespace controllers;

//Modelo
//Dao

class ViewController
{

	public function __construct()
	{
	}

	public function index()
	{
		$view = 'MOVIES';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "home.php");
		include URL_VISTA . 'footer.php';
	} 

	public function register()
	{

		$view = 'REGISTER';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "registrer.php");
		include URL_VISTA . 'footer.php';
	} 

	public function login()
	{

		$view = 'LOGIN';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "login.php");
		include URL_VISTA . 'footer.php';
	} 

	public function feature()
	{

		$view = 'FEATURE';
		include URL_VISTA . 'header.php';
		require(URL_VISTA . "feature.php");
		include URL_VISTA . 'footer.php';
	} 

}