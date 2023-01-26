<?php

namespace App\Controllers;

class HomeController {

	public function __construct() {

	}

	public function index() {
		return ['message' => "Hola mundo desde Controller"];
	}

}