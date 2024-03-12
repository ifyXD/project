<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\BudgetsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Models\RequestUser;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('vehicles.index');
// });



// Vehicles 

Route::get('/', function () {
    return view('auth.login');
});



Route::get('/datausers', [UserController::class, 'datausers']);
Route::post('/users/deletebyid', [UserController::class, 'delete']);
Route::post('/users/editbyid', [UserController::class, 'edit']);
Route::post('/users/addnewuser', [UserController::class, 'create']);

Route::get('/vehicles', [VehicleController::class, 'index']);
Route::get('/vehiclesdata', [VehicleController::class, 'datausers']);
Route::post('/addnewvehicle', [VehicleController::class, 'create']);

Route::post('/vehicle/deletebyid', [VehicleController::class, 'delete']);

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/users', [UserController::class, 'index']);

    // for admin auth route
    Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });



    // for user auth route
    Route::middleware(['isUser'])->prefix('user')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'userdashboard'])->name('user.dashboard');
        Route::get('/vehicles', [VehicleController::class, 'index']);
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::get('/vehiclesdata', [VehicleController::class, 'datausers']);
        Route::post('/addnewvehicle', [VehicleController::class, 'create']);
        Route::post('/editbyid', [VehicleController::class, 'edit']);
       

        // Route::get('/employeea', [EmployeeController::class, 'index']);
        // Route::post('/store', [EmployeeController::class, 'store'])->name('store');
        // Route::get('/fetchall', [EmployeeController::class, 'fetchAll'])->name('fetchAll');
        // Route::delete('/delete', [EmployeeController::class, 'delete'])->name('delete');
        // Route::get('/edit', [EmployeeController::class, 'edit'])->name('edit');
        // Route::post('/update', [EmployeeController::class, 'update'])->name('update');

        Route::get('/tae', [UserController::class, 'index']);
        Route::get('/datausers', [UserController::class, 'datausers']);
        Route::post('/users/deletebyid', [UserController::class, 'delete']);
        Route::post('/users/editbyid', [UserController::class, 'edit']);
        Route::post('/users/addnewuser', [UserController::class, 'create']);

    });
});
