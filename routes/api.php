<?php

use App\Http\Controllers\adminController;
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
    Route::post( '/addreceptionist', [adminController::class,'AddReciptionist'] );
    Route::get( '/allreceptionist', [adminController::class,'allreceptionist'] );
    Route::get( '/singlereceptionist/{id}', [adminController::class,'Singlereceptionist'] );
    Route::post( '/updatereceptionist', [adminController::class,'Updatereceptionst'] );


    Route::get( '/singledoctor/{id}', [adminController::class,'Singledoctor'] );

    Route::post( '/updatedoctor', [adminController::class,'Updatedoctor'] );
    Route::get( '/adminprofile/{id}', [adminController::class,'adminprofile'] );
    Route::post( '/updateadminprofile', [adminController::class,'adminprofile'] );
    Route::post( '/updateadminprofile', [adminController::class,'Updateadminprfile'] );
    



    Route::get( '/list', 'UserControllerByAdmin@list' );
    Route::get( '/userlist/{id}', 'UserControllerByAdmin@userDetails' );
    Route::post( '/edit/{id}', 'UserControllerByAdmin@edit' );
    Route::post( '/block/{id}', 'UserControllerByAdmin@block1' );
    Route::get( '/delete/{id}', 'UserControllerByAdmin@delete' );
    Route::post( '/add', 'UserControllerByAdmin@add' );
    Route::get( '/transaction', 'UserControllerByAdmin@transaction' );
    Route::get( '/doctor', 'UserControllerByAdmin@doctor' );
    Route::get( '/userReport', 'UserControllerByAdmin@report' );
    Route::get( '/workSchedule', 'UserControllerByAdmin@schedule' );
    Route::get( '/manageSalary', 'UserControllerByAdmin@salary' );
    Route::get( '/manageSalary/{id}', 'UserControllerByAdmin@perSalary' );
    Route::post( '/updateSalary/{id}', 'UserControllerByAdmin@editSalary' );
    Route::get( '/checkroom', 'RoomController@room' );
    // Route::get('/checkroom','RoomController@perRoom');
    Route::get( '/checkroom/{id}', 'RoomController@perRoom' );
    Route::get( '/dashboard', 'UserControllerByAdmin@dashboard' );
    Route::post( 'book/{id}', 'RoomController@booking' );
    Route::put( '/report/{id}', 'UserControllerByAdmin@editReport' );
    Route::post( '/work/{id}', 'UserControllerByAdmin@editWorkSchedule' );
    Route::post( '/changePassword/{id}', 'UserControllerByAdmin@password' );
    Route::get( '/profile/{id}', 'adminController@profile' );


//doctor route
    Route::get( '/doctorDashboard/{id}', ['uses' => 'DoctorController@doctorDashboard'] )->name( 'dashBoard' );
//updateProfile
    Route::get( '/doctor/doctorProfile/{id}', 'DoctorController@doctorProfile' )->name( 'doctorProfile' );
    //Route::post('/doctor/doctorProfile/{id}','DoctorController@updateProfile');

    Route::get( '/doctor/patientDetails/{id}', ['uses' => 'DoctorController@patientDetails'] )->name( 'patientDetails' );
    Route::get( '/doctor/patientDateApprove/{id}', ['uses' => 'DoctorController@patientDetaildate'] )->name( 'patientDetails' );
    Route::post( '/doctor/UpdatePatientDate/{id}', ['uses' => 'DoctorController@UpdatePatientDate'] )->name( 'patientDetails' );
//update
    Route::get( '/doctor/approveAppointment/{id}', ['uses' => 'DoctorController@approveAppointment'] )->name( 'approveAppointment' );
    Route::post( '/doctor/approveAppointment/{id}', ['uses' => 'DoctorController@update'] );

//insert
    Route::get( '/doctor/newApiroment/{id}', ['uses' => 'DoctorController@newApiroment'] )->name( 'newApiroment' );
    Route::post( '/doctor/newApiroment/{id}', ['uses' => 'DoctorController@insertAppointment'] )->name( 'newApiroment' );

    //Route::get('/doctor/newApiroment/{id}',['uses'=>'DoctorController@newApiroment'])->name('newApiroment');
    Route::get( '/doctor/apointmentHistory/{id}', ['uses' => 'DoctorController@apointmentHistory'] )->name( 'apointmentHistory' );
    Route::get( '/doctor/OperationTheatres/{id}', ['uses' => 'DoctorController@operationTheatres'] )->name( 'operationTheatres' );
    Route::get( '/doctor/hospitalAuthority/{id}', ['uses' => 'DoctorController@hospitalAuthority'] )->name( 'hospitalAuthority' );
    Route::get( '/doctor/feedbackReview/{id}', ['uses' => 'DoctorController@feedbackReview'] )->name( 'feedbackReview' );
    Route::get( '/doctor/help/{id}', ['uses' => 'DoctorController@help'] )->name( 'help' );
    Route::get( '/doctor/icuRoom/{id}', ['uses' => 'DoctorController@icuRoom'] )->name( 'icuRoom' );
    Route::get( '/doctor/emergencyRoom/{id}', ['uses' => 'DoctorController@emergencyRoom'] )->name( 'emergencyRoom' );
