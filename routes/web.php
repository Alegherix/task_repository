<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\Auth\RegisterController;

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

// Register account
Route::middleware(['guest'])->group(function () {
    Route::get("/register", [RegisterController::class, "index"])->name('register');
    Route::post('/register', [RegisterController::class, 'store']); // inherits name
});

// Sign in, sign out
Route::get("/signin", [LoginController::class, "index"])->name('login')->middleware(['guest']);
Route::post('/signin', [LoginController::class, "store"])->middleware(['guest']);
Route::post("/signout", [LogoutController::class, "store"])->name('logout')->middleware(['auth']);

Route::middleware(['auth'])->group(function () {
    // View account settings
    Route::get('/settings', [UserSettingController::class, 'index'])->name('settings');
    Route::put('/settings', [UserSettingController::class, 'update']);

    // Index view, shows a list of all assignments in Desc order
    Route::get('/', [AssignmentController::class, "index"])->name('dashboard');

    // Route for students/Teacher to view a specific assignment
    Route::get("/assignment/create", [AssignmentController::class, "create"])->name("assignments.create");
    Route::post("/assignment/create", [AssignmentController::class, "store"])->name("assignments.store");

    Route::get("/assignment/{id}", [AssignmentController::class, "show"])->name("assignments.show");

    // Routes for teachers to create, update and delete assignments.
    //Route::post("/assignment/create", [AssignmentController::class, "store"]);

    Route::put("/assignment/{id}", [AssignmentController::class, "edit"]);
    Route::delete("/assignment/{id}", [AssignmentController::class, "delete"]);
});
