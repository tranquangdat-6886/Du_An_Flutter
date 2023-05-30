<?php

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


Route::get('/attendances/eveatendance/{eveatendance}','AttendanceController@eveatendance')->name('attendances.eveatendance');
Route::middleware(['auth'])->prefix('admin')->group(function () {
Route::middleware(['auth', 'admin:1'])->group(function () {
 Route::resource('/users', 'UserController');
 Route::get('/commands','CommandController@index')->name('commands.index');
 Route::post('/commands','CommandController@run');
      
    });
  
    Route::middleware(['auth', 'staff:1,2'])->group(function () {
        Route::resource('/dashboard', 'AdminController');
        Route::resource('/events', 'EventController');
        Route::resource('/attendances', 'AttendanceController');
        Route::get('/events/edit/{id}', 'EventController@editEvent');
        Route::get('/users/edituser/{userId}', 'UserController@editUser');
    });

    Route::middleware(['auth', 'checker:1,3'])->group(function () {
        Route::resource('/attendances', 'AttendanceController');
    });
});

Auth::routes();

Route::get('/login', 'LoginController@showLoginForm')->name('users.login');
Route::get('/', 'LoginController@showLoginForm')->name('users.login');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');

// Route::get('/login', 'LoginController@showLoginForm')->name('users.login');
// Route::get('/', 'LoginController@showLoginForm')->name('users.login');