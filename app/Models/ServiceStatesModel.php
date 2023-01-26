<?php

namespace App\Models;

use LionSQL\Drivers\MySQL as DB;

class ServiceStatesModel {

	public function __construct() {

	}

	public function readServiceStatesDB() {
		return DB::table('service_states')->select()->getAll();
	}

}