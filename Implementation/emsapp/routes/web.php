<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\MeetingController;
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


Route::get("createMeeting", [ManagerController::class, "createMeeting"])->name("createMeeting");
Route::get("updateMeeting/{id}", [ManagerController::class, "updateMeeting"])->name("updateMeeting");
Route::get("updateAttendance/{id}", [ManagerController::class, "updateAttendance"])->name("updateAttendance");
Route::post("createMeetingSubmit", [ManagerController::class, "createMeetingSubmit"])->name("createMeetingSubmit");
Route::post("updateAttendanceSubmit", [ManagerController::class, "updateAttendanceSubmit"])->name("updateAttendanceSubmit");
Route::post("updateMeetingSubmit", [ManagerController::class, "updateMeetingSubmit"])->name("updateMeetingSubmit");
Route::get("deleteMeeting/{id}", [ManagerController::class, "deleteMeeting"])->name("deleteMeeting");

Route::get("createAccount", [AdminController::class, "createAccount"])->name("createAccount");
Route::get("updateAccount/{id}", [AdminController::class, "updateAccount"])->name("updateAccount");
Route::post("createAccountSubmit", [AdminController::class, "createAccountSubmit"])->name("createAccountSubmit");
Route::get("createAccountSubmit", [AdminController::class, "createAccountSubmit"])->name("createAccountSubmit");
Route::post("updateAccountSubmit", [AdminController::class, "updateAccountSubmit"])->name("updateAccountSubmit");
Route::get("updateAccountSubmit", [AdminController::class, "updateAccountSubmit"])->name("updateAccountSubmit");
Route::get("deleteAccount/{id}", [AdminController::class, "deleteAccount"])->name("deleteAccount");

Route::get("allMeetings", [MeetingController::class, "allMeetings"])->name("allMeetings");
Route::get("allEmployees", [EmployeeController::class, "allEmployees"])->name("allEmployees");
Route::get("viewEmployee/{id}", [EmployeeController::class, "viewEmployee"])->name("viewEmployee");


// Route::get("/",[LogController::class,"roleOverview"])->name("roleOverview");
Route::get('index',[LogController::class, "index"])->name('index');
Route::get('templateDefined', [LogController::class, "templateDefined"])->name('templateDefined');
Route::get("/",[LogController::class,"login"])->name("login"); 
Route::get("createRole",[AdminController::class,"createRole"])->name("createRole");
Route::post("loginSubmit", [LogController::class,"loginSubmit"])->name("loginSubmit");
Route::get("roleOverview",[AdminController::class,"roleOverview"])->name("roleOverview");
Route::get("logout",[LogOutController::class,"logout"])->name("logout");
Route::post("/createRoleSubmited",[AdminController::class,"createRoleSubmited"])->name("createRoleSubmited");

//AJAX rute
Route::post('employeeSearch', [ManagerController::class,'employeeSearch'])->name('employeeSearch');
Route::post('getEmployee', [ManagerController::class,'getEmployee'])->name('getEmployee');
