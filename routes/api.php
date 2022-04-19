<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\DoctorControler;
use App\Http\Controllers\LoginController;
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

Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {
    return $request->user();
} );


    Route::post( '/login', [LoginController::class,'verify'] );
    //alldoctor
    Route::get( '/alldoctor', [adminController::class,'alldoctor'] );
    Route::get( '/allpatient', [adminController::class,'allpatient'] );
    Route::post( '/deletepatient/{id}', [adminController::class,'deletepatient'] );
    //add doctor
    Route::post( '/adddoctor', [adminController::class,'Adddoctor'] );
    Route::get( '/allappointment', [adminController::class,'Allappointment'] );
    Route::post( '/addreceptionist', [adminController::class,'AddReciptionist'] );
    Route::get( '/allreceptionist', [adminController::class,'allreceptionist'] );
    Route::get( '/singlereceptionist/{id}', [adminController::class,'Singlereceptionist'] );
    Route::post( '/updatereceptionist', [adminController::class,'Updatereceptionst'] );


    Route::get( '/singledoctor/{id}', [adminController::class,'Singledoctor'] );

    Route::post( '/updatedoctor', [adminController::class,'Updatedoctor'] );
    Route::get( '/adminprofile/{id}', [adminController::class,'adminprofile'] );
    Route::post( '/updateadminprofile', [adminController::class,'adminprofile'] );
    Route::post( '/updateadminprofile', [adminController::class,'Updateadminprfile'] );




   ///Docotr
//Route::get( '/doctorprofile/{id}', [Doctor::class,'Doctoprofile'] );
Route::get( '/doctorprofile/{id}', [DoctorControler::class,'Doctoprofile'] );
Route::post( '/updatedoctorprofile', [DoctorControler::class,'Updatedoctorprfile'] );
Route::get( '/doctorappointments/{id}', [DoctorControler::class,'Appointment'] );
Route::post( '/deleteappointment/{id}', [DoctorControler::class,'DeleteAppointment'] );
Route::post( '/updateaptstatus', [DoctorControler::class,'Updateaptstatus'] );
Route::get( '/allpatientdc', [adminController::class,'Allpatient'] );
