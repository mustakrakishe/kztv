<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
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

    Route::any('/devices/update', [DeviceController::class, 'update'])
    // ->middleware(['auth'])
    ->name('devices.update');

    Route::any('/devices/delete', [DeviceController::class, 'delete'])
    // ->middleware(['auth'])
    ->name('devices.delete');
    

require __DIR__.'/auth.php';