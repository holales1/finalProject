<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/comparison', function () {
    return view('compareWebsites');
});

Route::post('comparison', [ComparisonController::class,'store']);
Route::get('login', [UserController::class,'index']);
Route::post('login/checklogin', [UserController::class,'checklogin']);
Route::get('logout', [UserController::class,'logout']);

Route::get('ajax-request', [AjaxController::class,'create']);
Route::post('ajax-request', [AjaxController::class,'store']);
