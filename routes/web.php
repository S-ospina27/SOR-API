<?php

use App\Controllers\HomeController;
use App\Controllers\ServiceStatesController;
use LionRoute\Route;

Route::get("/", [HomeController::class, 'index']);

Route::get('service-states', [ServiceStatesController::class, 'readServiceStates']);