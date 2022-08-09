<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('users')->controller(\App\Http\Controllers\API\UserController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/blank', 'blank');
    Route::post('/add', 'add');
});
