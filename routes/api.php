<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::get('/export', [UserController::class, 'export']);
// Route::post('/import', [UserController::class, 'import']);

Route::get('/test',function(){
    return 'Test successful.';
});
