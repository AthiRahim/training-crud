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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::method('uri','action/callback');
Route::get('/schedules', [App\Http\Controllers\ScheduleController::class, 'index'])->name('schedule:index')->middleware('auth');
Route::get('/schedules/create', [App\Http\Controllers\ScheduleController::class, 'create'])->name('schedule:create');
Route::post('/schedules/create', [App\Http\Controllers\ScheduleController::class, 'store'])->name('schedule:store');
Route::get('/schedules/{schedule}', [App\Http\Controllers\ScheduleController::class, 'show'])->name('schedule:show');
Route::get('/schedules/{schedule}/edit', [App\Http\Controllers\ScheduleController::class, 'edit'])->name('schedule:edit');
Route::post('/schedules/{schedule}/edit', [App\Http\Controllers\ScheduleController::class, 'update'])->name('schedule:update');
Route::get('/schedules/{schedule}/destroy', [App\Http\Controllers\ScheduleController::class, 'destroy'])->name('schedule:destroy');
Route::get('/schedules/{schedule}/force-destroy', [App\Http\Controllers\ScheduleController::class, 'forceDestroy'])->name('schedule:force-destroy');


// Route::method('uri','action/callback');
Route::get('/cars', [App\Http\Controllers\CarController::class, 'index'])->name('car:index')->middleware('auth');
Route::get('/cars/create', [App\Http\Controllers\CarController::class, 'create'])->name('car:create');
Route::post('/cars/create', [App\Http\Controllers\CarController::class, 'store'])->name('car:store');
Route::get('/cars/{car}', [App\Http\Controllers\CarController::class, 'show'])->name('car:show');
Route::get('/cars/{car}/edit', [App\Http\Controllers\CarController::class, 'edit'])->name('car:edit');
Route::post('/cars/{car}/edit', [App\Http\Controllers\CarController::class, 'update'])->name('car:update');
Route::get('/cars/{car}/destroy', [App\Http\Controllers\CarController::class, 'destroy'])->name('car:destroy');
Route::get('/cars/{car}/force-destroy', [App\Http\Controllers\CarController::class, 'forceDestroy'])->name('car:force-destroy');
