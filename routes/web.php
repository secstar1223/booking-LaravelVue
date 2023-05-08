<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EquipmentGuidesController;
use App\Http\Controllers\NewRentalController;

use App\Http\Controllers\TaxRulesController;
use App\Http\Controllers\TaxGroupsController;
use App\Http\Controllers\DurationsController;
use App\Http\Controllers\EquipmentTypesController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\DashboardController;


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

/*
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}/seats', [SeatController::class, 'index'])->name('events.seats.index');
Route::get('/events/{id}/reserve', [SeatController::class, 'reserve'])->name('events.seats.reserve');
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/asset', [AssetController::class, 'index'])->name('asset.index');
    Route::get('/asset/create', [AssetController::class, 'create'])->name('asset.create');
    Route::post('/asset', [AssetController::class, 'store'])->name('asset.store');
    Route::get('/asset/{asset}/edit', [AssetController::class, 'edit'])->name('asset.edit');
    Route::put('/asset/{asset}', [AssetController::class, 'update'])->name('asset.update');
    Route::delete('/asset/{asset}', [AssetController::class, 'destroy'])->name('asset.delete');

    Route::get('/tax-rules', [TaxRulesController::class, 'index'])->name('tax-rules.index');
    Route::get('/tax-rules/create', [TaxRulesController::class, 'create'])->name('tax-rules.create');
    Route::post('/tax-rules', [TaxRulesController::class, 'store'])->name('tax-rules.store');
    Route::get('/tax-rules/{taxRule}/edit', [TaxRulesController::class, 'edit'])->name('tax-rules.edit');
    Route::put('/tax-rules/{taxRule}', [TaxRulesController::class, 'update'])->name('tax-rules.update');
    Route::delete('/tax-rules/{taxRule}', [TaxRulesController::class, 'destroy'])->name('tax-rules.delete');

    Route::get('/tax-groups', [TaxGroupsController::class, 'index'])->name('tax-groups.index');
    Route::get('/tax-groups/create', [TaxGroupsController::class, 'create'])->name('tax-groups.create');
    Route::post('/tax-groups', [TaxGroupsController::class, 'store'])->name('tax-groups.store');
    Route::get('/tax-groups/{taxGroup}/edit', [TaxGroupsController::class, 'edit'])->name('tax-groups.edit');
    Route::put('/tax-groups/{taxGroup}', [TaxGroupsController::class, 'update'])->name('tax-groups.update');
    Route::delete('/tax-groups/{taxGroup}', [TaxGroupsController::class, 'destroy'])->name('tax-groups.delete');


	Route::get('/rentals', [DetailsController::class, 'index'])->name('details.index');
    Route::get('/rentals/create', [DetailsController::class, 'create'])->name('details.create');
	Route::post('/rentals', [DetailsController::class, 'store'])->name('details.store');
    Route::get('/rentals/{details}/edit', [DetailsController::class, 'edit'])->name('details.edit');
    Route::put('/rentals/{details}', [DetailsController::class, 'update'])->name('details.update');
    Route::delete('/rentals/{details}', [DetailsController::class, 'destroy'])->name('details.delete');

	Route::get('/rentals/{detail}/editnewrentals', [DetailsController::class, 'editnewrentals'])
        	->name('details.editnewrentals')
        	->where('detail', '[0-9]+');
    
    Route::prefix('/rentals/{detail}/editnewrentals')->group(function () {
		

        	Route::get('/prices', [PriceController::class, 'index'])->name('details.editnewrentals.prices');
			Route::post('/prices', [PriceController::class, 'store'])->name('prices.store');
			Route::put('/prices/{price}', [PriceController::class, 'update'])->name('prices.update');
        
        	Route::get('/durations', [DurationsController::class, 'index'])->name('details.editnewrentals.durations');
			Route::post('/durations', [DurationsController::class, 'store'])->name('details.editnewrentals.store');
			Route::put('/durations/{durations}', [DurationsController::class, 'update'])->name('details.editnewrentals.update');
			Route::delete('/durations/{durtaions}', [DurationsController::class, 'destroy'])->name('details.editnewrentals.destroy');
        
        	Route::get('/equipmenttypes', [EquipmentTypesController::class, 'index'])->name('details.editnewrentals.equipmenttype');
			Route::post('/equipmenttypes', [EquipmentTypesController::class, 'store'])->name('equipment-type.store');
			Route::put('/equipmenttypes/{equipmenttype}', [EquipmentTypesController::class, 'update'])->name('equipment-type.update');
            Route::delete('/equipmenttypes/{equipmenttype}', [EquipmentTypesController::class, 'destroy'])->name('equipment-type.destroy');
		
			Route::get('/availabilityindex', [AvailabilityController::class, 'index'])->name('availability.index');
			Route::get('/availabilitycreate', [AvailabilityController::class, 'create'])->name('availability.create');
			Route::post('/availabilityindex', [AvailabilityController::class, 'store'])->name('details.editnewrentals.availability.store');
			Route::get('/availabilityedit/{availID}', [AvailabilityController::class, 'edit'])->name('details.editnewrentals.availability.edit');
			Route::put('/availability/{availID}', [AvailabilityController::class, 'update'])->name('details.editnewrentals.availability.update');
			Route::delete('/availability/{availID}', [AvailabilityController::class, 'destroy'])->name('details.editnewrentals.availability.delete');

    });




	
	

	
	
	
	
	
	
/*
	Route::get('/rentals/{details}/equipmenttypes', [EquipmentTypesController::class, 'index'])->name('equipment-type.index');
    Route::post('/rentals/{details}/equipmenttypes', [EquipmentTypesController::class, 'store'])->name('equipment-type.store');
    Route::put('/rentals/{details}/equipmenttypes/{equipmenttype}', [EquipmentTypesController::class, 'update'])->name('equipment-type.update');
    Route::delete('/rentals/{details}/equipmenttypes/{equipmenttype}', [EquipmentTypesController::class, 'destroy'])->name('equipment-type.delete');
   

    Route::get('/rentals/{details}/durations', [DurationsController::class, 'index'])->name('durations.index');
    Route::post('/rentals/{details}/durations', [DurationsController::class, 'store'])->name('durations.store');
    Route::put('/rentals/{details}/durations/{duration}', [DurationsController::class, 'update'])->name('durations.update');
    Route::delete('/rentals/{details}/durations/{duration}', [DurationsController::class, 'destroy'])->name('durations.delete');

    Route::get('/rentals/{details}/availability', [AvailabilityController::class, 'index'])->name('availability.index');
    Route::get('/rentals/{details}/availability/create', [AvailabilityController::class, 'create'])->name('availability.create');
    Route::post('/rentals/{details}/availability', [AvailabilityController::class, 'store'])->name('availability.store');
    Route::get('/rentals/{details}/availability/{taxGroup}/edit', [AvailabilityController::class, 'edit'])->name('availability.edit');
    Route::put('/rentals/{details}/availability/{taxGroup}', [AvailabilityController::class, 'update'])->name('availability.update');
    Route::delete('/rentals/{details}/availability/{taxGroup}', [AvailabilityController::class, 'destroy'])->name('availability.delete');
	
	Route::get('/rentals/{details}/prices', [PricesController::class, 'index'])->name('prices.index');
    Route::post('/rentals/{details}/prices', [PricesController::class, 'store'])->name('prices.store');
    Route::put('/rentals/{details}/prices/{equipmenttype}', [PricesController::class, 'update'])->name('prices.update');
*/

});





