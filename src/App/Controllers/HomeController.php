<?php

namespace SRC\App\Controllers;

use SRC\App\Models\HomeModel;
class HomeController {
	private $Home;
	private $response;
	private $request;

	public	function __construct($request,$response){
		$this->request =$request;
		$this->response = $response;
		$this->Home = new HomeModel();
	}

	public function Insertar(){

		return $this->Home->INSERTARDB($this->request);
	}

	public function Buscar(){


		return $this->Home->BUSCARDB($this->request);
	}

	public function mirar(){

      echo "";
	}
}