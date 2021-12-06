<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
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

Route::get('/', [FirstController::class, 'index']);
Route::get('/login', [FirstController::class, 'login']);
Route::get('/registeremployer', [FirstController::class, 'registeremployer']);
Route::post('/auth',[FirstController::class, 'auth'])->name('auth');
Route::post('/addemployer',[CompanyController::class, 'register']);
Route::get('company/loginregister/{id}', [CompanyController::class, 'registerlogin']);
Route::get('verification/{id}', [CompanyController::class, 'verify']);

Route::group(['middleware'=>'company_auth'], function(){
    Route::get('/company/profile', [CompanyController::class, 'index']);
    Route::get('/companyget', [CompanyController::class, 'cmpy']);
    Route::get('/company/logout', [CompanyController::class, 'logout']);
    Route::get('/company/settings', [CompanyController::class, 'settings']);
    Route::post('/company/update', [CompanyController::class, 'cmpupdate'])->name('cmppro.up');
    Route::post('/company/updatecp', [CompanyController::class, 'cmpupdatecp'])->name('upcp');
    Route::post('/company/updatedp', [CompanyController::class, 'cmpupdatedp'])->name('updp');
});


Route::group(['middleware'=>'admin_auth'], function(){
    Route::get('/admin',[AdminController::class, 'index']);
    Route::get('/admin/logout', [AdminController::class, 'logout']);

    //RETURN VIEWS
    Route::get('/admin/admins',[AdminController::class, 'admin']);
    Route::get('/admin/sectors',[SectorController::class, 'index']);
    Route::get('/admin/skills',[SkillController::class, 'index']);
    Route::get('/admin/edithome',[HomeController::class, 'index']);
    Route::get('/admin/company',[AdminController::class, 'company']);

    //ADMIN AJAX CRUD
    Route::post('/adminadd',[AdminController::class, 'addadmin']);
    Route::post('/adminupdate',[AdminController::class, 'updateadmin']);
    Route::post('/deleteadmin',[AdminController::class, 'deleteadmin']);
    Route::get('/adminget',[AdminController::class, 'getadmin']);
    Route::get('/editadmin/{id}',[AdminController::class, 'editadmin']);
    //ADMIN SIDE SECTOR AJAX CRUD
    Route::post('/sectoradd',[SectorController::class, 'addsector']);
    Route::post('/sectorupdate',[SectorController::class, 'updatesector']);
    Route::post('/deletesector',[SectorController::class, 'deletesector']);
    Route::get('/sectorget',[SectorController::class, 'getsector']);
    Route::get('/editsector/{id}',[SectorController::class, 'editsector']);
    //ADMIN SIDE SKILL AJAX CLRUD
    Route::post('/skilladd',[SkillController::class, 'addskill']);
    Route::get('/skillget',[SkillController::class, 'getskill']);
    Route::get('/editskill/{id}',[SkillController::class, 'editskill']);
    Route::post('/skillupdate',[SkillController::class, 'updateskill']);
    Route::post('/deleteskill',[SkillController::class, 'deleteskill']);
    //ADMIN SIDE SLIDER AJAX CRUD
    Route::post('/slideradd',[HomeController::class, 'addslider']);
    Route::get('/sliderget',[HomeController::class, 'getslider']);
    Route::get('/editslider/{id}',[HomeController::class, 'editslider']);
    Route::post('/sliderupdate',[HomeController::class, 'updateslider']);
    Route::post('/deleteslider',[HomeController::class, 'deleteslider']);

});
