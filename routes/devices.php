<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MovementLogController;

Route::get('/devices', [DeviceController::class, 'index'])
        ->name('devices');

    Route::any('/devices/add', [DeviceController::class, 'add'])
        ->name('devices.add');

    Route::any('/devices/add_movement_log', [MovementLogController::class, 'add'])
        ->name('devices.add_movement_log');

    Route::any('/devices/delete', [DeviceController::class, 'delete'])
        ->name('devices.delete');

    Route::any('/devices/delete_movement_log', [MovementLogController::class, 'delete'])
        ->name('devices.delete_movement_log');

    Route::get('/devices/fetch_data', [DeviceController::class, 'fetch_data'])
        ->name('devices.fetch_data');

    Route::get('/devices/edit_property', [DeviceController::class, 'get_property_edit_form'])
        ->name('devices.get_property_edit_form');
    
        Route::post('/devices/edit_property', [DeviceController::class, 'edit_property'])
            ->name('devices.edit_property');
            
    Route::any('/devices/find_devices', [DeviceController::class, 'fetch_data'])
        ->name('devices.find_devices');

    Route::get('/devices/get_device_comment_log_view', [DeviceController::class, 'get_device_comment_log_view'])
        ->name('devices.get_device_comment_log_view');

    Route::get('/devices/get_device_form_view', [DeviceController::class, 'get_device_form_view'])
        ->name('devices.get_device_form_view');

    Route::get('/devices/get_device_log_view', [DeviceController::class, 'get_device_log_view'])
        ->name('devices.get_device_log_view');

    Route::get('/devices/get_device_more_info_view', [DeviceController::class, 'get_device_more_info_view'])
        ->name('devices.get_device_more_info_view');

    Route::get('/devices/get_movement_log_view', [MovementLogController::class, 'get_log_view'])
        ->name('devices.get_movement_log_view');

    Route::get('/devices/get_movement_log_form_view', [MovementLogController::class, 'get_form_view'])
        ->name('devices.get_movement_log_form_view');

    Route::any('/devices/update', [DeviceController::class, 'update'])
        ->name('devices.update');

    Route::any('/devices/update_device_comment', [DeviceController::class, 'update_comment'])
        ->name('devices.update_device_comment');

    Route::any('/devices/update_movement_log', [MovementLogController::class, 'update'])
        ->name('devices.update_movement_log');