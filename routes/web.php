<?php

use App\Controllers\HomeController;
use LionRoute\Route;

Route::get("/", [HomeController::class, 'index']);