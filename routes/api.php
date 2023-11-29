<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ShipController;
use Illuminate\Support\Facades\Route;

Route::get( '/v1/starships', [ShipController::class, 'getStarships']);
Route::get( '/v1/starships/count/', [ShipController::class, 'getSpecificStarshipCount']);
Route::get( '/v1/starships/{id}', [ShipController::class, 'getSpecificStarship']);
Route::post('/v1/starships/quantityInventory/set', [InventoryController::class, 'starshipSetQuantity']);
Route::post('/v1/starships/quantityInventory/add', [InventoryController::class, 'starshipAddQuantity']);
Route::post('/v1/starships/quantityInventory/subtract', [InventoryController::class, 'starshipSubtractQuantity']);
Route::post('/v1/starships/quantityInventory/reset', [InventoryController::class, 'starshipResetQuantity']);

Route::get( '/v1/vehicles', [ShipController::class, 'getVehicles']);
Route::get( '/v1/vehicles/count', [ShipController::class, 'getSpecificVehicleCount']);
Route::get( '/v1/vehicles/{id}', [ShipController::class, 'getSpecificVehicle']);
Route::post('/v1/vehicles/quantityInventory/set', [InventoryController::class, 'vehicleSetQuantity']);
Route::post('/v1/vehicles/quantityInventory/add', [InventoryController::class, 'vehicleAddQuantity']);
Route::post('/v1/vehicles/quantityInventory/subtract', [InventoryController::class, 'vechicleSubtractQuantity']);
Route::post('/v1/vehicles/quantityInventory/reset', [InventoryController::class, 'vehicleResetQuantity']);
