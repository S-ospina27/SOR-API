<?php

namespace App\Controllers;

use App\Models\ServiceStatesModel;

class ServiceStatesController {

	private ServiceStatesModel $serviceStatesModel;

	public function __construct() {
		$this->serviceStatesModel = new ServiceStatesModel();
	}

	public function readServiceStates() {
		return $this->serviceStatesModel->readServiceStatesDB();
	}

}