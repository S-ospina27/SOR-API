<?php

require_once(__DIR__ . "/../vendor/autoload.php");

header("Content-Type: application/json");

use LionRoute\Route;

Route::init();
include_once("../routes/web.php");
Route::dispatch();