<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\MovementsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\AuthController;

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('layouts.master');
    });
    /* Vehicle routes */
    
    Route::get('/list_vehicle', [VehicleController::class, 'index'])->name('vehicle');
    
    Route::get('/add_vehicle', [VehicleController::class, 'addVehicleView'])->name('add_vehicle');
    
    Route::post('/create_vehicle', [VehicleController::class, 'store'])->name('create_vehicle');
    
    
    /* Type vehicle routes */
    Route::get('/list_vehicle_type', [VehicleTypeController::class, 'index'])->name('list_vehicle_type');
    
    Route::get('/add_vehicle_type', function () {
        return view('admin.vehicle_type');
    })->name('add_vehicle_type');
    
    Route::post('/create_type_vehicle', [VehicleTypeController::class, 'store'])->name('create_type_vehicle');
    
    
    /* Movements parking routes */
    Route::get('/vehicle_entrance', function () {
        return view('admin.vehicle_entrance');
    })->name('vehicle_entrance');
    
    Route::post('/create_vehicle_entrance', [MovementsController::class, 'saveIn'])->name('create_vehicle_entrance');
    
    Route::get('/vehicle_exit', function () {
        return view('admin.vehicle_exit');
    })->name('vehicle_exit');
    
    Route::post('/create_vehicle_exit', [MovementsController::class, 'saveOut'])->name('create_vehicle_exit');
    
    
    /* Payment residents */
    
    Route::get('/resident_payment', [PaymentController::class, 'index'])->name('resident_payment');
    
    Route::get('/init_month', [PaymentController::class, 'initMonth'])->name('init_month');
    
    Route::get('/export_data', [PaymentController::class, 'exportData'])->name('init_month');
    
});

/* Auth routes */
    
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 