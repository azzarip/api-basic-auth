<?php

use Azzarip\ApiBasicAuth\UpController;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    Route::get('/test', UpController::class);
});

it('sends OK status')->get('/test')->assertOk();
