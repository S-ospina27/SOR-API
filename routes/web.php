<?php

use App\Controllers\HomeController;
use LionRoute\Route;
use SorHelpers\Validate;

Route::get("/", [HomeController::class, 'index']);

Route::post("data", function() {
	return [
		'status' => (new Validate)->isEmpty(request->name)
	];
});