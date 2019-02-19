<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('v1')->group(function () {

    Route::get('/users/send_notification/{id}', 'SendNotificationController@sendNotification')->where(['id' => '[0-9]+']);
    
});
