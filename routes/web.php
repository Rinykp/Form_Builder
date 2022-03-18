<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FormController;
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

Route::get('login', [AuthController::class, 'index'])->name('login');

Route::post('save-form', [FormController::class, 'saveForm'])->name('login.post'); 
Route::get('newform', [FormController::class, 'newForm'])->name('login.post'); 

Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 

Route::get('registration', [AuthController::class, 'registration'])->name('register');

Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 

Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::resource('form','App\Http\Controllers\FormController' );

Route::get('formadd', [FormController::class, 'addForm']);
Route::get('/', 'FormController@showBuilder')->name('app.home');

Route::get('/show-form', 'FormController@showForm')->name('show.form');
// Route::post('/save-form', 'FormController@saveForm')->name('save.form');
//  Route::post('/submit-form', 'FormController@newForm')->name('submit.form');
Route::post('/submit-form', 'App\Http\Controllers\FormController@newForm'); 
