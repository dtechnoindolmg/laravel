<?php

use Illuminate\Support\Facades\Route;

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

// auth required
Route::middleware(['auth'])->group(function () {
    //home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //warehouse
    Route::name('warehouse.')->group(function () {
        // Items
        Route::get('warehouse/items', [App\Http\Controllers\Warehouse\WarehouseItemsController::class, 'view'])->name('items');
        Route::get('warehouse/items/find/{text}', [App\Http\Controllers\Warehouse\WarehouseItemsController::class, 'find'])->name('items.find');
        Route::get('warehouse/items/create', [App\Http\Controllers\Warehouse\WarehouseItemsController::class, 'create'])->name('item.create');
        Route::post('warehouse/items/create', [App\Http\Controllers\Warehouse\WarehouseItemsController::class, 'store'])->name('item.store');
        Route::get('warehouse/items/detail/{id}', [App\Http\Controllers\Warehouse\WarehouseItemsController::class, 'detail'])->name('item.detail');
        Route::patch('warehouse/items/update/{id}', [App\Http\Controllers\Warehouse\WarehouseItemsController::class, 'update'])->name('item.update');
        Route::get('warehouse/items/delete/{id}', [App\Http\Controllers\Warehouse\WarehouseItemsController::class, 'delete'])->name('item.delete');

        // stockIn
        Route::get('warehouse/stockin', [App\Http\Controllers\Warehouse\WarehouseStockInController::class, 'view'])->name('stockin');
        Route::get('warehouse/stockin/create', [App\Http\Controllers\Warehouse\WarehouseStockInController::class, 'create'])->name('stockin.create');

        // stockOut
        Route::get('warehouse/stockout', [App\Http\Controllers\Warehouse\WarehouseStockOutController::class, 'view'])->name('stockout');
    });
});
