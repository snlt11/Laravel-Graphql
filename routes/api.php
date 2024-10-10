<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth:api'])->group(function () {
    Route::get('/export', [UserController::class, 'export']);
    Route::post('/import', [UserController::class, 'import']);
});
