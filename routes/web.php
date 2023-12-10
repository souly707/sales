<?php

use App\Http\Controllers\Backend\AdminSettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\BackendHomeController;
use App\Http\Controllers\Backend\SaleMaterialTypeController;
use App\Http\Controllers\Backend\StoreController;
use App\Http\Controllers\Backend\TreasuryController;

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

Route::get('/', function () {
    return view('welcome');
});


// Frontend routes
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::prefix('backend')->name('backend.')->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::get('index', BackendHomeController::class)->name('index');

        // Start Ajax routes
        Route::post('admin/treasuries/search', [TreasuryController::class, 'ajax_search'])
            ->name('treasuries.ajax_search');

        // End Ajax routes

        // Start Treasuries Delivery routes
        Route::get('admin/add-treasuries-delivery/{id}', [TreasuryController::class, 'add_treasury_delivery'])->name('add.treasuries_delivery');
        Route::post('admin/treasuries-delivery/store/{id}', [TreasuryController::class, 'store_treasury_delivery'])->name('store.treasuries_delivery');
        Route::delete('admin/treasuries-delivery/delete/{id}', [TreasuryController::class, 'delete_treasury_delivery'])->name('delete.treasuries_delivery');
        // End Treasuries Delivery routes


        // Admin Setting
        Route::resource('admin/setting', AdminSettingController::class);
        Route::resource('admin/treasuries', TreasuryController::class);
        Route::resource('admin/sales_material_types', SaleMaterialTypeController::class);
        Route::resource('admin/stores', StoreController::class);
    });
    require __DIR__ . '/adminAuth.php';
});
