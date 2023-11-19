<?php

use App\Http\Controllers\Backend\AdminSettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\BackendHomeController;

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


// Backend routes
Route::prefix('backend')->name('backend.')->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::get('index', BackendHomeController::class)->name('index');


        // Route Resource
        Route::resource('admin/setting', AdminSettingController::class);
    });
    require __DIR__ . '/adminAuth.php';
});
