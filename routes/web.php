<?php

use Illuminate\Support\Facades\Route;

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

//login

Route::get( '/login', "LoginController@index" )->name( 'login' );
Route::post( '/login', "LoginController@verify" );
Route::get( '/logout', 'LogoutController@logout' )->name( 'logout' );
Route::get( '/home', 'homeController@index' )->name( 'home' );

Route::group( ['middleware' => ['sess']], function () {


    //admin session
    Route::group( ['middleware' => ['adminSess']], function () {
        Route::get( '/admin/dashboard', 'adminController@dashboard' )->name( 'admin.dashboard' );
        Route::get( '/admin/addUser', 'UserControllerByAdmin@index' )->name( 'user.index' );
        Route::post( '/admin/addUser', 'UserControllerByAdmin@addUser' )->name( 'user.addUser' );
        Route::get( '/admin/changePassword', 'adminController@changePassword' )->name( 'admin.changePassword' );
        Route::post( '/admin/changePassword', 'adminController@changePasswordVerify' )->name( 'admin.changePasswordVerify' );
        Route::get( '/admin/viewUserList', 'UserControllerByAdmin@viewUserList' )->name( 'user.viewUserList' );
        Route::get( 'admin/viewUserList/search', 'UserControllerByAdmin@liveSearch' )->name( 'user.search' );
        Route::get( '/admin/myProfile', 'adminController@myProfile' )->name( 'admin.myProfile' );
        Route::post( '/admin/myProfile', 'adminController@myProfileVerify' )->name( 'admin.myProfileVerify' );
        Route::get( '/admin/doctorReview', 'UserControllerByAdmin@doctorReview' )->name( 'user.doctorReview' );
        Route::get( '/admin/transactionHistory', 'UserControllerByAdmin@transactionHistory' )->name( 'user.transactionHistory' );
        Route::get( '/admin/userReport', 'UserControllerByAdmin@userReport' )->name( 'user.userReport' );
        Route::get( '/admin/userReport/{id}', 'UserControllerByAdmin@userReportStatus' )->name( 'user.userReportStatus' );
        Route::get( '/admin/editUser/{id}', 'UserControllerByAdmin@editUserView' )->name( 'user.editUserView' );
        Route::post( '/admin/editUser/{id}', 'UserControllerByAdmin@editUser' )->name( 'user.editUser' );
        Route::get( '/admin/patinetRoom', 'RoomController@roomView' )->name( 'room.roomView' );
        Route::get( "/admin/roomBookView/{id}", 'RoomController@roomBookView' )->name( 'room.roomBookView' );
        Route::post( "/admin/roomBookView/{id}", 'RoomController@roomBookVerify' )->name( 'room.roomBookVerify' );
        Route::get( '/admin/viewDetails/{id}', "UserControllerByAdmin@viewUserDetails" )->name( 'user.viewUserDetails' );
        Route::get( '/admin/delete/{id}', "UserControllerByAdmin@deleteUser" )->name( 'user.deleteUser' );
        Route::get( '/admin/block/{id}', "UserControllerByAdmin@blockUser" )->name( 'user.blockUser' );
        Route::get( '/admin/manageSalary', 'UserControllerByAdmin@manageSalaryIndex' )->name( 'user.manageSalaryIndex' );
        Route::post( '/admin/manageSalary', 'UserControllerByAdmin@manageSalary' )->name( 'user.manageSalary' );
        Route::get( '/admin/workSchedul', "UserControllerByAdmin@workSchedulIndex" )->name( 'user.workSchedulIndex' );
        Route::get( '/admin/workSchedul/{id}', "UserControllerByAdmin@workSchedul" )->name( 'user.workSchedul' );
        Route::post( '/admin/image', 'adminController@profilePicture' );
        Route::get( '/admin/updateSalary/{id}', "UserControllerByAdmin@updateSalaryIndex" )->name( 'user.updateSalaryIndex' );
        Route::post( '/admin/updateSalary/{id}', "UserControllerByAdmin@updateSalaryVerify" )->name( 'user.updateSalaryVerify' );
    } );

   

} );