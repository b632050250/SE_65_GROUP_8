<?php

use Illuminate\Support\Facades\Route;
//earn
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\SearchplaceController;

//new
use App\Http\Controllers\Desktop31Controller;
use App\Http\Controllers\Desktop9Controller;
//jiji
use App\Http\Controllers\DonateController;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\ProfileController;

//tong
use App\Http\Controllers\ViewGroupController;
use App\Http\Controllers\GroupController;
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


    // return view('welcome');
    // Route::get('/about',[ViewGroupController::class,'index'])->name('about');

Auth::routes();
Route::get('/', [App\Http\Controllers\welcomeController::class,'index'])->name('welcome');
Route::get('/home', [ViewGroupController::class,'index'])->name('about');
Route::get('dropdown', [DropdownController::class, 'view'])->name('dropdownView');
Route::post('api/fetch-districts', [DropdownController::class, 'getDistricts']);
Route::post('api/fetch-subdistricts', [DropdownController::class, 'getSubdistricts']);
//earn
Route::get('/province', [DropdownController::class, 'view1'])->name('province');
Route::post('/search', [DropdownController::class, 'searchDog']);

//new
Route::get('/Desktop31', [Desktop31Controller::class, 'view']);
Route::post('/place/add',[Desktop31controller::class,'store'])->name('addplace');
Route::get('/Desktop9',[Desktop9Controller::class,'Desktop9']);
Route::post('/Dog/add',[Desktop9controller::class,'insert'])->name('adddog');
//kanun
Route::get('/selectDonate/{id}', [App\Http\Controllers\OpenDonateController::class, 'index']);
Route::get('/selectDonate/forFood/{id}', [App\Http\Controllers\OpenDonateController::class, 'food']);
Route::get('/selectDonate/forTreat/{id}', [App\Http\Controllers\OpenDonateController::class, 'treat']);
Route::get('/forTreatgroup/{id}', [App\Http\Controllers\OpenDonateController::class, 'treatGroup']);
Route::get('/forTreatsingle/{id}', [App\Http\Controllers\OpenDonateController::class, 'treatSingle']);
Route::get('/selectDonate/forTreat/singleSelected/{id}/{dogID}', [App\Http\Controllers\OpenDonateController::class, 'treatSingleSelected']);
Route::get('/requestDonate', [App\Http\Controllers\OpenDonateController::class, 'requestDonate']);
Route::get('/requestDonate/select/{id}', [App\Http\Controllers\OpenDonateController::class, 'donorSelect']);
Route::post('/requestDonate/save', [App\Http\Controllers\OpenDonateController::class, 'donorSelectSave']);
Route::get('/selectGroup', [App\Http\Controllers\OpenDonateController::class, 'selectGroup']);
Route::post('/createFood', [App\Http\Controllers\OpenDonateController::class, 'createFoodDonate']);
Route::post('/createTreatGroup', [App\Http\Controllers\OpenDonateController::class, 'createTreatGroupDonate']);
Route::post('/createTreatSingle', [App\Http\Controllers\OpenDonateController::class, 'createTreatSingleDonate']);
Route::get('/random/{id}', [App\Http\Controllers\OpenDonateController::class, 'random']);
//tam
Route::get('/editgroup/{groupID}',[App\Http\Controllers\EditGroupController::class, 'index'])->name('editgroupdog');
Route::put('/edit-dog/{dogID}', [App\Http\Controllers\EditDogController::class, 'update'])->name('edit-dog.update');
Route::get('/edit-dog/{dogID}', [App\Http\Controllers\EditDogController::class, 'edit'])->name('edit-dog');
//jiji
Route::controller(DonateController::class)->group(function(){
    Route::get('/donate/index/{id}', 'index')->name('donate.food') ;
    Route::post('/donate/cost', 'cost')->name('donate.cost')  ;

}) ;
#Route::post('/donate/cost', [DonateController::class,'cost']) ;

/* Route::controller(PostController::class)->group(function(){
    Route::get('/post/choose', 'choose') ;
    Route::get('/post/food','food') ->name('food') ;
    Route::get('/post/treated','treated')->name('treated')  ;
}) ; */

Route::controller(ApproveController::class)->group(function(){
    Route::get('/approve/index', 'index')->name('approve.index') ;
    Route::get('/approve/post', 'post')->name('approve.post') ;
    Route::get('/approve/mypost', 'mypost')->name('approve.mypost') ;
    Route::post('/approve/approve', 'approve')->name('approve.approve') ;
    Route::get('/approve/disapprove', 'disapprove')->name('approve.disapprove') ;
    Route::get('/approve/donate', 'donate')->name('approve.donate') ;
    Route::post('/approve/approvedonate', 'approvedonate')->name('approve.approvedonate') ;
    Route::get('/approve/disapprovedonate', 'disapprovedonate')->name('approve.disapprovedonate') ;
    Route::get('/approve/posthistory', 'posthistory')->name('approve.posthistory') ;
    Route::get('/approve/donatehistory', 'donatehistory')->name('approve.donatehistory') ;
    Route::get('/approve/mypostdetails', 'mypostdetails')->name('approve.mypostdetails') ;
    Route::post('/approve/approvedonateimage', 'approvedonateimage')->name('approve.approvedonateimage') ;
}) ;

Route::controller(ProfileController::class)->group(function(){
    Route::get('/profile/index', 'index')->name('profile.index') ;
    Route::get('/profile/update', 'update')->name('profile.update') ;
    Route::post('/profile/save', 'save')->name('profile.save') ;

}) ;
//tong
// Route::get('/about',[ViewGroupController::class,'index'])->name('about');
Route::get('/Group/{groupofdogID}',[GroupController::class,'index']);

//kanunReport
Route::get('/sentReport/{id}', [App\Http\Controllers\ReportController::class, 'sent']);
Route::post('/sented', [App\Http\Controllers\ReportController::class, 'sented']);
Route::get('/showReport', [App\Http\Controllers\ReportController::class, 'index']);
Route::get('/report', [App\Http\Controllers\ReportController::class, 'report']);
Route::post('/reported', [App\Http\Controllers\ReportController::class, 'reported']);
