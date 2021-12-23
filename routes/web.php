<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SavecmpyController;
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

//login routes

Route::get('/login', [FirstController::class, 'login']);
Route::post('/auth',[FirstController::class, 'auth'])->name('auth');

//company registration process

Route::get('/registeremployer', [FirstController::class, 'registeremployer']);
Route::post('/addemployer',[CompanyController::class, 'register']);
Route::get('company/loginregister/{id}', [CompanyController::class, 'registerlogin']);
Route::get('verification/{id}/{id2}', [CompanyController::class, 'verify']);
Route::get('cmpdeactivate/{id}/{id2}', [CompanyController::class, 'confirmda']);
Route::get('cmpreactivate/{id}/{id2}', [CompanyController::class, 'confirmra']);

//employee registraton process

Route::get('/registeremployee', [FirstController::class, 'registeremployee']);
Route::post('/addemployee',[EmployeeController::class, 'register'])->name('addempl');
Route::get('candidate/loginregister/{id}', [EmployeeController::class, 'registerlogin']);
Route::get('verificationcd/{id}/{id2}', [EmployeeController::class, 'verify']);
Route::get('/google',[GoogleController::class, 'redirectToGoogle']);
Route::get('/google/callback',[GoogleController::class, 'handleGoogleCallBack']);
Route::get('cmpdeactivate/cd/{id}/{id2}', [EmployeeController::class, 'confirmda']);
Route::get('cmpreactivate/cd/{id}/{id2}', [EmployeeController::class, 'confirmra']);

//forgot password process

Route::get('/forgotpassword', [FirstController::class, 'forgotpassword']);
Route::post('/forgotpassword/mail', [FirstController::class, 'fpwmail']);
Route::post('/forgotpassword/verifycode', [FirstController::class, 'fpwvc']);
Route::post('/forgotpassword/newpassword', [FirstController::class, 'fpwnp']);

//email change process

Route::get('emailchange/{id}/{id2}', [CompanyController::class, 'emailchange']);
Route::get('emailchange/cd/{id}/{id2}', [EmployeeController::class, 'emailchange']);

//emplyee middleware group and crud

//
Route::get('/findskill',[SkillController::class, 'skillall']);


Route::group(['middleware'=>'employee_auth'], function(){
    Route::get('/candidate/profile', [EmployeeController::class, 'index']);
    Route::get('/candidate/settings', [EmployeeController::class, 'settings']);
    Route::get('/candidate/logout', [EmployeeController::class, 'logout']);
    Route::get('/candidateget',[EmployeeController::class, 'getcandidate']);

    //account settings crud

    Route::post('/candidate/updatename', [EmployeeController::class, 'candupdatename'])->name('upname2');
    Route::post('/candidate/updateun', [EmployeeController::class, 'candupdateun'])->name('upun2');
    Route::post('/candidate/updatepw', [EmployeeController::class, 'candupdatepw'])->name('uppw2');
    Route::post('/candidate/updatepn', [EmployeeController::class, 'candupdatepn'])->name('uppn2');
    Route::post('/candidate/updateemail', [EmployeeController::class, 'candupdateemail'])->name('candupemail');
    Route::post('/candidate/deactivate', [EmployeeController::class, 'canddeactivate']);
    Route::post('/candidate/reactivate', [EmployeeController::class, 'candreactivate']);

    //profile edit crud
    Route::post('/candidate/taedit', [EmployeeController::class, 'taedit']);
    Route::post('/candidate/contedit', [EmployeeController::class, 'contedit']);
    Route::post('/candidate/skilledit', [EmployeeController::class, 'skilledit'])->name('candskill');
    Route::post('/candidate/educationedit', [EmployeeController::class, 'educationedit'])->name('candedu');
    Route::post('/candidate/experienceedit', [EmployeeController::class, 'experienceedit'])->name('candexp');
    Route::post('/candidate/updatecp', [EmployeeController::class, 'candupdatecp'])->name('upcp2');
    Route::post('/candidate/updatedp', [EmployeeController::class, 'candupdatedp'])->name('updp2');

    //employee job application
    Route::get('candidate/findjobs', [JobController::class,'findjobs']);
    Route::get('candidate/job/{id}', [JobController::class, 'candjobdet']);
    Route::post('candidate/job/apply', [ApplicationController::class, 'apply'])->name('apply');
    Route::get('candidate/appliedjobs', [EmployeeController::class, 'appliedjobs']);
    Route::get('/candidate/company/{id}',[EmployeeController::class, 'cmpyprofile']);

    //save company crud
    Route::post('/candidate/savecmpy',[SavecmpyController::class, 'savecmpy']);
    Route::get('/candidate/savedcompanies',[SavecmpyController::class, 'savedcmpy']);
    Route::post('/candidate/unsavecmpy',[SavecmpyController::class, 'unsavecmpy'])->name('unsavecmpy');
});

//company middleware group and crud

Route::group(['middleware'=>'company_auth'], function(){
    Route::get('/company/profile', [CompanyController::class, 'index']);
    Route::get('/company/settings', [CompanyController::class, 'settings']);
    Route::get('/company/postajob', [JobController::class, 'index']);
    Route::get('/company/jobsmanager', [JobController::class, 'jobmanager']);
    Route::get('/job/{id}', [JobController::class, 'jobdetail']);
    Route::get('/managejob/{id}', [JobController::class, 'managejob']);
    Route::get('/job/edit/{id}', [JobController::class, 'jobedit']);
    Route::post('/addjob', [JobController::class, 'postjob'])->name('postjob');
    Route::post('/editjob', [JobController::class, 'editjob']);
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
    Route::post('/company/shortlist', [JobController::class, 'shortlist']);
    Route::post('/company/hire', [JobController::class, 'hire'])->name('hire');
    Route::get('/company/candidate/{id}',[CompanyController::class, 'candprofile']);
});

//admin middleware group nad crud

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

    //ADMIN SIDE SKILL AJAX CRUD

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
