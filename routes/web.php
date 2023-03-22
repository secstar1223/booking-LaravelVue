<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\EquipmentGuidesController;
use App\Http\Controllers\NewRentalController;

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
    return view('welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}/seats', [SeatController::class, 'index'])->name('events.seats.index');
Route::get('/events/{id}/reserve', [SeatController::class, 'reserve'])->name('events.seats.reserve');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


/*adding equipment routes*/
Route::get('/equipmentguides', [EquipmentGuidesController::class, 'index'])->name('equipmentguides');

Route::post('/equipmentguides', [EquipmentGuidesController::class, 'store'])->name('equipmentguides.store');

Route::get('/equipmentguides/{id}', [EquipmentGuidesController::class, 'show']);

Route::delete('/equipmentguides/{id}', [EquipmentGuidesController::class, 'destroy']);






Route::get('/abandoned', function () {
    return view('abandoned');
})->name('abandoned');

Route::get('/addon', function () {
    return view('addon');
})->name('addon');



/*new rental routes NOTE some routes go to pages that dont exsist, the controller will return to correct page*/
Route::get('/newrental', function () {
    return view('newrental');
})->name('newrental');
Route::post('/newrental', [NewRentalController::class, 'store'])->name('newrental.store');

Route::post('/newrental/rentalequipmenttype', [NewRentalController::class, 'rentalequipmenttype'])->name('newrental.rentalequipmenttype');





