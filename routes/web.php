<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


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

Route::get('/',[EventController::class, 'index']);
Route::get('/add-event',[EventController::class, 'addEvent']);
Route::post('/store',[EventController::class, 'store']);
Route::get('/renginys/{event}',[EventController::class, 'showEvent']);
Route::get('/renginys/update/{event}',[EventController::class, 'updateEvent']);
Route::post('/update/{event}', [EventController::class, 'storeUpdate']);
Route::get('/renginys/delete/{event}',[EventController::class, 'deleteEvent']);
Route::get('/about',[EventController::class, 'about']);
Route::get('/contacts',[EventController::class, 'contacts']);
Route::get('/all-events',[EventController::class, 'allEvents']);
Route::get('/renginys/add-registration/{event}',[EventController::class, 'showRegistration']);
Route::post('/storeRegistration',[EventController::class, 'storeRegistration']);

Route::get('/registrations',[EventController::class, 'showRegistrations']);
Route::post('/approveRegistration/{id}',[EventController::class, 'approveRegistration']);
Route::post('/revertRegistration/{id}',[EventController::class, 'revertRegistration']);
Route::post('/deleteRegistration/{id}',[EventController::class, 'deleteRegistration']);

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

