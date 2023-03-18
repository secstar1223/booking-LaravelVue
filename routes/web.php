<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SeatController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/equipmentguides', function () {
    return view('equipmentguides');
})->name('equipmentguides');

Route::get('/abandoned', function () {
    return view('abandoned');
})->name('abandoned');

Route::get('/addon', function () {
    return view('addon');
})->name('addon');

Route::get('/newrental', function () {
    return view('newrental');
})->name('newrental');

Route::post('/equipmentguides', function (Illuminate\Http\Request $request) {
    $data = $request->validate([
        'name' => 'required|string',
        'short_name' => 'required|string|max:10',
        'color' => 'required|string',
        'quantity' => 'required|integer|min:0',
        'capacity' => 'required|integer|min:0',
        'resource_tracking' => 'boolean',
        'description' => 'required|string',
    ]);

    $equipment = App\Models\equipment::create($data);

        return redirect('/equipmentguides');
});

