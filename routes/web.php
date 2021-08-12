<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MovementLogController;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    // ->middleware(['auth'])
    ->name('dashboard');

Route::get('/devices', [DeviceController::class, 'show'])
    // ->middleware(['auth'])
    ->name('devices');

    Route::any('/devices/add', [DeviceController::class, 'add'])
    // ->middleware(['auth'])
    ->name('devices.add');

    Route::any('/devices/add_movement_log', [MovementLogController::class, 'add'])
    // ->middleware(['auth'])
    ->name('devices.add_movement_log');

    Route::any('/devices/delete', [DeviceController::class, 'delete'])
    // ->middleware(['auth'])
    ->name('devices.delete');

    Route::any('/devices/delete_movement_log', [MovementLogController::class, 'delete'])
    // ->middleware(['auth'])
    ->name('devices.delete_movement_log');

    Route::any('/devices/find_devices', [DeviceController::class, 'find_devices'])
    // ->middleware(['auth'])
    ->name('devices.find_devices');

    Route::get('/devices/get_device_form', [DeviceController::class, 'get_device_form'])
    // ->middleware(['auth'])
    ->name('devices.get_device_form');

    Route::get('/devices/get_device_log_view', [DeviceController::class, 'get_device_log_view'])
    // ->middleware(['auth'])
    ->name('devices.get_device_log_view');

    Route::get('/devices/get_device_more_info', [DeviceController::class, 'get_device_more_info'])
    // ->middleware(['auth'])
    ->name('devices.get_device_more_info');

    Route::get('/devices/get_movement_log_view', [MovementLogController::class, 'get_log_view'])
    // ->middleware(['auth'])
    ->name('devices.get_movement_log_view');

    Route::get('/devices/get_movement_log_form', [MovementLogController::class, 'get_form'])
    // ->middleware(['auth'])
    ->name('devices.get_movement_log_form');

    Route::any('/devices/update', [DeviceController::class, 'update'])
    // ->middleware(['auth'])
    ->name('devices.update');

    Route::any('/devices/update_movement_log', [MovementLogController::class, 'update'])
    // ->middleware(['auth'])
    ->name('devices.update_movement_log');
    

require __DIR__.'/auth.php';