//change pass
    Route::get( '/doctor/doctorChangePass/{id}', ['uses' => 'DoctorController@doctorChangePass'] )->name( 'doctorChangePass' );
    Route::post( '/doctor/doctorChangePass/{id}', 'DoctorController@updatePassword' );
//update Information
    Route::get( '/doctor/doctorUpdateInformation/{id}', ['uses' => 'DoctorController@doctorUpdateInformation'] )->name( 'doctorUpdateInformation' );

    Route::post( '/doctor/doctorUpdateInformation/{id}', 'DoctorController@updateProfile' );

    Route::get( '/doctor/doctorCheckSalary/{id}', ['uses' => 'DoctorController@doctorCheckSalary'] )->name( 'doctorCheckSalary' );

//insert
    Route::get( '/doctor/immediateTreatment/{id}', ['uses' => 'DoctorController@immediateTreatment'] )->name( 'immediateTreatment' );
    Route::post( '/doctor/immediateTreatment/{id}', ['uses' => 'DoctorController@immediateTreatmentInsert'] )->name( 'immediateTreatment' );

    Route::get( '/doctor/checkReport/{id}', ['uses' => 'DoctorController@checkReport'] )->name( 'checkReport' );

    Route::get( '/doctor/searchPatient/{id}', ['uses' => 'DoctorController@searchPatient'] )->name( 'searchPatient' );
    Route::post( '/doctor/searchPatient/{id}', ['uses' => 'DoctorController@searchPatient'] )->name( 'searchPatient' );

    Route::get( '/SearchCourse/{keyword}', ['uses' => 'DoctorController@searchCourse'] )->name( 'searchPatient' );


//recepsionest route
    Route::get( '/home', 'homeController@index' )->name( 'logout' );
    Route::get( '/reception/dashboard/{id}', 'receptionController@index' );
    Route::get( '/reception/upp', 'receptionController@viewupp' );
    Route::post( '/reception/upp', 'receptionController@upp' );
    Route::get( '/reception/chatbox', 'receptionController@chat' );
    Route::get( '/reception/edit/{id}', 'receptionController@edit' );
    Route::post( '/reception/edit/{id}', 'receptionController@update' );
    Route::get( '/reception/docSche', 'receptionController@schedule' );
    Route::get( '/reception/chngpass/{id}', 'receptionController@chngPass' );
    Route::post( '/reception/upass/{id}', 'receptionController@updatePass' );
    Route::get( '/reception/conadmin', 'receptionController@conAdmin' );
    Route::get( '/reception/condoctor', 'receptionController@conDoctor' );
    Route::get( '/reception/conpatient', 'receptionController@conPatient' );
    Route::get( '/reception/patientsbill', 'receptionController@patientsBill' );
    Route::get( '/reception/createbill', 'receptionController@viewcreatebill' );
    Route::post( '/reception/createbill', 'receptionController@createBill' );
    Route::get( '/reception/rooms', 'receptionController@Rooms' );
    Route::get( '/reception/search', 'receptionController@search' );
    Route::get( '/reception/searchdoc', 'receptionController@viewsearchDoctor' );
    Route::post( '/reception/searchdoc', 'receptionController@searchDoctor' );
    Route::get( '/reception/searchpat', 'receptionController@viewsearchPatient' );
    Route::post( '/reception/searchpat', 'receptionController@searchPatient' );
    Route::get( '/reception/emergency', 'receptionController@Emergency' );
    Route::post( '/reception/emergency', 'receptionController@upEmergency' );
    Route::get( '/reception/discount', 'receptionController@viewDiscount' );
    Route::post( '/reception/discount', 'receptionController@Discount' );
    Route::get( '/reception/trans', 'receptionController@trans' );
    Route::get( '/reception/logout', 'receptionController@logout' );
    Route::get( '/reception/patinfo', 'receptionController@patInfo' );
    Route::get( '/reception/withdraw', 'receptionController@withDraw' );
    Route::get( '/reception/withdraw/ncc', 'receptionController@ncc' );
    Route::get( '/reception/withdraw/bkash', 'receptionController@bkash' );
    Route::get( '/reception/withdraw/dbbl', 'receptionController@dbbl' );
    Route::get( '/reception/review', 'receptionController@review' );
//Route::post('/login','loginController@index');

