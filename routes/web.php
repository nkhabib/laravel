<?php

use App\Http\Controllers\ApiEventsController;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Route;

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

Route::controller(EventsController::class)->group(function () {
    Route::get('/', 'get');
    Route::get('events/{sort}', 'sort');
    Route::post('sort', 'doSort');
    Route::post('addEvent', 'doAdd');
    Route::delete('deleteEvent{id}', 'doDelete');
    Route::put('updateEvent{id}', 'doUpdate');
    Route::post('search', 'search');
    Route::get('search', 'search');
    // frontend
    Route::get('frontend', 'front_get');
});

// Route::controller(ApiEventsController::class)->group(function () {
//     Route::get('api/events', 'index');
// });
