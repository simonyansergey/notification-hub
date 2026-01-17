<?php

use App\Http\Controllers\Notification\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(NotificationController::class)
    ->prefix('/notification')
    ->group(static function(): void {
        Route::post('/', 'store');
    });
    