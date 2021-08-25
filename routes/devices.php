<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MovementLogController;

Route::get('/devices', [DeviceController::class, 'show'])
    ->middleware(['auth'])
    ->name('devices');

    Route::any('/devices/add', [DeviceController::class, 'add'])
    ->middleware(['auth'])
    ->name('devices.add');

    Route::any('/devices/add_movement_log', [MovementLogController::class, 'add'])
    ->middleware(['auth'])
    ->name('devices.add_movement_log');

    Route::any('/devices/delete', [DeviceController::class, 'delete'])
    ->middleware(['auth'])
    ->name('devices.delete');

    Route::any('/devices/delete_movement_log', [MovementLogController::class, 'delete'])
    ->middleware(['auth'])
    ->name('devices.delete_movement_log');

    Route::any('/devices/find_devices', [DeviceController::class, 'find_devices'])
    ->middleware(['auth'])
    ->name('devices.find_devices');

    Route::get('/devices/get_device_comment_form_view', [DeviceController::class, 'get_device_comment_form_view'])
    ->middleware(['auth'])
    ->name('devices.get_device_comment_form_view');

    Route::get('/devices/get_device_comment_log_view', [DeviceController::class, 'get_device_comment_log_view'])
    ->middleware(['auth'])
    ->name('devices.get_device_comment_log_view');

    Route::get('/devices/get_device_form_view', [DeviceController::class, 'get_device_form_view'])
    ->middleware(['auth'])
    ->name('devices.get_device_form_view');

    Route::get('/devices/get_device_log_view', [DeviceController::class, 'get_device_log_view'])
    ->middleware(['auth'])
    ->name('devices.get_device_log_view');

    Route::get('/devices/get_device_more_info_view', [DeviceController::class, 'get_device_more_info_view'])
    ->middleware(['auth'])
    ->name('devices.get_device_more_info_view');

    Route::get('/devices/get_movement_log_view', [MovementLogController::class, 'get_log_view'])
    ->middleware(['auth'])
    ->name('devices.get_movement_log_view');

    Route::get('/devices/get_movement_log_form_view', [MovementLogController::class, 'get_form_view'])
    ->middleware(['auth'])
    ->name('devices.get_movement_log_form_view');

    Route::any('/devices/update', [DeviceController::class, 'update'])
    ->middleware(['auth'])
    ->name('devices.update');

    Route::any('/devices/update_device_comment', [DeviceController::class, 'update_comment'])
    ->middleware(['auth'])
    ->name('devices.update_device_comment');

    Route::any('/devices/update_movement_log', [MovementLogController::class, 'update'])
    ->middleware(['auth'])
    ->name('devices.update_movement_log');