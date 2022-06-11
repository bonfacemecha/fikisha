<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customers', [App\Http\Controllers\HomeController::class, 'customers'])->name('customers');
Route::get('/fleet', [App\Http\Controllers\HomeController::class, 'fleet'])->name('fleet');



Route::get('/orders/list', [OrderController::class, 'getOrders']);
Route::post('/changes/status/order/{id}', [OrderController::class, 'actionOrder']);

//CUSTOMERS
Route::get('/customers/list', [CustomerController::class, 'getCustomers']);
Route::post('/customer/store', [CustomerController::class, 'store']);
Route::put('/customer/update/{id}', [CustomerController::class, 'update']);
Route::get('/customers/{id}', [CustomerController::class, 'getSingleCustomer']);
Route::post('/customer/delete/{id}', [CustomerController::class, 'destroy']);


//VEHICLES
Route::get('/vehicles/list', [FleetController::class, 'getVehicles']);
Route::post('/vehicle/store', [FleetController::class, 'store']);
Route::put('vehicle/update/{id}', [FleetController::class, 'update']);
Route::get('/vehicles/{id}', [FleetController::class, 'getSingleVehicle']);
Route::post('/vehicle/delete/{id}', [FleetController::class, 'destroy']);
