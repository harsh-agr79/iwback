<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SectorController;
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

Route::get('/', [Controller::class, 'index']);
Route::get('/login', [Controller::class, 'login']);
Route::post('/auth',[Controller::class, 'auth'])->name('auth');

Route::group(['middleware'=>'admin_auth'], function(){
    Route::get('/admin',[AdminController::class, 'index']);
    Route::get('/admin/admins',[AdminController::class, 'admin']);
    Route::get('/admin/logout', [AdminController::class, 'logout']);

    Route::get('/admin/sectors',[SectorController::class, 'index']);


    Route::post('/adminadd',[AdminController::class, 'addadmin']);
    Route::post('/adminupdate',[AdminController::class, 'updateadmin']);
    Route::post('/deleteadmin',[AdminController::class, 'deleteadmin']);
    Route::get('/adminget',[AdminController::class, 'getadmin']);
    Route::get('/editadmin/{id}',[AdminController::class, 'editadmin']);

    Route::post('/sectoradd',[SectorController::class, 'addsector']);
    Route::post('/sectorupdate',[SectorController::class, 'updatesector']);
    Route::post('/deletesector',[SectorController::class, 'deletesector']);
    Route::get('/sectorget',[SectorController::class, 'getsector']);
    Route::get('/editsector/{id}',[SectorController::class, 'editsector']);
});
