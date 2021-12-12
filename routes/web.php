<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
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
Route::get('/forgotpassword', [FirstController::class, 'forgotpassword']);
Route::post('/forgotpassword/mail', [FirstController::class, 'fpwmail']);
Route::post('/forgotpassword/verifycode', [FirstController::class, 'fpwvc']);
Route::post('/forgotpassword/newpassword', [FirstController::class, 'fpwnp']);
Route::get('/registeremployer', [FirstController::class, 'registeremployer']);
Route::post('/auth',[FirstController::class, 'auth'])->name('auth');
Route::post('/addemployer',[CompanyController::class, 'register']);
Route::get('company/loginregister/{id}', [CompanyController::class, 'registerlogin']);
Route::get('verification/{id}/{id2}', [CompanyController::class, 'verify']);
Route::get('emailchange/{id}/{id2}', [CompanyController::class, 'emailchange']);
Route::get('cmpdeactivate/{id}/{id2}', [CompanyController::class, 'confirmda']);
Route::get('cmpreactivate/{id}/{id2}', [CompanyController::class, 'confirmra']);

Route::group(['middleware'=>'company_auth'], function(){
    Route::get('/company/profile', [CompanyController::class, 'index']);
    Route::get('/company/settings', [CompanyController::class, 'settings']);
    Route::get('/company/postajob', [JobController::class, 'index']);
    Route::get('/company/jobsmanager', [JobController::class, 'jobmanager']);
    Route::get('/job/{id}', [JobController::class, 'jobdetail']);
    Route::get('/job/edit/{id}', [JobController::class, 'jobedit']);
    Route::post('/addjob', [JobController::class, 'postjob'])->name('postjob');
    Route::get('/companyget', [CompanyController::class, 'cmpy']);
    Route::get('/company/logout', [CompanyController::class, 'logout']);
    Route::post('/company/update', [CompanyController::class, 'cmpupdate'])->name('cmppro.up');
    Route::post('/company/updatecp', [CompanyController::class, 'cmpupdatecp'])->name('upcp');
    Route::post('/company/updatedp', [CompanyController::class, 'cmpupdatedp'])->name('updp');
    Route::post('/company/updatename', [CompanyController::class, 'cmpupdatename'])->name('upname');
    Route::post('/company/updateun', [CompanyController::class, 'cmpupdateun'])->name('upun');
    Route::post('/company/updatecn', [CompanyController::class, 'cmpupdatecn'])->name('upcn');
    Route::post('/company/updatepw', [CompanyController::class, 'cmpupdatepw'])->name('uppw');
    Route::post('/company/updatepn', [CompanyController::class, 'cmpupdatepn'])->name('uppn');
    Route::post('/company/updateemail', [CompanyController::class, 'cmpupdateemail'])->name('upemail');
    Route::post('/company/deactivate', [CompanyController::class, 'cmpdeactivate']);
    Route::post('/company/reactivate', [CompanyController::class, 'cmpreactivate']);
    Route::get('/findskill',[SkillController::class, 'skillall']);
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

    //ADMIN SIDE COMPANY CRUD
    Route::post('/company/adminverify',[CompanyController::class,'cmpadminverify'])->name('cav');
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
